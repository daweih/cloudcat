<?php
	$con = mysql_connect("localhost:3306", "usr","passwd");
	if (!$con){
		die('Could not connect: ' . mysql_error());
	}
	mysql_select_db("dbcloudcat", $con);
$hash_fasta;
$handle = fopen($cds,'r');

if ($handle) {
	$rec_id;
	$rec_tag;
	$rec_seq;
	while (!feof($handle)) {
		$buffer = fgets($handle); 

		$pattern = '/^>\S+/';
		if(preg_match($pattern, $buffer, $matches)){
			$brarray = preg_split('/\t|\s+/',$buffer);
			$rec_id = preg_replace('/^>/', '', $brarray[0]);
			if(count($brarray)>0){
				$hash_fasta[$rec_id]["tag"] = $brarray[1];
				$hash_fasta[$rec_id]["id"] = $rec_id;
				$hash_fasta[$rec_id]["seq"] = "";
			}
		}
		else{
			if(preg_match("/[A|U|T|C|G|a|u|t|c|g]+/", $buffer, $seq)){
					$hash_fasta[$rec_id]["seq"] .= $seq[0];
			}
		}
	}
	
	#var_dump($hash_fasta);
fclose($handle);
}
$cat_handle = fopen($cat,'r');
if ($cat_handle) {
while (!feof($cat_handle)) {
        $header;
        $buffer = fgets($cat_handle);
        $brarray = preg_split('/\t/',$buffer);
        if($brarray[0]=="ID"){
                $header = $brarray;
                foreach ($header as &$c_name) {
                        $c_name = preg_replace('/\(/', '_', $c_name);$c_name = preg_replace('/\)/', '', $c_name);$c_name = preg_replace('/\s/', '_', $c_name);
                }
        }
        else{
                if(count($brarray)>=count($header)){
                        if(preg_match('/^\d+$/', $brarray[1], $log)){
                                #第二列是长度，无tag
                                foreach ($header as $key => $c_name) {
#                                       echo "key: $key\tRec: $c_name\tValue: ",$brarray[$key], "<br/>\n";
                                        if($key>0){
	                                        #$hash_fasta[$rec_id]["id"] = $rec_id;
                                        	if($c_name=="CDC"){
                                        		$hash_fasta[$brarray[0]]["CDC"] = $brarray[$key];
                                        	}
                                        }
                                }
                        }
                        else if(preg_match('/^\d+$/', $brarray[2], $log) && !preg_match('/^\d+$/', $brarray[1])){
                                #第三列是长度，有tag
                                foreach ($header as $key => $c_name) {
                                        if($key>0){
                                            $key = $key + 1;
                                        	if($c_name=="CDC"){
                                        		$hash_fasta[$brarray[0]]["CDC"] = $brarray[$key];
                                        	}
                                        }
                                }
                        }
                }
        }

}
 fclose($cat_handle);
}


foreach($hash_fasta as $id) {
        #echo $id["id"],"\t" , $id["tag"], "<br>";
        #echo $id["seq"], "<br>";
        $recID = $id["id"];
        $usrID = $gp_personID;
        $CDC = $id["CDC"];
        $result = mysql_query("select ID from fasta WHERE ID='$recID' AND usrID='$usrID'");
        $check_cdc = mysql_query("select ID from fasta WHERE ID='$recID' AND usrID='$usrID' AND CDC='$CDC'");
        if($row = mysql_fetch_array($result)){
        if($cdc_check = mysql_fetch_array($check_cdc)){
		$sql="update fasta set tag='" .$id["tag"]. "' where ID='$recID'";       if (!mysql_query($sql,$con)){die('Error: ' . mysql_error());}
        }else{
		echo "update fasta rec<br>";
			$sql="update fasta set seq='". $id["seq"]. "', tag='" .$id["tag"]. "' where ID='$recID'";	if (!mysql_query($sql,$con)){die('Error: ' . mysql_error());}        
        }
        }                                                                                                                                                                 
        else{                                                                                                                                                             
                $sql="INSERT INTO fasta (ID, usrID, seq, tag, genetic_code)                                                                                                             
                VALUES                                                                                                                                                    
                ('". $id["id"]. "','$usrID','". $id["seq"]. "','" .$id["tag"]. "','". $cat_genetic_code. "')";	if (!mysql_query($sql,$con)){die('Error: ' . mysql_error());}     
        }                                                                                                                                                                 
}                                                                                                                                                                         

mysql_close($con);
#echo "Test LOG: FASTA2mysql DONE@fasta2mysql.php<br>";
?>

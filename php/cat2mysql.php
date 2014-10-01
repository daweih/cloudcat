<?php
	$con = mysql_connect("localhost:3306", "usr","passwd");
	if (!$con){
		die('Could not connect: ' . mysql_error());
	}
	mysql_select_db("dbcloudcat", $con);

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
				$recID = $brarray[0];
				$usrID = $gp_personID;
				$CDC   = $brarray[10];
				$check_cdc = mysql_query("select ID from fasta WHERE ID='$recID' AND usrID='$usrID' AND CDC='$CDC'");
				#第二列是长度，无tag
				if($cdc_check = mysql_fetch_array($check_cdc)){}else{
				$sql="update fasta set CAT = '$buffer' where ID = '$brarray[0]'";if (!mysql_query($sql,$con)){die('Error: ' . mysql_error());}
				foreach ($header as $key => $c_name) {
#					echo "key: $key\tRec: $c_name\tValue: ",$brarray[$key], "<br/>\n";
					if($key>0 && !preg_match('/^P_/', $c_name, $log_a) && !preg_match('/^Expected_/', $c_name, $log_b)){
					#if($key>0){
						#echo "$recID,$usrID, $CDC update cat rec<br>";
						$sql="update fasta set $c_name = '$brarray[$key]' where ID = '$brarray[0]'";if (!mysql_query($sql,$con)){die('Error: ' . mysql_error());}
					}
				}
				}
			}
			else if(preg_match('/^\d+$/', $brarray[2], $log) && !preg_match('/^\d+$/', $brarray[1])){
				#第三列是长度，有tag
				$recID = $brarray[0];
				$usrID = $gp_personID;
				$CDC   = $brarray[11];
				$check_cdc = mysql_query("select ID from fasta WHERE ID='$recID' AND usrID='$usrID' AND CDC='$CDC'");
				if($cdc_check = mysql_fetch_array($check_cdc)){}else{
				$sql="update fasta set CAT = '$buffer' where ID = '$brarray[0]'";if (!mysql_query($sql,$con)){die('Error: ' . mysql_error());}
				foreach ($header as $key => $c_name) {
					if($key>0 && !preg_match('/^P_/', $c_name, $log_a) && !preg_match('/^Expected_/', $c_name, $log_b)){
					#if($key>0){
						$key = $key + 1;
						#echo "$recID,$usrID, $CDC update cat rec<br>";
						$sql="update fasta set $c_name = '$brarray[$key]' where ID = '$brarray[0]'";if (!mysql_query($sql,$con)){die('Error: ' . mysql_error());}
					}
				}
				}
			}
		}
	}
	
}
 fclose($cat_handle);
}

mysql_close($con);
#echo "Test LOG: CAT2mysql DONE@cat2mysql.php.<br>";
?>

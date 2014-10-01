<?php
	include("url_encode.php");
	$usrID = base64url_decode($_GET['usrID']);
	include("read_cloudcat.php");
                        $page_rep = mysql_query("select tag from fasta where usrID='".$usrID ."'");
                        #select json from fasta where ID='NM_000020';
                        $tag_hash;
			while($row = mysql_fetch_array($page_rep)){
				$groups = preg_split("/;/",  $row['tag']);
				$i = 0;
				foreach($groups as $group){
					$tags = preg_split("/,/", $group);
					foreach($tags as $tag){
						$tag_hash[$i][$tag] = 1;
					}
					$i++;
				}

			}
echo "tag_group\ttag\n";
foreach($tag_hash as $index=>$group){
	echo "group_", $index, "\t";
	$i = 1;
	foreach($group as $tag=>$value){
		echo  $tag;
		if($i<count($group)){
			echo ",";
		}
		$i++;
	}
	echo "\n";
}
mysql_close($con);
?>

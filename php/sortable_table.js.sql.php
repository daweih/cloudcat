<?php
include("url_encode.php");
$usrID = base64url_decode($_GET['usrID']);
include("read_cloudcat.php");

                        $page_rep = mysql_query("select ID, Length, GC, GC1, GC2, GC3, AG, AG1, AG2, AG3, CDC from fasta where usrID='".$usrID ."'");
                        #select json from fasta where ID='NM_000020';
			echo "ID\tLength\tGC\tGC1\tGC2\tGC3\tAG\tAG1\tAG2\tAG3\tCDC\n";
                        while($row = mysql_fetch_array($page_rep)){
                                echo $row['ID'], "\t", $row['Length'], "\t", $row['GC'], "\t", $row['GC1'], "\t", $row['GC2'], "\t", $row['GC3'], "\t", $row['AG'], "\t", $row['AG1'], "\t", $row['AG2'], "\t", $row['AG3'], "\t", $row['CDC'], "\n";
                        }
mysql_close($con);
?>

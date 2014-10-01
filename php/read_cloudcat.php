<?php
$con = mysql_connect("localhost:3306", "usr","passwd");
 if (!$con)
   {
   die('Could not connect: ' . mysql_error());
   }
mysql_select_db("dbcloudcat", $con);
?>

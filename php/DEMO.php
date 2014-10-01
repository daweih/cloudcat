<?php
$gp_personID = "DEMO";
include("read_cloudcat.php");                                                          
$cmd = "cp bin/zip.php "."upload/". $gp_personID. "/";
exec($cmd);

#include("php/gp_seq_ids.php");
#echo "Test LOG: DEMO page DONE@DEMO.php";
?>

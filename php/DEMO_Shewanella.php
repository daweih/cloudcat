<?php
$gp_personID = "DEMO_Shewanella";
exec("mkdir upload/DEMO_Shewanella");
include("read_cloudcat.php");                                                          
$cmd = "cp bin/zip.php "."upload/". $gp_personID. "/";
exec($cmd);
#include("php/gp_seq_ids.php");
#echo "Test LOG: DEMO page DEMO_Shewanella@DEMO_Shewanella.php";
?>

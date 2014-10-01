<?php 
	exec("mkdir cat.big.ac.cn_id".$_POST['gp_personID']);
	$fig_name = "cat.big.ac.cn_id".$_POST['gp_personID']."/".$_POST['gp_file_name']."_".$_POST['select_class'];
#	$fig_name = "cat.big.ac.cn_id".$_POST['gp_personID']."/".$_POST['select_class'];

	$log=fopen("rsvg_log","w+");

	$svg_file=fopen($fig_name.".svg","w+");
	fwrite($svg_file, $_POST['svg_code']);
	$fig = $fig_name.".svg";
	$new_fig = $fig_name.".".$_POST['fig_type'];
	$new_fig_zip = $new_fig.".zip";

switch($_POST['fig_type']){
  case "pdf":
	$rsvg_cmd = "/usr/bin/rsvg-convert -f ".$_POST['fig_type']." -z 1 $fig > $new_fig | echo done";
	$starttime = microtime(true);
	$output = exec($rsvg_cmd);
	$endtime = microtime(true);
	$time_taken = $endtime-$starttime;
	fwrite($log, $time_taken);
	
	$zip = "/usr/bin/zip $new_fig_zip $new_fig |echo done";$output = exec($zip);
	echo 'Preparing your figure. Converting...Format: '.$_POST['fig_type'].'. ';
    break;
  case "png":
	$rsvg_cmd = "/usr/bin/rsvg-convert -f ".$_POST['fig_type']." -z 2 $fig > $new_fig | echo done";$output = exec($rsvg_cmd);
	$zip = "/usr/bin/zip $new_fig_zip $new_fig |echo done";$output = exec($zip);
	echo 'Preparing your figure. Converting...Format: '.$_POST['fig_type'].': ';
    break;
  case "ps":
	$rsvg_cmd = "/usr/bin/rsvg-convert -f ".$_POST['fig_type']." -z 1 $fig > $new_fig | echo done";$output = exec($rsvg_cmd);
	$zip = "/usr/bin/zip $new_fig_zip $new_fig |echo done";$output = exec($zip);
	echo 'Preparing your figure. Converting...Format: '.$_POST['fig_type'].'. ';
    break;
  case "svg":
	$zip = "/usr/bin/zip $fig.zip $fig |echo done";$output = exec($zip);
	echo 'Preparing your figure. Converting...Format: '.$_POST['fig_type'].': ';
    break;
  case "tiff":
	$rsvg_cmd = "/usr/bin/rsvg-convert -f ".$_POST['fig_type']." -z 1 $fig > $new_fig | echo done";$output = exec($rsvg_cmd);
	$zip = "/usr/bin/zip $new_fig_zip $new_fig |echo done";$output = exec($zip);
	echo 'Preparing your figure. Converting...Format: '.$_POST['fig_type'].'. ';
    break;
}
?>

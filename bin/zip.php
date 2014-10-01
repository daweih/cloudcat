<?php 
$con = mysql_connect("localhost:3306", "mysql_reader","password");
if (!$con){die('Could not connect: ' . mysql_error());}
mysql_select_db("dbcloudcat", $con);
	switch($_POST['file_type']){
	#switch($_GET['file_type']){
		case "cat":
			$fp = fopen('data.cat', 'w');
			$page_rep = mysql_query("select CAT from fasta where usrID='".$_POST["gp_personID"] ."'");
			while($row = mysql_fetch_array($page_rep)){
				fwrite($fp, $row["CAT"]);
			}	
			$rm = "rm data.cat.zip";exec($rm);
			$zip = "/usr/bin/zip data.cat.zip data.cat|echo CAT TSV file";echo exec($zip);
		#$rm = "rm ".$_POST['gp_fasta_file'].".cat.zip";exec($rm);
		#$zip = "/usr/bin/zip ".$_POST['gp_fasta_file'].".cat.zip ".$_POST['gp_fasta_file'].".cat|echo HERE";echo exec($zip);
		break;

		case "input":
			$fp = fopen('input.fasta', 'w');
			$page_rep = mysql_query("select ID,seq from fasta where usrID='".$_POST["gp_personID"] ."'");
			while($row = mysql_fetch_array($page_rep)){
				fwrite($fp, ">".$row["ID"]."\n");
				fwrite($fp, $row["seq"]."\n");
			}
			$rm = "rm input.fasta.zip";exec($rm);
			$zip = "/usr/bin/zip input.fasta.zip input.fasta|echo input FASTA file";echo exec($zip);
#		$rm = "rm ".$_POST['gp_fasta_file'].".zip";exec($rm);
#		$zip = "/usr/bin/zip ".$_POST['gp_fasta_file'].".zip ".$_POST['gp_fasta_file'].".tag|echo HERE";echo exec($zip);
		break;
		
		case "pendulum_model_implementation":
			$mkdir_cmd = "rm -r p";
			exec($mkdir_cmd);
			$mkdir_cmd = "mkdir p";
			exec($mkdir_cmd);
			$mkdir_cmd = "cp ../../bin/fig_p.js p";#绘制pendulum图的js脚本
			exec($mkdir_cmd);
			$mkdir_cmd = "cp ../../js/d3.v3.min.js p";#d3库脚本
			exec($mkdir_cmd);
			$mkdir_cmd = "cp ../../bin/index.html p";#绘制pendulum图的js脚本
			exec($mkdir_cmd);
			
			$fp = fopen('p/genetic_code.js', 'w');
			$no = $_POST["gp_genetic_code_no"] - 1;
			fwrite($fp, "no=".$no.";");

			$page_rep = mysql_query("select ID,json from fasta where usrID='".$_POST["gp_personID"] ."'");
			#$page_rep = mysql_query("select ID,json from fasta where usrID='".$_GET["gp_personID"] ."'");
			$json_cnt = 0;
			while($row = mysql_fetch_array($page_rep)){
				$json_cnt++;
				if($json_cnt==1){
					$fp = fopen('p/data.json', 'w');
					fwrite($fp, $row["json"]);
				}
				$fp = fopen('p/'. $row["ID"]. '.json', 'w');
				fwrite($fp, $row["json"]);
			}
			$rm = "rm pendulum_model_implementation.zip";exec($rm);
			$zip = "/usr/bin/zip -r pendulum_model_implementation.zip p/|echo pendulum_model_fig_implementation";echo exec($zip);
#		$rm = "rm ".$_POST['gp_fasta_file'].".zip";exec($rm);
#		$zip = "/usr/bin/zip ".$_POST['gp_fasta_file'].".zip ".$_POST['gp_fasta_file'].".tag|echo HERE";echo exec($zip);
		break;
		case "partition_model_implementation":
				$mkdir_cmd = "rm -r partition";
				exec($mkdir_cmd);
				$mkdir_cmd = "mkdir partition";
				exec($mkdir_cmd);
				$mkdir_cmd = "cp -r ../../bin/genetic_code/ partition";
				exec($mkdir_cmd);
				$mkdir_cmd = "cp ../../bin/fig_partition.js partition/fig_p.js";
				exec($mkdir_cmd);
				$mkdir_cmd = "cp ../../js/d3.v3.min.js partition";#d3库脚本
				exec($mkdir_cmd);
				$mkdir_cmd = "cp ../../bin/index.html partition";#绘制pendulum图的js脚本
				exec($mkdir_cmd);



				$fp = fopen('partition/genetic_code.js', 'w');
				$no = $_POST["gp_genetic_code_no"] - 1;
				fwrite($fp, "no=".$no.";");
		
				$page_rep = mysql_query("select ID,cat from fasta where usrID='".$_POST["gp_personID"] ."'");
				$json_cnt = 0;
				while($row = mysql_fetch_array($page_rep)){
						$json_cnt++;
						if($json_cnt==1){
								$cmd = "cat ../../bin/head.cat >partition/cat";
								exec($cmd);
								$fp = fopen('partition/cat', 'w');
						$handle = fopen("../../bin/head.cat",'r');
						if ($handle) {
							while (!feof($handle)) {
								$head = fgets($handle);
								fwrite($fp, $head);
							}
						}


								fwrite($fp, $row["cat"]);
						}
						$fp = fopen('partition/'. $row["ID"]. '.cat', 'w');
						$handle = fopen("../../bin/head.cat",'r');
						if ($handle) {
							while (!feof($handle)) {
								$head = fgets($handle);
								fwrite($fp, $head);
							}
						}

						fwrite($fp, $row["cat"]);
				}
				$rm = "rm partition.zip";exec($rm);
				$zip = "/usr/bin/zip -r partition.zip partition/|echo partition_model_fig_implementation";echo exec($zip);
		break;

		
	}
?>

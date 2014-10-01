<?php
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<head>
    <meta charset="utf-8">
    <title>CCAT-Cloud Composition Analysis Toolkit</title>
	<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />
	<link href="img/favicon.ico" rel="bookmark"/>


    <link href="css/bootstrap.min.css"            rel="stylesheet">
    <link href="css/bootstrap-responsive.min.css" rel="stylesheet">

    <link href="css/sortable_table.css"           rel="stylesheet">
    <link href="css/horizontal.css"               rel="stylesheet">
    <link href="css/prettify.css"                 rel="stylesheet">
    <link rel="stylesheet" href="css/upload_tab.css" />
    
	<!--这三个文件是必须的-->    
    <script src="js/jquery.js"></script>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
	<script src="js/d3.v3.min.js"></script>
	<!--<script src="/js/snow.js"></script>-->


	<!--TAG STACK-->
	<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
	<link rel="stylesheet" href="css/tag_stack.css"><!--
	<script src="js/jquery-1.9.1.js"></script>-->
	<script src="js/jquery-ui-1.10.3.js"></script>
	<!--TAG STACK-->
	
	<script src="js/jquery.fileDownload.js"></script>

    <style>
    	html{
			height:800px;
    	}
    	div.container {
    	}
		div.canvas_cat {
			-webkit-filter: blur(7px);
			top:10%;
			left:450px;
			position:absolute;
		}

		div.container_err{
			background:  url('img/0.png') no-repeat;
			top: -2%;
			width:1400px;
			height:600px;
			margin:0 auto;
			position:relative;
			z-index:1;
	
			-moz-perspective: 800px;
			-webkit-perspective: 800px;
/*			perspective: 800px;*/

			box-shadow:0 0 10px black;
		}
		div.err{
			font: 25px 'Helvetica Neue Light','Candara Bold','Segoe UI',Arial,sans-serif;
			color:white;
			top: 280px;
			left: 136px;
			position: absolute;
			text-shadow:0 0 8px black;
		}
		h1#title {
			top:20px;
			left:20px;
			position:absolute;
			font: 80px 'Helvetica Neue UltraLight','Segoe UI',Arial,sans-serif;
			color: white;
		}
		h2#subtitle {
			top:58px;
			left:380px;
			position:absolute;
			font: 40px 'Helvetica Neue UltraLight','Segoe UI',Arial,sans-serif;
			color: white;
		}
    	foot {
			border-top-color: rgb(221,221,221);
			border-top-style: solid;
			border-top-width: 1px;
    	}
		div.span4 {
			border-right-color: rgb(221,221,221);
			border-right-style: solid;
			border-right-width: 1px;
			border-bottom-color: rgb(221,221,221);
			border-bottom-style: solid;
			border-bottom-width: 1px;
			width: 360px;
			height: 820px;
			overflow:auto;
		}
		div.span4 p {
			width: 340px;
			text-align: left;
			font-family: 'Helvetica Neue Light';
		}
		div.span4 hr, div.span4 section {
			width: 340px;
		}
		div.record_list {
			width: 340px;
			overflow:auto;
		}
		.axis path,
		.axis line {
		  fill: none;
		  stroke: #000;
		  shape-rendering: crispEdges;
		}


		@font-face {
			font-family: 'Helvetica Neue UltraLight';
			src: url('./font/helvetica_neue_ultralight.ttf');
		}
		@font-face {
			font-family: 'Helvetica Neue Light';
			src: url('./font/helvetica_neue_light.ttf');
		}
		@font-face {
			font-family: 'Helvetica Neue';
			src: url('./font/helvetica_neue.ttf');
		}
		@font-face {
			font-family: 'Helvetica Neue Bold';
			src: url('./font/helvetica_neue_bold.ttf');
		}
		@font-face {
			font-family: 'Helvetica';
			src: url('./font/helvetica.ttf');
		}
		@font-face {
			font-family: 'Corbel Bold';
			src: url('./font/corbel_bold.ttf');
		}
		@font-face {
			font-family: 'Calisto MT';
			src: url('./font/calisto_mt.ttf');
		}
			@font-face {
				font-family: 'Candara Bold';
				src: url('./font/candara_bold.ttf');
			}
			@font-face {
				font-family: 'Candara';
				src: url('./font/candara.ttf');
			}

		.ie          svg g.arc {
			font: 15px 'Helvetica'
		}
		.ie7         svg g.arc {
			font: 15px 'Helvetica'
		}
		.gecko       svg g.arc {
			font: 15px 'Helvetica'
		}
		.win.gecko   svg g.arc {
			font: 15px 'Helvetica'
		}
		.linux.gecko svg g.arc {
			font: 15px 'Helvetica'
		}
		.opera       svg g.arc{
			font: 15px 'Helvetica'
		}
		.konqueror   svg g.arc{
			font: 15px 'Helvetica'
		}
		/* safari*/
		.webkit      svg g.arc{
			font: 15px 'Helvetica Neue Light'
		}
		.firefox     svg g.arc{
			font: 15px 'Helvetica'
		}
		.chrome      svg g.arc{
			font: 15px 'Helvetica Neue'
		}
		body {
			font: 15px 'Helvetica Neue', 'Helvetica Neue UltraLight', 'Helvetica';
			height: 1060px;
		}
		.arc text, .up_and_down {
			cursor: pointer;
		}		
/*CSS Cursor Values implying connection to staturs type, sta, and name.*/		
		g.codon, g.arc, g#current_genetic_codon_table {
			cursor: context-menu;
		}
/*up down button information window*/
		.seq_id, .float_card {
			font-family: 'Helvetica Neue UltraLight';
		}
		g.status text.name, .status text.type, .status text.sta {
			font-family: 'Helvetica Neue Light';
		}
/*up down button information window*/
	    h2, h3, .masthead p, .subhead p, .marketing h2, .lead, .float_cell
		{
		  font-family: "Helvetica", Helvetica, Arial, "Microsoft Yahei UI", "Microsoft YaHei", SimHei, "\5B8B\4F53", simsun, sans-serif;
		  font-weight: normal;
		}
		.label .float_cell{
			font-family: "Helvetica";
		}
	    h1
		{
		  font-family: "Helvetica Neue UltraLight", Helvetica, Arial, "Microsoft Yahei UI", "Microsoft YaHei", SimHei, "\5B8B\4F53", simsun, sans-serif;
		  font-weight: normal;
		}
		/*----------------------------
			The Footer
		-----------------------------*/

		.navbar {
			opacity:0.8;
			background-color: white;
			background-image:none;
		}
		footer{
			background-color: #111111;
			opacity:0.8;
			bottom: 0;
			box-shadow: 0 -1px 2px #111111;
			height: 30px;
			left: 0;
			position: fixed;
			width: 100%;
			z-index: 100000;
		}
		footer h2{
			color: #EEEEEE;
			font:12px 'Helvetica Neue Light','Segoe UI Light','Segoe UI',Arial,sans-serif;
			font-weight: normal;
			left: 40.4%;
			margin-left: -400px;
			padding: 0px 0 0;
			position: absolute;
			width: 540px;
		}
		footer div#p-logo {
			left: 48.5%;
			position: absolute;
		}
		footer h2 i{
			font-style:normal;
			color:#888;
		}
		footer a.tzine,a.tzine:visited{
			color: #999999;
			font:12px 'Helvetica Neue Light','Segoe UI Light','Segoe UI',Arial,sans-serif;
			left: 56.5%;
			margin: 8px 0 0 110px;
			position: absolute;
			text-decoration: none;
			top: 0;
		}

		footer a i{
			color:#ccc;
			font-style: normal;
		}
		footer a i b{
			color:#c92020;
			font-weight: normal;
		}
		.regular-checkbox {
			-webkit-appearance: none;
			border: 1px solid #cacece;
			padding: 5px;
			display: inline-block;
			position: relative;
			top: -2px;
		}

		.regular-checkbox:active, .regular-checkbox:checked:active {
		}

		.regular-checkbox:checked {
			border: 1px solid #adb8c0;
			color: #99a1a7;
		}
		.regular-checkbox:disabled {
			border: 1px solid #e9ecee;
			color: #99a1a7;
		}

		.regular-checkbox:checked:after {
			content: '\2713';
			font: 16px 'Helvetica Neue UltraLight';
			position: absolute;
			top: -4px;
			left: 0px;
			color: #99a1a7;
		}
    </style>
    
    <style>
		@-moz-keyframes pulse{
			0%{		box-shadow:0 0 4px black;}
			50%{	box-shadow:0 0 8px black;}
			100%{	box-shadow:0 0 4px black;}
		}

		/* Webkit keyframe animation */
		@-webkit-keyframes pulse{
			0%{		box-shadow:0 0 4px black;}
			50%{	box-shadow:0 0 8px black;}
			100%{	box-shadow:0 0 4px black;}
		}

		input#compare_selection[type=submit], input#delete_selection[type=submit]{
			margin-left: 5px;
			margin-right: 5px;
			margin-bottom: 5px;
			height:14px;
			width: 64px;

			background: white;
			border-radius:20px;
			border:gray;
			box-shadow:0 0 2px black;
			font:10px 'Candara Bolt','Segoe UI Light','Segoe UI',Arial,sans-serif;
/*			letter-spacing:1px;*/
			cursor:pointer;
		}

    </style>
   
	<script src="js/css_browser_selector.js" type="text/javascript" charset="utf-8"></script>
  </head>

<body>
	<script src="js/CheshireCat_home.js"></script>
	

	
<!--check password;copy files;CAT;-->
	<?php
		include ("php/svg_series_php_container.php");
	?>
	<?php
		if($_FILES["file"]["name"] || $_POST["fasta_text"]){
			#创建工作路径
			$mkdir_cmd = "mkdir upload/". $gp_personID;
			exec($mkdir_cmd);
			$cmd = "cp bin/zip.php "."upload/". $gp_personID. "/";
			exec($cmd);
			
			if($_POST["fasta_text"]){
				$fasta_text = preg_split('/\r/',$_POST["fasta_text"]);

				$fp_fasta_text = fopen("upload/". $gp_personID. "/paste.fasta", 'w');
				foreach ($fasta_text as $key => $c_name) {
					fwrite($fp_fasta_text, $c_name);
				}
				
			}
			
			
			if($_FILES["file"]["name"]){
				$gp_file_path_name = "upload/$gp_personID/". $_FILES["file"]["name"];

				if ($_FILES["file"]["size"] < 200000000){
					if ($_FILES["file"]["error"] > 0){
						echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
					}
					else{


						move_uploaded_file($_FILES['file']['tmp_name'], $gp_file_path_name);
						#CAT ZhangZhang(AT)big.ac.cn
						$cmd = "bin/CAT -b 1 -c $cat_genetic_code -i $gp_file_path_name -o $gp_file_path_name.cat";
						exec($cmd);
						#echo $gp_file_path_name, "<br>";
						$cds = $gp_file_path_name;
						$cat = "$gp_file_path_name.cat";
						include("php/fasta2mysql.php");
						include("php/cat2mysql.php");

						foreach($hash_fasta as $id) {
							$recID = $id["id"];
							$cmd = "perl test.pl -id $recID -c ".$no . " -usrID ". $gp_personID;
							exec($cmd);
						}
						#echo "json2mysql Progress: done.<br>";
						#delete cat file
						$cmd = "rm $gp_file_path_name";
						exec($cmd);	
						$cmd = "rm $gp_file_path_name.cat";
						exec($cmd);
						echo '<script>d3.select("p.download_data_file").append("text").style("font-size", "14px").style("text-decoration", "none").style("color", "red").text("Download Result: ");</script>';
echo '<script>d3.select("p.fig_implementation").append("text").style("font-size", "14px").style("text-decoration", "none").style("color", "#08c").text("Implement figure into your webpage: ");</script>';
					}
				}else{
					 echo "Invalid file";
				}
			}elseif($_POST["fasta_text"]){
				$gp_file_path_name = "upload/$gp_personID/paste.fasta";
						$cmd = "bin/CAT -b 1 -c $cat_genetic_code -i $gp_file_path_name -o $gp_file_path_name.cat";
						exec($cmd);
						#echo $gp_file_path_name, "<br>";
						$cds = $gp_file_path_name;
						$cat = "$gp_file_path_name.cat";
						include("php/fasta2mysql.php");
						include("php/cat2mysql.php");

						foreach($hash_fasta as $id) {
							$recID = $id["id"];
							$cmd = "perl test.pl -id $recID -c ".$no . " -usrID ". $gp_personID;
							exec($cmd);
						}
						#echo "json2mysql Progress: done.<br>";
						#delete cat file
						$cmd = "rm $gp_file_path_name";
#						exec($cmd);	
						$cmd = "rm $gp_file_path_name.cat";
						exec($cmd);
						echo '<script>d3.select("p.download_data_file").append("text").style("font-size", "14px").style("text-decoration", "none").style("color", "red").text("Download Result: ");</script>';
echo '<script>d3.select("p.fig_implementation").append("text").style("font-size", "14px").style("text-decoration", "none").style("color", "#08c").text("Implement figure into your webpage: ");</script>';
			
			}

			$data_type = "user";
		}
		else{
			$data_type= "demo";
			if($_POST["cenus"][0]=="cat_data"){
$no = 1;
include ("php/DEMO.php");
echo '<script>d3.select("p.download_data_file").append("text").style("font-size", "14px").style("text-decoration", "none").style("color", "red").text("Download DEMO data: ");</script>';
echo '<script>d3.select("p.fig_implementation").append("text").style("font-size", "14px").style("text-decoration", "none").style("color", "#08c").text("Implement fig. based on DEMO data: ");</script>';

			}
			elseif($_POST["cenus"][0]=="tag3"){
$no = 1;
include ("php/DEMO_tag3.php");
echo '<script>d3.select("p.download_data_file").append("text").style("font-size", "14px").style("text-decoration", "none").style("color", "red").text("Download DEMO data: ");</script>';
echo '<script>d3.select("p.fig_implementation").append("text").style("font-size", "14px").style("text-decoration", "none").style("color", "#08c").text("Implement fig. based on DEMO data: ");</script>';


			}
                        elseif($_POST["cenus"][0]=="m"){
$no = 9;
include ("php/DEMO_Mycobacterium.php");
echo '<script>d3.select("p.download_data_file").append("text").style("font-size", "14px").style("text-decoration", "none").style("color", "red").text("Download DEMO data: ");</script>';
echo '<script>d3.select("p.fig_implementation").append("text").style("font-size", "14px").style("text-decoration", "none").style("color", "#08c").text("Implement fig. based on DEMO data: ");</script>';

                        }
                        elseif($_POST["cenus"][0]=="s"){
$no = 9;
include ("php/DEMO_Shewanella.php");
echo '<script>d3.select("p.download_data_file").append("text").style("font-size", "14px").style("text-decoration", "none").style("color", "red").text("Download DEMO data: ");</script>';
echo '<script>d3.select("p.fig_implementation").append("text").style("font-size", "14px").style("text-decoration", "none").style("color", "#08c").text("Implement fig. based on DEMO data: ");</script>';

                        }
			elseif($_POST["cenus"][0]=="e1"){
$no = 9;
include ("php/DEMO_dnaE1.php");
echo '<script>d3.select("p.download_data_file").append("text").style("font-size", "14px").style("text-decoration", "none").style("color", "red").text("Download DEMO data: ");</script>';
echo '<script>d3.select("p.fig_implementation").append("text").style("font-size", "14px").style("text-decoration", "none").style("color", "#08c").text("Implement fig. based on DEMO data: ");</script>';


			}
			elseif($_POST["cenus"][0]=="e2"){
$no = 9;
include ("php/DEMO_dnaE2.php");
echo '<script>d3.select("p.download_data_file").append("text").style("font-size", "14px").style("text-decoration", "none").style("color", "red").text("Download DEMO data: ");</script>';
echo '<script>d3.select("p.fig_implementation").append("text").style("font-size", "14px").style("text-decoration", "none").style("color", "#08c").text("Implement fig. based on DEMO data: ");</script>';

			}
			elseif($_POST["cenus"][0]=="e3"){
$no = 9;
include ("php/DEMO_dnaE3.php");
echo '<script>d3.select("p.download_data_file").append("text").style("font-size", "14px").style("text-decoration", "none").style("color", "red").text("Download DEMO data: ");</script>';
echo '<script>d3.select("p.fig_implementation").append("text").style("font-size", "14px").style("text-decoration", "none").style("color", "#08c").text("Implement fig. based on DEMO data: ");</script>';

			}
			else{
				if($rec_cnt && !$_POST["old_personID"]){
$data_type = "user";		
$no = $old_rec_genetic_code;
echo '<script>d3.select("p.download_data_file").append("text").style("font-size", "14px").style("text-decoration", "none").style("color", "red").text("Download Result: ");</script>';
echo '<script>d3.select("p.fig_implementation").append("text").style("font-size", "14px").style("text-decoration", "none").style("color", "#08c").text("Implement fig. based on DEMO data: ");</script>';
				}
				elseif($_POST["old_personID"]){
					$gp_personID = $_POST["old_personID"];
					$old_person_rec_cnt = 0;
					$page_rep = mysql_query("select ID,genetic_code from fasta where usrID='".$gp_personID ."'");
					while($row = mysql_fetch_array($page_rep)){
					        $old_person_rec_cnt++;
					}

					if($old_person_rec_cnt){
						$data_type = "user";
						include("php/old_person.php");
echo '<script>d3.select("p.download_data_file").append("text").style("font-size", "14px").style("text-decoration", "none").style("color", "red").text("Download Result: ");</script>';
echo '<script>d3.select("p.fig_implementation").append("text").style("font-size", "14px").style("text-decoration", "none").style("color", "#08c").text("Implement fig. based on DEMO data: ");</script>';

					}else{
						echo '<script>alert(\'Found no data under this user (ID: '. $gp_personID. '). Go on with DEMO. \');</script>';
						$no = 1;
						include ("php/DEMO_tag3.php");
echo '<script>d3.select("p.download_data_file").append("text").style("font-size", "14px").style("text-decoration", "none").style("color", "red").text("Download DEMO data: ");</script>';
echo '<script>d3.select("p.fig_implementation").append("text").style("font-size", "14px").style("text-decoration", "none").style("color", "#08c").text("Implement fig. based on DEMO data: ");</script>';

					}
				}else{
$no = 1;
include ("php/DEMO2.php");
echo '<script>d3.select("p.download_data_file").append("text").style("font-size", "14px").style("text-decoration", "none").style("color", "red").text("Download DEMO data: ");</script>';
echo '<script>d3.select("p.fig_implementation").append("text").style("font-size", "14px").style("text-decoration", "none").style("color", "#08c").text("Implement fig. based on DEMO data: ");</script>';

echo '<script>d3.selectAll("div.remove").remove();</script>';
echo '<script>d3.selectAll("p.download_data_file").remove();</script>';
echo '<script>d3.selectAll("p.fig_implementation").remove();</script>';
				}
			}
		}

echo '<script>d3.select("p.progress_bar img.progress_fig").remove();</script>';
echo '<script>d3.select("p.progress_bar").text("");</script>';
echo '<script>d3.select("p.download_data_file").append("br");</script>';
echo '<script>d3.select("p.download_data_file").append("a").style("font-size", "12px").style("cursor", "pointer").attr("class", "input_file_download").text("input fasta file");</script>';
echo '<script>d3.select("p.download_data_file").append("br");</script>';
echo '<script>d3.select("p.download_data_file").append("a").style("font-size", "12px").style("cursor", "pointer").attr("class", "cat_file_download").text("cat tsv file");</script>';      

echo '<script>d3.select("p.fig_implementation").append("br");</script>';
echo '<script>d3.select("p.fig_implementation").append("a").style("font-size", "12px").style("cursor", "pointer").attr("class", "pendulum_model_implementation").text("pendulum");</script>';
echo '<script>d3.select("p.fig_implementation").append("br");</script>';
echo '<script>d3.select("p.fig_implementation").append("a").style("font-size", "12px").style("cursor", "pointer").attr("class", "partition_model_implementation").text("partition");</script>';
		include("php/read_cloudcat.php");
		$get_seq_ids_all = mysql_query("select ID from fasta where usrID='".$gp_personID ."'");
		while($seq_id = mysql_fetch_array($get_seq_ids_all)){
        		$gp_seq_ids .= $seq_id['ID']. ",";
		}
		#echo $gp_seq_ids;
	
		$id = $gp_personID;
		$fasta = $gp_fasta;
		$user_email = $gp_personID;
		function data_type($data_type){
			echo $data_type;
		}
		function tag_group_names($tag_group_names) {
			echo $tag_group_names; 
		}
		function gp_personID($id) {
			echo $id; 
		}
		function gp_personIDen($id) {
			echo base64url_encode($id);
		}
		function gp_fasta($fasta) {
			echo $fasta; 
		}
		function gp_genetic_code_no($no) {
			echo $no;
		}
		function gp_user_email($user_email) {
			echo $user_email;
		}
		function gp_anonymous_user($password) {
			if($password == "anonymous"){
				echo 1;
			}
			else{
				echo 0;
			}
		}
			#$dir =  "upload/DEMO_tag3";
#			$command = "perl bin/cat2json.pl -cat $CAT_file.cat -dir $dir -c ".$no;
//		$gp_seq_ids;
#			$gp_seq_ids = exec($command);
		$ids = $gp_seq_ids;
		function gp_seq_ids($ids) {
			echo $ids; 
		}


	?>


<script>
	    	var codonTableNo = ["1", "2", "3", "4", "5", "6", "9", "10", "11", "12", "13", "14", "15", "16", "21", "22", "23", "24", "25"];
			d3.select("input#loginCodonTable1").on("change", showCodonTableNo);
			function showCodonTableNo(){var content = this.value;d3.selectAll("text#showCodonTableNo a").transition().duration(250).text(function(){return "Genetic Code No."+codonTableNo[content-1];});
			}
			d3.select("input#loginCodonTable2").on("change", showCodonTableNo);
			function showCodonTableNo(){var content = this.value;d3.selectAll("text#showCodonTableNo a").transition().duration(250).text(function(){return "Genetic Code No."+codonTableNo[content-1];});
			}

//	var gp_genetic_code_no = 1;
	var gp_genetic_code_no = "<?php gp_genetic_code_no ($no); ?>";
	var gp_tag_group_names = "<?php tag_group_names ($tag_group_names); ?>";
	var gp_personID   = "<?php gp_personID ($id); ?>";//console.log("User ID: "+gp_personID);
	var gp_personIDen = "<?php gp_personIDen ($id); ?>";//console.log("User IDen: "+gp_personIDen);
	var gp_fasta_file = "<?php gp_fasta ($fasta); ?>";
	var gp_seq_ids = "<?php gp_seq_ids ($ids); ?>";
	var fig_win = {};
	var gp_compare_pendulum = {};
	var gp_compare_ncbi_genetic_code_b = {};
	var gp_user_email = "<?php gp_user_email($user_email); ?>";
	var gp_cat_file = gp_fasta_file+".cat";
	//d3.select('a#upload_head').append("img").attr("src", "img/on.gif").attr("align", "right");
	d3.select('a#upload_head').on("click", function(){
		d3.select('a#upload_head').select("img").remove();	
	});
	d3.tsv("php/tag.js.sql.php?usrID="+gp_personIDen, function(tag_group) {
		if(tag_group.length>1){
			d3.select('a#tag_stack_head').append("img").attr("src", "img/on.gif").attr("align", "right");
		}	
	});
		d3.select('a#tag_stack_head').on("click", function(){
			d3.select('a#tag_stack_head').select("img").remove();
		});

		d3.select("p.anonymous").text("ID: "+gp_user_email);	
	d3.select("a.input_file_download").on("click", function(){
				$("a.input_file_download")
				.load(
					"upload/"+gp_personID+"/zip.php",{ 
						gp_fasta_file: gp_fasta_file,
						file_type: "input",
						gp_personID: gp_personID,
					},
					function(){
						setTimeout(function(){
//							$.fileDownload("upload/"+gp_personID+"/"+gp_fasta_file+".zip")
							$.fileDownload("upload/"+gp_personID+"/input.fasta.zip")
								.done(function () {})
								.fail(function () {});
						},500);
					}
				);
	
		});
	d3.select("a.cat_file_download").on("click", function(){
				$("a.cat_file_download")
				.load(
					"upload/"+gp_personID+"/zip.php",{ 
						gp_fasta_file: gp_fasta_file,
						file_type: "cat",
						gp_personID: gp_personID,
					},
					function(){
						setTimeout(function(){
//							$.fileDownload("upload/"+gp_personID+"/"+gp_fasta_file+".cat.zip")
							$.fileDownload("upload/"+gp_personID+"/data.cat.zip")
								.done(function () {})
								.fail(function () {});
						},50);
					}
				);
	
		});
	d3.select("a.pendulum_model_implementation").on("click", function(){
		$("a.pendulum_model_implementation")
			.load(
					"upload/"+gp_personID+"/zip.php",{ 
						gp_fasta_file: gp_fasta_file,
						file_type: "pendulum_model_implementation",
						gp_personID: gp_personID,
						},
						function(){
							setTimeout(function(){
								$.fileDownload("upload/"+gp_personID+"/pendulum_model_implementation.zip")
									.done(function () {})
									.fail(function () {});
								},50);
							}
			);

	});
	d3.select("a.partition_model_implementation").on("click", function(){
		$("a.partition_model_implementation")
			.load(
					"upload/"+gp_personID+"/zip.php",{ 
						gp_fasta_file: gp_fasta_file,
						file_type: "partition_model_implementation",
						gp_genetic_code_no: gp_genetic_code_no,
						gp_personID: gp_personID,
						},
						function(){
							setTimeout(function(){
								$.fileDownload("upload/"+gp_personID+"/partition.zip")
									.done(function () {})
									.fail(function () {});
								},50);
							}
			);

	});


	d3.select("a.reset_demo").on("click", function(){
				$("a.reset_demo")
				.load(
					"upload/"+gp_personID+"/del_id_rm.php",{ 
						parameter: "ok",
					}
				);
					setTimeout(function(){
						document.location.reload();
					},5);

		});
	
d3.tsv("php/tag.js.sql.php?usrID="+gp_personIDen, function(tag_group) {
	var tag_group_member_cnt = [];
	for(var tag_group_no = 0; tag_group_no<tag_group.length; tag_group_no++){
			tag_group_head = d3.select("div.column").append("div").attr("class", "portlet ui-widget ui-widget-content ui-helper-clearfix ui-corner-all").attr("ID", function(){return tag_group[tag_group_no].tag_group});
			tag_group_head.append("div").attr("class", "portlet-header ui-widget-header ui-corner-all").attr("ID", function(){return tag_group[tag_group_no].tag_group}).text(tag_group[tag_group_no].tag_group);
			tag_group_container = tag_group_head.append("div").attr("class", "portlet-content").attr("ID", function(){return tag_group[tag_group_no].tag_group}).style({"display": "none"});
			var tags = tag_group[tag_group_no].tag.split(",");
			tag_group_member_cnt.push(tags.length);
			for(var tag_no = 0; tag_no<tags.length; tag_no++){
				tag_group_container.append("li").text(tags[tag_no]);
			}
	}
			tag_group_member_cnt_max = Math.max.apply(Math, tag_group_member_cnt);
			if(tag_group_member_cnt_max<2){
				$('input.tag_compare').prop('disabled', true);
				d3.select('input.tag_compare').style("box-shadow", "0 0 2px black");
			}
	
});

		$(function() {
			$( ".column" ).sortable({
				connectWith: ".column"
			});
			$( ".portlet" ).addClass( "ui-widget ui-widget-content ui-helper-clearfix ui-corner-all" )
			.find( ".portlet-header" )
			.addClass( "ui-widget-header ui-corner-all" )
			.prepend( "<span class='ui-icon ui-icon-minusthick'></span>")
			.end()
			.find( ".portlet-content" );
			$( ".portlet-header .ui-icon" ).click(function() {
				$( this ).toggleClass( "ui-icon-minusthick" ).toggleClass( "ui-icon-plusthick" );
				$( this ).parents( ".portlet:first" ).find( ".portlet-content" ).toggle();
			});
			$( ".column" ).disableSelection();
		});

	var sorted_tag_group_name = [];
	var sorted_tag_group_name_id = [];
//	var tag_group_name = ["species", "tissue", "phylogeny"];
//	var tag_group_name = ["group_0", "group_1", "group_2"];
	var tag_group_name = gp_tag_group_names.split(",");
	//console.log("gp_tag_group_names: ",gp_tag_group_names);

	$(".column" ).on( "sortchange", function(err){});

	$("input.tag_compare").click(function(err){
		sorted_tag_group_name_id = [];
		sorted_tag_group_name = test_div_name(err);
		sorted_tag_group_name.forEach( function(new_n){
			var reg  = /\d+$/;
			var output = reg.exec(new_n);
			sorted_tag_group_name_id.push(output[0]);
		});
//		console.log(sorted_tag_group_name_id);
//		window.open("../wheel/tag_wheel.php","width=200,height=100");
//		window.open("../dynamic_web/wheel/tag_wheel.php?tag_group="+sorted_tag_group_name_id+"&ID="+gp_personID);
		window.open("php/tag_wheel.php?tag_group="+sorted_tag_group_name_id+",&ID="+gp_personID+"&gp_fasta_file="+gp_fasta_file+"&gp_genetic_code_no="+gp_genetic_code_no);

	});

	function test_div_name(err){
		var array = [];
	  	var div_name = d3.selectAll("div.portlet-header");
	  	div_name[0].forEach(function(d){
	  		id = $(d).attr("id");
	  		array.push(id);
	  	});
	  	return array;
  	}





    var count_cat_file_rec_no = "upload/"+gp_personID+"/"+gp_cat_file;//console.log(count_cat_file_rec_no);
    	var gp_data_type = "<?php data_type($data_type);  ?>";
	//console.log(gp_data_type);
	if(gp_data_type=="user"){d3.select("text.data_type").text("User's Data.");}
	else if(gp_data_type=="demo"){d3.select("text.data_type").text("Using DEMO Data.");}
	else{d3.select("text.data_type").text("Using DEMO Data.");}
	d3.tsv("php/sortable_table.js.sql.php?usrID="+gp_personIDen, function(d) {var cat = d;	var count_info = d3.select("text.general_info").text(function(d){ return cat.length});});
//    	var gp_files = ["b0001", "b0002", "b0003"];
    	var gp_files = gp_seq_ids.split(",");gp_files.pop();console.log(gp_files);
    	var gp_files_stringLgth = [];
    	gp_files.forEach(function(d){
    		gp_files_stringLgth.push(+d.length);
    		});
		gp_files_stringLgth_max = Math.max.apply(Math, gp_files_stringLgth);
		var gp_fig_type = ["pdf", "png", "ps", "svg"];//, "tiff"

	function fig_download(select_class, x, y, fig_win_if) {
		var download_text = d3.select("."+select_class+" svg").append("g").attr("class", "download");
		transform_x = x-22;
		download_text.append("g")
			.attr("transform", "translate(" + transform_x + "," + y + ")")
			.attr({"cursor": "default",})
			.append('path').attr({"id":"fig_icon",
							"opacity": 0.5,"fill": "gray", "d": "M17.145,1H4.868C2.735,1,1,2.735,1,4.868v4.085v8.193c0,2.134,1.735,3.868,3.868,3.868h12.279c2.131,0,3.866-1.734,3.866-3.868V8.953V4.868C21.013,2.734,19.278,1,17.145,1z M18.255,3.307l0.442-0.002v0.439v2.952l-3.38,0.011l-0.013-3.392L18.255,3.307z M8.151,8.953c0.641-0.887,1.68-1.468,2.854-1.468c1.176,0,2.217,0.582,2.856,1.468c0.416,0.579,0.668,1.287,0.668,2.054c0,1.942-1.583,3.522-3.524,3.522c-1.942,0-3.521-1.58-3.521-3.522C7.485,10.24,7.733,9.532,8.151,8.953z M19.064,17.146c0,1.059-0.861,1.918-1.919,1.918H4.868c-1.058,0-1.918-0.859-1.918-1.918V8.953h2.987c-0.258,0.635-0.403,1.328-0.403,2.054c0,3.019,2.456,5.475,5.473,5.475c3.02,0,5.474-2.456,5.474-5.475c0-0.726-0.146-1.419-0.403-2.054h2.988L19.064,17.146L19.064,17.146z",
							});
//							
		transform_x = x-20;
		transform_y = y+80;
		if(fig_win_if=="yes"){
			var compare = download_text.append("g")
				.attr("transform", "translate(" + transform_x + "," + transform_y + ")")
				.attr({"cursor": "pointer","class": "fig_win",})
						.on("mouseover", function(d){
							d3.select(this).selectAll('path').attr({"opacity": 0.8});
						})
						.on("mouseout", function(d){
							d3.select(this).selectAll('path').attr({"opacity": 0.5});
						})
						.on("click", function(){
							tag_name = d3.select("li#codon_table.active a").text();
							d3.select("g.float_cell").remove();
							svg_code = show_svg_code(select_class);
							svg_code = svg_code.replace(/<g class=\"download[\s\S]+?class=\"svg[\s\S]+?<\/g\>/g, "");
							if(tag_name=="Pendulum model"){
								svg_code = svg_code.replace(/<text class=\"name[\s\S]+?class=\"down[\s\S]+?<g class=\"arc/g, /<g class=\"arc/);
							}
							else if(tag_name=="Partition"){
								svg_code = svg_code.replace(/<text class=\"name[\s\S]+?class=\"down[\s\S]+?<g class=\"table/g, /<g class=\"table/);
							}else{
								svg_code = svg_code.replace(/<g class=\"status[\s\S]+?class=\"down[\s\S]+?<g class=\"ncbi_genetic_code_0/g, /<g class=\"ncbi_genetic_code_0/);
							}
							fig_id = select_class+"-"+gp_files[gp_rec_no];
							fig_win[fig_id] = svg_code;

							window.open("php/fig.php?fig_id="+fig_id+"&fig=on",
								"_blank",
								"toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=no, copyhistory=yes, width=600, height=570",
								false
							);
						});
				
		compare.append("circle")
				.attr({
					"id":"fig_win",
					"cy": "10",
					"cx": "10",
					"r": "10",
					"fill": "white",
					"stroke": "none",
					"opacity": 0
				});

				compare.append('path').attr({"id":"fig_win",
								"opacity": 0.5,"fill": "gray", "d": "M18.25,0H4.562v4.562c-1.657,0-4.562,0-4.562,0V18.25h13.688v-4.562h4.562V0z M11.406,15.969H2.281V9.125h2.281v4.562h6.844C11.406,14.708,11.406,15.969,11.406,15.969z M15.969,11.406H6.844V4.562h9.125V11.406z",
						});
		}

	//
		gp_fig_type.forEach(function(d, i){
		download_text
			.append("text")
			.style({
				"font-family": "Helvetica Neue Light",
				"font-size": "10px",
				"text-anchor": "end",
				"fill": "lightgray",
			})
			.attr("class",d)
			.attr("x",x-2)
			.attr("y",y+10+12*(i+2))
			.attr({"cursor": "pointer"})
			.text(d)
			.on("mouseover", function(d){
				d3.select(this).style({"fill": "red"});
			})
			.on("mouseout", function(d){
				d3.select(this).style({"fill": "lightgray"});
			})
			.on("click", function(){
				info_pane_pclass = d3.select(this.parentNode.parentNode.parentNode).attr("class");
				info_pane = "div."+info_pane_pclass+" p#format";
				$(info_pane).text("Creating figure. Please wait. ");
				d3.select(info_pane).append("img").attr("src", "img/loading.gif");

				d3.select("g.float_cell").remove();
				var svg_code = show_svg_code(select_class);
				svg_code = svg_code.replace(/<g class=\"download[\s\S]+?class=\"svg[\s\S]+?<\/g\>/g, "");//\<g class=\"download\"\>.*\<\/g\>//			console.log(svg_code);
	/*	*/		
	//comunicate with php, powered by jquery.==============================================================================================================================================================
				var fig_name = "fig/cat.big.ac.cn_id"+gp_personID+"/"+gp_files[gp_rec_no]+"_"+select_class;
				d3.select(this).attr("href",fig_name+"."+d+".zip");
//				console.log(info_pane);
				$(info_pane)
				.load(
					'fig/rsvg.php',{ 
						fig_type : d, //pdf, png, svg, ps
						svg_code : svg_code, 
						//	fig/1/b0001/pendulum_model
						//	fig
						gp_personID: gp_personID,
						gp_file_name: gp_files[gp_rec_no],
						select_class: select_class
					},
					function(){
						d3.select(info_pane).append("img").attr("src", "img/loading.gif");
	//					$('a#format').empty();
/*
						show_confirm();
						function show_confirm(){
							var r=confirm("Automatic download the figure?");
							if(r==true){
								setTimeout(function(){
									$.fileDownload(fig_name+"."+d+".zip")
										.done(function () { d3.select(info_pane).select("img").remove(); })
										.fail(function () { alert('Server busy! Wait for a few seconds and try again.'); });
									$(info_pane).empty();
								},50);
							}
							else{
								$(info_pane).empty();
								d3.select(info_pane).append("a").attr("href",fig_name+"."+d).text("Download "+d);
							}
						}
*/						
								setTimeout(function(){
									$.fileDownload(fig_name+"."+d+".zip")
										.done(function () { d3.select(info_pane).select("img").remove(); })
										.fail(function () { alert('Server busy! Wait for a few seconds and try again.'); });
									$(info_pane).empty();
								},50);
						
					}
				);
	/**/
			});
		
		});
	}
//read the twitter bootstrap api document@http://getbootstrap.com/2.3.2/javascript.html#tabs: Events.
	//每次选中都会触发一次动作事件，可以用来更新表格
		$('a[data-toggle="tab"]').on('shown', function (e) {
			//console.log(e.target);
			tag_name = d3.select(e.target).text();

			rows = d3.selectAll("div.row div.record_list table tbody tr");
			rows[0].forEach(function(d){
				row_recID = d3.select(d).attr("class");
				if(tag_name=="Pendulum model"){
					$('input#'+row_recID).prop('disabled', false);
					if(gp_compare_pendulum[row_recID]){
						$('input#'+row_recID).prop('checked', true);

					}else{
						$('input#'+row_recID).prop('checked', false);
					}
				}
				else if(tag_name=="Partition"){
					$('input#'+row_recID).prop('disabled', false);
					if(gp_compare_ncbi_genetic_code_b[row_recID]){
						$('input#'+row_recID).prop('checked', true);
					}else{
						$('input#'+row_recID).prop('checked', false);
					}
				}
				else if(tag_name=="NCBI: The Genetic Codes"){
						$('input#'+row_recID).prop('checked', false);
						$('input#'+row_recID).prop('disabled', true);
				}
			});

		});

</script>
<script src="js/datadumper.js"></script>
<script src="js/pendulum_model.js"></script>
<script src="js/js_before_footer.js"></script>
<script src="js/sortable_table.js"></script>
<script src="js/genetic_code_a.js"></script>
<script src="js/genetic_code_b.js"></script>
<script src="js/bar_chart_gc.js"></script>
<script src="js/bar_chart_gc1.js"></script>
<script src="js/bar_chart_gc2.js"></script>
<script src="js/bar_chart_gc3.js"></script>
<script src="js/bar_chart_ag.js"></script>
<script src="js/bar_chart_ag1.js"></script>
<script src="js/bar_chart_ag2.js"></script>
<script src="js/bar_chart_ag3.js"></script>
<script src="js/bar_chart_length.js"></script>
<script src="js/bar_chart_cdc.js"></script>
<script src="js/rscu_aa.js"></script>
<!--<script src="js/scatterplot.js"></script>-->
<?php
	include ("php/svg_series_php_footer.php");
?>
</body>

</html>

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <title>CCAT | Codon Table</title>
	<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />
	<link rel="Bookmark" href="img/favicon.ico" />


    <link href="css/bootstrap.min.css"            rel="stylesheet">
    <link href="css/bootstrap-responsive.min.css" rel="stylesheet">

    <link href="css/sortable_table.css"           rel="stylesheet">
    <link href="css/horizontal.css"               rel="stylesheet">
    <link href="css/prettify.css"                 rel="stylesheet">
    
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
			height:600px;
    	}
		div.canvas_cat {
			-webkit-filter: blur(7px);
			top:10%;
			left:450px;
			position:absolute;
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
			width: 360px;
			height: 600px;
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
			font: 15px 'Helvetica', 'Helvetica Neue UltraLight', 'Helvetica Neue';
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
			height: 45px;
			left: 0;
			position: fixed;
			width: 100%;
			z-index: 100000;
		}
		footer h2{
			color: #EEEEEE;
			font:16px 'Helvetica Neue Light','Segoe UI Light','Segoe UI',Arial,sans-serif;
			font-weight: normal;
			left: 40.4%;
			margin-left: -400px;
			padding: 5px 0 0;
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
			font:16px 'Helvetica Neue Light','Segoe UI Light','Segoe UI',Arial,sans-serif;
			left: 56.5%;
			margin: 16px 0 0 110px;
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
  </head>

<body>
<div class="container">
	<div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="brand" href="home.php"  style="color:gray;">Cloud CAT</a>
          <div class="nav-collapse collapse">
            <ul class="nav">

			<li class="dropdown" style="color:gray;">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" style="color:gray;">HELP</a>
				<ul class="dropdown-menu">
					<li><a target="view_window" href="help.php">Help</a></li>
					<li><a target="view_window" href="help.php#introduction">Introduction</a></li>
					<li><a target="view_window" href="help.php#inputfile">Prepare Input</a></li>
					<li><a target="view_window" href="help.php#output">Outputs</a></li>
					<li><a target="view_window" href="help.php#visualization">Visualizations</a></li><!--
					<li><a target="view_window" href="http://cat.big.ac.cn/svg_demo_tag3.php">Live DEMO</a></li>-->
					<li><a target="view_window" href="help.php#contact">Contact us</a></li>
					
				</ul>
			</li>

              <li class="">
                <a href="demo/Resources/index.php" style="color:gray;">DEMO</a>
              </li>
            </ul>
          </div>
			<p class="anonymous" style="font-size:15px;color:steelblue;text-decoration: none;text-align:right;padding-top: 10px;padding-left: 15px;padding-right: 15px;margin-bottom: 0px;"></p>          
        </div>
      </div>
    </div>
	    <script>
			$("a#account_setting").click(function(){
				window.open("account_setting.php");
			});
		</script>
	<br>
	<br>
	<br>
	<h1>NCBI: The Genetic Codes</h1>
	<p class="lead" style="font-size:16px">See all the difference between all 19 sets of genetic codes (based on <a href="http://www.ncbi.nlm.nih.gov/Taxonomy/taxonomyhome.html/index.cgi?chapter=cgencodes">NCBI: The Genetic Codes</a>). 
	Red font color indicates your current data's code.</p>
	<div align="center" class="ncbi_genetic_code_a" id="ncbi_genetic_code_a">
	
</div>

<script>
var width = 600;
var height = 600;
var gp_files = window.opener.gp_files;
var gp_genetic_code_no = window.opener.gp_genetic_code_no;
</script>
<script src="js/genetic_code_a.js"></script>


        <footer>
        	<h2><i>&copy;<?php echo date("Y");?> <a href="http://cbb.big.ac.cn" target="view_window">CBB</a>@<a href="http://english.big.cas.cn" target="view_window">BIG</a></i><i>    </i>
        	<a style="color:DodgerBlue">C</a>loud <a style="color:LightCoral">C</a>omposition <a style="color:LightCoral">A</a>nalysis <a style="color:LightCoral">T</a>oolkit</h2>

        	<div id="p-logo"><a href="http://cbb.big.ac.cn"><img src="img/Cbb-logo.png" style="width:40px;height:40px"></a></div>
        	<a class="tzine" href="help.php" target="view_window">Head on to <i><b>Help page</b></i> for details.</a>
	</footer>


</body>

</html>

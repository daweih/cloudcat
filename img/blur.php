<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Blur</title>

		<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />
		<link rel="Bookmark" href="favicon.ico" />
        
        <!-- Our CSS stylesheet file -->
		<style>
			img#background{
				top:-20px;
				left:-20px;
				position:absolute;
				-webkit-filter: blur(5px);
			}
			body{
				position:absolute;
				width: 1400px;
				height: 700px;
				min-height: 700px;
			}
		</style>        
        
    </head>
    
    <body>
		<script src="../../d3/d3.v3.js"></script>
	    <img id="background" src="0.png">
		<?php
			session_start();
			if(isset($_SESSION['usr_id']))
			  $_SESSION['usr_id']=$_SESSION['usr_id']+1;
			else
			  $_SESSION['usr_id']=1;
			$usr_id = $_SESSION['usr_id']%10;
			function usr_id ($usr_id) {echo $usr_id;}
		?>
    	

	    <script>
	    	d3.select("img").attr("src", function(){var no = "<?php usr_id ($usr_id); ?>";console.log(no+".jpg");return "now.png";});
	    </script>

    </body>
</html>


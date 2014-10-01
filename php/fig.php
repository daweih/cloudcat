<html>
    <head>
        <meta charset="utf-8" />
		<title>Cloud CAT | Figure</title>
		<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />
		<link rel="Bookmark" href="img/favicon.ico" />
		<script src="js/jquery.min.js"></script>
		<script src="../d3/d3.v3.min.js"></script>
		<style>
			@font-face {
				font-family: 'Helvetica Neue UltraLight';
				src: url('font/helvetica_neue_ultralight.ttf');
			}
			@font-face {
				font-family: 'Helvetica Neue Light';
				src: url('font/helvetica_neue_light.ttf');
			}
			@font-face {
				font-family: 'Helvetica';
				src: url('font/helvetica.ttf');
			}
			@font-face {
				font-family: 'Helvetica Neue Bold';
				src: url('font/helvetica_neue_bold.ttf');
			}
			@font-face {
				font-family: 'Corbel Bold';
				src: url('font/corbel_bold.ttf');
			}
			@font-face {
				font-family: 'Calisto MT';
				src: url('font/calisto_mt.ttf');
			}
			@font-face {
				font-family: 'Candara Bold';
				src: url('font/candara_bold.ttf');
			}
			@font-face {
				font-family: 'Candara';
				src: url('font/candara.ttf');
			}
			
		text.seq_id {
			font: 25px 'Helvetica Neue UltraLight','Segoe UI',Arial,sans-serif;
		}
		</style>
    </head>    
    <body>
    	<div class="fig" align="center">
    	</div>
    </body>
		<?php
			$fig_id = $_GET['fig_id'];
			function fig_id($fig_id){
				echo $fig_id;
			}
		?>
	    <script>
	    fig_id = "<?php fig_id($fig_id); ?>";
		$('body div.fig').append(window.opener.fig_win[fig_id]);
		svg_width = d3.select("body div.fig svg").attr("width");
		console.log(svg_width);
		d3.select("body div.fig").style({"zoom": function(){ return 520/svg_width;}});

		d3.selectAll("svg.pendulum_model g.transform g.status text.seq_id").attr({"dy":"0.3em"}).style({"font-size":""});

		d3.selectAll("svg.ncbi_genetic_code_b g.transform g.status text.seq_id").attr({"dy": -150}).style({"font-size":""});
		d3.selectAll("svg.ncbi_genetic_code_b").attr({"height": "500px"});
		d3.selectAll("svg.ncbi_genetic_code_b g.transform").attr({"transform": "translate(300,200)"});

		d3.selectAll("svg.ncbi_genetic_code_a").attr({"height": "700px"});
		d3.selectAll("svg.ncbi_genetic_code_a g.transform").attr({"transform": "translate(375,160)"});
	    </script>

</html>

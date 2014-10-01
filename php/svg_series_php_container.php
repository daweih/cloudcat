<link rel="stylesheet" href="css/input_range.css">
<script src="js/google_analytic.js"></script>
<div class="container">
	<div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner"  style="height: 40px;">
      
        <div class="container">
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a target="view_window" class="brand" href="home.php"  style="color:gray;padding-right: 0px;" title="Go back to the login page.">
          	<img class="progress_fig" src="img/favicon.ico" style="height: 30px;">
          Cloud CAT
          	<text style="color:black;font-size:12px;font-family:Helvetica Neue;">- A cloud application for analysis and visualization of molecular sequence composition.</text>
          </a>
          
          <div class="nav-collapse collapse">
            <ul class="nav" style="float:right;font-size:10px;padding-top:5px;">

			<li class="dropdown" style="color:gray;">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" style="color:gray;">HELP ▾</a>
				<ul class="dropdown-menu">
				<li><a id="help_page" href="#">Help</a></li>
				<li><a id="help_page_introduction" href="#">Introduction</a></li>
				<li><a id="help_page_input" href="#">Prepare Input</a></li>
				<li><a id="help_page_output" href="#">Outputs</a></li>
				<li><a id="help_page_viz" href="#">Visualizations</a></li>
				<li><a id="report_page" href="#">Report</a></li>
				<li><a id="help_page_contact" href="#">Contact us</a></li>
	
				</ul>
			</li>

              <li class="">
<!--                <a target="view_window" href="demo/Resources/index.php" style="color:gray;" title="A video DEMO on how to use this web server.">DEMO</a>-->
              </li>
              <li class="">
                <a target="view_window" href="#" style="color:gray;" id="ncbi_the_genetic_code" title="To the the difference between all the genetic codes.">NCBI: The Genetic Code</a>
              </li>
              <li class="">
<p class="anonymous" style="font-size:10px;color:steelblue;text-decoration: none;text-align:right;padding-top: 10px;padding-left: 15px;padding-right: 15px;margin-bottom: 0px;"></p>          
<!--              <a id="format" style="font-size: 16px;color:steelblue"></a>-->
              </li>


            </ul>
          </div>
			
        </div>
      </div>
    </div>
	    <script>
			$("a#ncbi_the_genetic_code").click(function(){
				window.open("ncbi_the_genetic_code.php");
			});
				$("a#help_page").click(function(){              window.open("help.php");});
				$("a#help_page_introduction").click(function(){ window.open("help.php#introduction");});
				$("a#help_page_input").click(function(){        window.open("help.php#inputfile");});
				$("a#help_page_output").click(function(){       window.open("help.php#output");});
				$("a#help_page_viz").click(function(){          window.open("help.php#visualization");});
				$("a#report_page").click(function(){            window.open("report.php?hp_cnt=10");});
				$("a#help_page_contact").click(function(){      window.open("help.php#contact");});

		</script>
	<br><br><br>
<!--	<h3 style="font-family:Helvetica Neue UltraLight;margin-bottom: 0px;">Codon Table</h3>
	<p class="lead" style="font-size:14px;margin-bottom: 10px;">Interactive visualization of your CDSs' composition.-->
	<p class="lead" style="font-size:14px;margin-bottom: 10px;">

	<p class="progress_bar" style="font-size:14px;margin-bottom: 10px;color:#08c;">Status: running.<img class="progress_fig" src="img/loading.gif"></p>
	<div class="row" style="width:1100px;">

		<div class="span4 bs-docs-sidebar">
			<section id="collapse">
				<div class="bs-docs-example">
				  <div class="accordion" id="accordion0">
					<div class="accordion-group">
					  <div class="accordion-heading">
						<a id="input_head" class="accordion-toggle" data-toggle="collapse" data-parent="#accordion0" href="#input" style="height: 10px;font-size:12px" title="Start here">
							Input Sequence
						</a>
					  </div>
					  <div id="input" class="panel-collapse collapse in" style="">
						<div class="accordion-inner">

			<section id="tabs">
				<div class="bs-docs-example">
					<ul id="myTab_usr" class="nav nav-tabs" style="font-size:12px;margin-bottom: 10px;">
						<li class="active"><a href="#tab_seq_win" data-toggle="tab" style="padding: 2px 8px;">Analysis</a></li>
						<li>               <a href="#tab_upload" data-toggle="tab" style="padding: 2px 8px;">Upload</a>     </li>
						<li>               <a href="#tab_download" data-toggle="tab" style="padding: 2px 8px;">Download</a>     </li>
						<li>               <a href="#tab_demo" data-toggle="tab" style="padding: 2px 8px;">DEMO</a>     </li>
					</ul>
					<div id="myTabContent_usr" class="tab-content" style="min-height: 230px;">
						<div class="tab-pane fade in active" id="tab_seq_win" style="min-height: 220px;">
							<form id="form_fasta_text" name="form_fasta_text" method="post" action="home.php">
							<textarea name="fasta_text" wrap="virtual" class="paste_fasta" placeholder="Insert your sequences in FASTA format"></textarea>
								<a class="load_fasta_text_demo" style="font-size:14px;margin-left: 2px;">example</a>
								<br>
								<text id="showCodonTableNo" style="font-size: 12px;margin-left: 2px;"><a href="http://www.ncbi.nlm.nih.gov/Taxonomy/taxonomyhome.html/index.cgi?chapter=cgencodes" target="view_window" style="text-decoration: none;color:#08c">Genetic Code No.1</a></text>
								<br>
								<input type="range" name="loginCodonTable" id="loginCodonTable1" min="1" max="19" value="1">
								<br>
							<input id="file_submit" type='submit' value="START" title="GO" style=""/>
							</form>
							
							<script>
								d3.select("a.load_fasta_text_demo").on("click", function(){
									d3.select("textarea.paste_fasta").text(">b0001\rATGAAACGCATTAGCACCACCATTACCACCACCATCACCATTACCACAGGTAACGGTGCGGGCTGA\r>b0002\rATGCGAGTGTTGAAGTTCGGCGGTACATCAGTGGCAAATGCAGAACGTTTTCTGCGTGTTGCCGATATTCTGGAAAGCAATGCCAGGCAGGGGCAGGTGGCCACCGTCCTCTCTGCCCCCGCCAAAATCACCAACCACCTGGTGGCGATGATTGAAAAAACCATTAGCGGCCAGGATGCTTTACCCAATATCAGCGATGCCGAACGTATTTTTGCCGAACTTTTGACGGGACTCGCCGCCGCCCAGCCGGGGTTCCCGCTGGCGCAATTGAAAACTTTCGTCGATCAGGAATTTGCCCAAATAAAACATGTCCTGCATGGCATTAGTTTGTTGGGGCAGTGCCCGGATAGCATCAACGCTGCGCTGATTTGCCGTGGCGAGAAAATGTCGATCGCCATTATGGCCGGCGTATTAGAAGCGCGCGGTCACAACGTTACTGTTATCGATCCGGTCGAAAAACTGCTGGCAGTGGGGCATTACCTCGAATCTACCGTCGATATTGCTGAGTCCACCCGCCGTATTGCGGCAAGCCGCATTCCGGCTGATCACATGGTGCTGATGGCAGGTTTCACCGCCGGTAATGAAAAAGGCGAACTGGTGGTGCTTGGACGCAACGGTTCCGACTACTCTGCTGCGGTGCTGGCTGCCTGTTTACGCGCCGATTGTTGCGAGATTTGGACGGACGTTGACGGGGTCTATACCTGCGACCCGCGTCAGGTGCCCGATGCGAGGTTGTTGAAGTCGATGTCCTACCAGGAAGCGATGGAGCTTTCCTACTTCGGCGCTAAAGTTCTTCACCCCCGCACCATTACCCCCATCGCCCAGTTCCAGATCCCTTGCCTGATTAAAAATACCGGAAATCCTCAAGCACCAGGTACGCTCATTGGTGCCAGCCGTGATGAAGACGAATTACCGGTCAAGGGCATTTCCAATCTGAATAACATGGCAATGTTCAGCGTTTCTGGTCCGGGGATGAAAGGGATGGTCGGCATGGCGGCGCGCGTCTTTGCAGCGATGTCACGCGCCCGTATTTCCGTGGTGCTGATTACGCAATCATCTTCCGAATACAGCATCAGTTTCTGCGTTCCACAAAGCGACTGTGTGCGAGCTGAACGGGCAATGCAGGAAGAGTTCTACCTGGAACTGAAAGAAGGCTTACTGGAGCCGCTGGCAGTGACGGAACGGCTGGCCATTATCTCGGTGGTAGGTGATGGTATGCGCACCTTGCGTGGGATCTCGGCGAAATTCTTTGCCGCACTGGCCCGCGCCAATATCAACATTGTCGCCATTGCTCAGGGATCTTCTGAACGCTCAATCTCTGTCGTGGTAAATAACGATGATGCGACCACTGGCGTGCGCGTTACTCATCAGATGCTGTTCAATACCGATCAGGTTATCGAAGTGTTTGTGATTGGCGTCGGTGGCGTTGGCGGTGCGCTGCTGGAGCAACTGAAGCGTCAGCAAAGCTGGCTGAAGAATAAACATATCGACTTACGTGTCTGCGGTGTTGCCAACTCGAAGGCTCTGCTCACCAATGTACATGGCCTTAATCTGGAAAACTGGCAGGAAGAACTGGCGCAAGCCAAAGAGCCGTTTAATCTCGGGCGCTTAATTCGCCTCGTGAAAGAATATCATCTGCTGAACCCGGTCATTGTTGACTGCACTTCCAGCCAGGCAGTGGCGGATCAATATGCCGACTTCCTGCGCGAAGGTTTCCACGTTGTCACGCCGAACAAAAAGGCCAACACCTCGTCGATGGATTACTACCATCAGTTGCGTTATGCGGCGGAAAAATCGCGGCGTAAATTCCTCTATGACACCAACGTTGGGGCTGGATTACCGGTTATTGAGAACCTGCAAAATCTGCTCAATGCAGGTGATGAATTGATGAAGTTCTCCGGCATTCTTTCTGGTTCGCTTTCTTATATCTTCGGCAAGTTAGACGAAGGCATGAGTTTCTCCGAGGCGACCACGCTGGCGCGGGAAATGGGTTATACCGAACCGGACCCGCGAGATGATCTTTCTGGTATGGATGTGGCGCGTAAACTATTGATTCTCGCTCGTGAAACGGGACGTGAACTGGAGCTGGCGGATATTGAAATTGAACCTGTGCTGCCCGCAGAGTTTAACGCCGAGGGTGATGTTGCCGCTTTTATGGCGAATCTGTCACAACTCGACGATCTCTTTGCCGCGCGCGTGGCGAAGGCCCGTGATGAAGGAAAAGTTTTGCGCTATGTTGGCAATATTGATGAAGATGGCGTCTGCCGCGTGAAGATTGCCGAAGTGGATGGTAATGATCCGCTGTTCAAAGTGAAAAATGGCGAAAACGCCCTGGCCTTCTATAGCCACTATTATCAGCCGCTGCCGTTGGTACTGCGCGGATATGGTGCGGGCAATGACGTTACAGCTGCCGGTGTCTTTGCTGATCTGCTACGTACCCTCTCATGGAAGTTAGGAGTCTGA\r>b0003\rATGGTTAAAGTTTATGCCCCGGCTTCCAGTGCCAATATGAGCGTCGGGTTTGATGTGCTCGGGGCGGCGGTGACACCTGTTGATGGTGCATTGCTCGGAGATGTAGTCACGGTTGAGGCGGCAGAGACATTCAGTCTCAACAACCTCGGACGCTTTGCCGATAAGCTGCCGTCAGAACCACGGGAAAATATCGTTTATCAGTGCTGGGAGCGTTTTTGCCAGGAACTGGGTAAGCAAATTCCAGTGGCGATGACCCTGGAAAAGAATATGCCGATCGGTTCGGGCTTAGGCTCCAGTGCCTGTTCGGTGGTCGCGGCGCTGATGGCGATGAATGAACACTGCGGCAAGCCGCTTAATGACACTCGTTTGCTGGCTTTGATGGGCGAGCTGGAAGGCCGTATCTCCGGCAGCATTCATTACGACAACGTGGCACCGTGTTTTCTCGGTGGTATGCAGTTGATGATCGAAGAAAACGACATCATCAGCCAGCAAGTGCCAGGGTTTGATGAGTGGCTGTGGGTGCTGGCGTATCCGGGGATTAAAGTCTCGACGGCAGAAGCCAGGGCTATTTTACCGGCGCAGTATCGCCGCCAGGATTGCATTGCGCACGGGCGACATCTGGCAGGCTTCATTCACGCCTGCTATTCCCGTCAGCCTGAGCTTGCCGCGAAGCTGATGAAAGATGTTATCGCTGAACCCTACCGTGAACGGTTACTGCCAGGCTTCCGGCAGGCGCGGCAGGCGGTCGCGGAAATCGGCGCGGTAGCGAGCGGTATCTCCGGCTCCGGCCCGACCTTGTTCGCTCTGTGTGACAAGCCGGAAACCGCCCAGCGCGTTGCCGACTGGTTGGGTAAGAACTACCTGCAAAATCAGGAAGGTTTTGTTCATATTTGCCGGCTGGATACGGCGGGCGCACGAGTACTGGAAAACTAA");
								});
							</script>
						</div>
						<div class="tab-pane fade" id="tab_upload" style="max-height: 220px;">
							<text id="fasta_file" style="font-size: 12px;"><a href="http://en.wikipedia.org/wiki/FASTA_format" target="view_window" style="text-decoration: none;color:#08c">Upload a FASTA file to get started.</a></text>
							<form id="upload" style="height: 90px;" method='post' action='home.php' enctype='multipart/form-data'> 
								<input type='file' name='file' id="loginFile" size='10' />
								<input type="range" name="loginCodonTable" id="loginCodonTable2" min="1" max="19" value="1">
								<br>
								<text id="showCodonTableNo" style="font-size: 12px;margin-left: 5px;"><a href="http://www.ncbi.nlm.nih.gov/Taxonomy/taxonomyhome.html/index.cgi?chapter=cgencodes" target="view_window" style="text-decoration: none;color:#08c">Genetic Code No.1</a></text>
								<br>
								<input type="text" title="Input your ID from previous access to retrieve data and result." name="old_personID" id="old_personID" placeholder="ID of old access" style="font-size:12px;height:14px;width:100px;margin-top: 5px;margin-left: 5px;">
								<br>
								<input id="file_submit" type='submit' value="START" title="GO" style=""/>
								<br>
							</form>
						</div>
						<div class="tab-pane fade" id="tab_download" style="min-height: 220px;">
							<p class="download_data_file"></p>
							<p class="fig_implementation"></p>
						</div>
						<div class="tab-pane fade" id="tab_demo" style="max-height: 220px;">
							<text id="fasta_file" style="font-size: 12px;text-decoration: none;color:#08c">Run one of the following DEMO dataset.</text>
							<br>
							<br>
							<form id="form1" name="form1" method="post" action="home.php">
								<select name="cenus[]" size="5" id="select" style="font-size:12px;width: 274px;height: 130px;">
									<option value="cat_data">Test data in CAT package</option>
									<option value="tag3">Data with tags</option>
									<option value="m">Whole genome CDSs from Mycobacterium</option>
									<option value="s">Whole genome CDSs from Shewanella</option>
									<option value="e1">Whole genome CDSs of dnaE1 bacterias</option>
									<option value="e2">Whole genome CDSs of dnaE2 bacterias</option>
									<option value="e3">Whole genome CDSs of dnaE3 bacterias</option>
								</select>
							<br>
							<input id="file_submit" type='submit' value="LOAD EXAMPLE" title="GO"/>
							</form>

						</div>
					</div>
				</div>
	        </section>
						</div>
					  </div>
					</div>
				  </div>
				</div>
            </section>
<!--

			<section id="collapse">
				<div class="bs-docs-example">
				  <div class="accordion" id="accordion_input">
					<div class="accordion-group">
					  <div class="accordion-heading">
						<a id="upload_head" class="accordion-toggle" data-toggle="collapse" data-parent="#accordion_input" href="#upload_fasta" style="height: 10px;font-size:12px" title="">
						  Load / Download Data
						</a>
					  </div>
					  <div id="upload_fasta" class="accordion-body collapse" style="height: 0px;">
						<div class="accordion-inner">
							<text id="fasta_file" style="font-size: 12px;"><a href="http://en.wikipedia.org/wiki/FASTA_format" target="view_window" style="text-decoration: none;color:#08c">Upload a FASTA file to get started.</a></text>
							<form id="upload" style="height: 90px;" method='post' action='home.php' enctype='multipart/form-data'> 
								<input type='file' name='file' id="loginFile" size='10' />
								<input type="range" name="loginCodonTable" id="loginCodonTable" min="1" max="19" value="1">
								
								<br>
								<text id="showCodonTableNo" style="font-size: 12px;"><a href="http://www.ncbi.nlm.nih.gov/Taxonomy/taxonomyhome.html/index.cgi?chapter=cgencodes" target="view_window" style="text-decoration: none;color:#08c">Genetic Code No.1</a></text>
<br>
<input type="text" title="Input your ID from previous access to retrieve data and result." name="old_personID" id="old_personID" placeholder="ID of old access" style="font-size:12px;height:14px;width:100px;margin-top: 5px;">
<br>
								<textarea class="title" placeholder="Title (not required)" id="textarea_title" name="textarea_title"></textarea>
<br>
								<input id="file_submit" type='submit' value="START" title="GO" style="position: absolute;top: 120px;"/>
<br>							</form>
<br>
<p class="download_data_file"></p>


							
<text id="fasta_file" style="font-size: 12px;text-decoration: none;color:#08c">Or run one of the following DEMO dataset.</text>
<br>
<br>
<form id="form1" name="form1" method="post" action="home.php">
	<select name="cenus[]" size="5" id="select" style="font-size:10px;">
		<option value="cat_data">Test data in CAT package</option>
		<option value="tag3">Data with tags</option>
		<option value="m">Whole genome CDSs from Mycobacterium</option>
		<option value="s">Whole genome CDSs from Shewanella</option>
		<option value="e1">Whole genome CDSs of dnaE1 bacterias</option>
		<option value="e2">Whole genome CDSs of dnaE2 bacterias</option>
		<option value="e3">Whole genome CDSs of dnaE3 bacterias</option>
	</select>
<br>
<input id="file_submit" type='submit' value="LOAD EXAMPLE" title="GO" styel="position: absolute;top: 320px;" />
</form>

						</div>
					  </div>
					</div>
				  </div>
				</div>
            </section>
-->
<div class="remove">
			<h5>Result</h5>
			<text class="data_type" style="font-size:14px;color:#08c;"></text>
			<br>
			<p>You have <text class="general_info">?</text> records.<input href="#" type="submit" id="compare_selection" value="COMPARE" title="Select 2 records at least to compare."></p>
			<!-- add a table containing all record-->
			<div class="record_list" style="padding-bottom: 10px;width=338px;"></div>
			<p>Select records you want to delete.
			<input href="#" type="submit" id="delete_selection" value="DELETE" title="Select 1 records at least to Del."></p>
			<text class="del_then_refresh" style="color:steelblue;font-size:12px;"></text>
</div>
			<script>
				$('#compare_selection').prop('disabled', true);
				$('#delete_selection').prop('disabled', true);
				$("#compare_selection").click(function(){
					window.open("compare_selection.php");
				});
				
			</script>	
<!--
			<h5>Sort your TAGs</h5>
			<section id="collapse">
				<div class="bs-docs-example">
				  <div class="accordion" id="accordion1">
					<div class="accordion-group">
					  <div class="accordion-heading">
						<a id="tag_stack_head" class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#tag" style="height: 10px;font-size:12px" title="Tag stack is a new method to organize your compute session.">
						  Tag Stack
						</a>
					  </div>
					  <div id="tag" class="accordion-body collapse" style="height: 0px;">
						<div class="accordion-inner">
							<p style="width: 300px;font-size:12px;">Reorder tag stack in the list using the mouse then click the "TAG COMPARE" button below. The layer of tag wheel in the compare page will change according to the redefined order.</p>
							<input href="" type="submit" class="tag_compare" value="TAG COMPARE">

							<div class="column">
							</div>

						</div>
					  </div>
					</div>
				  </div>
				</div>
            </section>
-->
<!--modified sorted tag groups -->
<div class="remove">
<p style="font-size:12px">Please press the <a class="up_and_down">up and down button</a> on the fig to go for your next sequence.</p>
			<hr class="bs-docs-separator">

			<section id="collapse">
				<div class="bs-docs-example">
				  <div class="accordion" id="accordion2">
					<div class="accordion-group">
					  <div class="accordion-heading">
						<a id="sequence_profile_head" class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#sequence_profile" style="height: 10px;font-size:12px" title="Sequence profile: GC/AG content, length, CDC">
							Sequence Profile
						</a>
					  </div>
					  <div id="sequence_profile" class="accordion-body collapse" style="">
						<div class="accordion-inner">
											<div class="bar_chart_gc" id="bar_chart_gc" align="center">
												<p id="format" style="font-size: 10px;color:steelblue;text-align:right;width:310px;margin-bottom: 4px;"></p>
											</div>
											<div class="bar_chart_ag" id="bar_chart_ag" align="center">
												<p id="format" style="font-size: 10px;color:steelblue;text-align:right;width:310px;margin-bottom: 4px;"></p>
											</div>
											<div class="bar_chart_length" id="bar_chart_length" align="center">
												<p id="format" style="font-size: 10px;color:steelblue;text-align:right;width:310px;margin-bottom: 4px;"></p>
											</div>
											<div class="bar_chart_cdc" id="bar_chart_cdc" align="center">
												<p id="format" style="font-size: 10px;color:steelblue;text-align:right;width:310px;margin-bottom: 4px;"></p>
											</div>


						</div>
					  </div>
					</div>
				  </div>
				</div>
            </section>
			<section id="collapse">
				<h5>Other Information</h5>
				<p style="font-size:12px">Click on any <a class="other_information_aa" style="cursor: pointer;">Amino Acid</a> or <a class="other_information_c" style="cursor: pointer;">Codon</a> to see corresponding information: </p>

				<div class="bs-docs-example">
				  <div class="accordion" id="accordion6"  style="font-size:12px">
					<div class="accordion-group">
					  <div class="accordion-heading">
						<a id="aa_infor_head" class="accordion-toggle" data-toggle="collapse" data-parent="#accordion6" href="#collapseOne" style="height: 10px">
						  Amino Acid Information
						</a>
					  </div>
					  <div id="collapseOne" class="accordion-body collapse" style="height: 0px;">
						<div class="accordion-inner" style="font-size:12px">
						  Information on the amino acid:
							<div class="aa_infor"  align="left"></div>
						</div>
					  </div>
					</div>
					<div class="accordion-group">
					  <div class="accordion-heading">
						<a id="rscu_head" class="accordion-toggle" data-toggle="collapse" data-parent="#accordion6" href="#collapseTwo" style="height: 10px">
						  RSCU
						</a>
					  </div>
					  <div id="collapseTwo" class="accordion-body collapse" style="height: 0px;">
						<div class="accordion-inner">
						  <strong style="color:steelblue">R</strong>elative 
						  <strong style="color:steelblue">S</strong>ynonymous 
						  <strong style="color:steelblue">C</strong>odon 
						  <strong style="color:steelblue">U</strong>sage information of :
							<div class="rscu"  align="left" style="font-size:12px"></div>
						</div>
					  </div>
					</div>
				  </div>
				</div>
            </section>
</div>
		</div>
		
		<div class="span8" style="width:640px;">
			<section id="tabs" class="codon_table">
				<div class="bs-docs-example">
<div class="codon_table_size" >
	<text style="font-size:12px;font-family: Helvetica Neue;color: black;">Figure size: SMALL </text>
	<input type="range" name="codon_table_size" id="codon_table_size" min="50" max="140" value="90" style="width: 160px;">
	<text style="font-size:12px;font-family: Helvetica Neue;color: black;"> LARGE</text>
</div>
<br>
					<ul id="myTab" class="nav nav-tabs">
						<li class="active" id="codon_table"><a style="padding: 2px 8px;" href="#home"    data-toggle="tab" title="Reference: Zhang, Zhang, and Jun Yu. The Pendulum Model for Genome Compositional Dynamics: From the Four Nucleotides to the Twenty Amino Acids. Genomics, Proteomics & Bioinformatics 10, no. 4 (2012): doi:10.1016/j.gpb.2012.08.002.">Pendulum model</a></li>
						<li                id="codon_table"><a style="padding: 2px 8px;" href="#partition" data-toggle="tab" title="Reference: Zhang, Zhang, and Jun Yu. Does the Genetic Code Have A Eukaryotic Origin? Genomics, Proteomics & Bioinformatics 11, no. 1 (2013): doi:10.1016/j.gpb.2013.01.001.">Partition</a>     </li>

<!--
						<li>               <a href="#ncbi" data-toggle="tab">NCBI: The Genetic Codes</a>     </li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">NCBI: The Genetic Codes<b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li><a href="#dropdown1" data-toggle="tab">Type A</a></li>
								<li><a href="#dropdown2" data-toggle="tab">Type B</a></li>
							</ul>
						</li>
-->
					</ul>
					<div id="myTabContent" class="tab-content" style="zoom:0.9;-moz-transform:scale(0.9);">
						<div class="tab-pane fade in active" id="home">
							<div align="center" class="pendulum_model" id="pendulum_model">
							<p id="format" style="font-size: 10px;color:steelblue;text-align:right;width:600px;margin-bottom: 4px;"></p>
							</div>
							<br>
							<br>
							<p id="ref" style="font-size: 10px;color:gray;text-align:left;width:600px;margin-bottom: 4px;">Reference: Zhang, Zhang, and Jun Yu. The Pendulum Model for Genome Compositional Dynamics: From the Four Nucleotides to the Twenty Amino Acids. Genomics, Proteomics & Bioinformatics 10, no. 4 (2012): doi:10.1016/j.gpb.2012.08.002.</p>
						</div>
						<div class="tab-pane fade" id="partition">
							<div align="center" class="ncbi_genetic_code_b" id="ncbi_genetic_code_b">
							<p id="format" style="font-size: 10px;color:steelblue;text-align:right;width:600px;margin-bottom: 4px;"></p>
							</div>
							<br>
							<br>
							<p id="ref" style="font-size: 10px;color:gray;text-align:left;width:600px;margin-bottom: 4px;">Reference: Zhang, Zhang, and Jun Yu. Does the Genetic Code Have A Eukaryotic Origin? Genomics, Proteomics & Bioinformatics 11, no. 1 (2013): doi:10.1016/j.gpb.2013.01.001.</p>							
						</div>

					</div>
				</div>
	          	<hr class="bs-docs-separator">
	          	<br><br><br><br><br>
	        </section>
		</div>

	</div>
</div>



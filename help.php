<html>
<head>
	<title>Cloud CAT | Help</title>
	<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />
	<link rel="Bookmark" href="img/favicon.ico" />
	<link rel="stylesheet" type="text/css" href="assets/css/help.css"><!--/assets/css-->
	<style>
			@font-face {
				font-family: 'Helvetica Neue UltraLight';
				src: url('./font/helvetica_neue_ultralight.ttf');
			}
			@font-face {
				font-family: 'Helvetica Neue Light';
				src: url('./font/helvetica_neue_light.ttf');
			}
			@font-face {
				font-family: 'Helvetica';
				src: url('./font/helvetica.ttf');
			}
			@font-face {
				font-family: 'Helvetica Neue Bold';
				src: url('./font/helvetica_neue_bold.ttf');
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
	</style>
</head>


<!--Begin of Google Analytics-->
<!--End of Google Analytics-->

<body>
<script src="assets/js/google_analytic.js"></script>
<table border="0" width="800" align="center" cellspacing="0" cellpadding="0" style="font-size:11px;background:white;">
	<tr>
	    <td align="right">&nbsp;</td>
	</tr>
</table>

<table align="center" border="0" width="800" cellspacing="0" cellpadding="0" style="table-layout:fixed;background-image:url('images/banner1.jpg');background-repeat:no-repeat">
	<tr height="95">
	    <td align="center" class="page_title" width="1200">Cloud CAT</td>    
	</tr>
	<tr height="10" style="background-color:white">
		<td colspan="2"></td>
	</tr>
</table>

<table border="0" width="1000" align="center">
	<tr>
		<td class="table_of_content" align="left">

		<blockquote>
			<ol type="1">
				<li>
					<a href="#introduction">Introduction</a>
				</li>

				<li>
					<a href="#background">Background</a>
				</li>

				<li>
					<a href="#inputfile">Input File</a>
					<dt>3.1<a href="#fasta">Fasta containing CDSs only</a></dt>	
					<dt>3.2 <a href="#fasta_with_tag">Use Tags</a></dt>
				</li>
				
				<li>
					<a href="#output">Format of Output</a>
					<dt>4.1<a href="#cat">*.cat</a></dt>	
					<dt>4.2 <a href="#visualization">Visualizations</a></dt>
				</li>

				<li>
					<a href="#download">Standalone version</a>
				</li>
				
				<li>
					<a href="#acknowledgements">Acknowledgements</a>
				</li>
				
				<li>
					<a href="#contact">Contact Information</a>
				</li>
			</ol>
		</blockquote>
<p>Created by Zhang Zhang and DaWei Huang.</p>
		</td>
		
		<td class="screenshot" align="right" valign="top">
			<div id="codon_table" class="outside" width="480" border="0" height="100%">
				<div class="inside" width="480" border="0" height="100%">
					<a title="Start a live DEMO" target="view_window" href="home.php"><img src="img/cloud_cat_screen_shot.png" style="width:480px;height:294px"></a>

				</div>	
			</div>	
		</td>
	</tr>
</table>

<table border="0" width="800" align="center">
	<tr>
		<td class="content" align="left">

		<hr size="2" width="100%" align=center>
		
		<ol type="1">
				<li class="l1"><strong><a name="introduction">Introduction</a></strong>
					<p class="l1">
Cloud Composition Analysis Toolkit (Cloud CAT) is a web-based tool 
that integrates the server-side capabilities for composition analysis 
with the browser-based technology for interactive visualization of molecular sequence composition. 
</p><p class="l1">
Based on our previously related study and the corresponding software package <a href="http://cbb.big.ac.cn/Software#CAT">CAT</a>, 
we implement Cloud CAT as a web-based version of CAT and expand its utility by providing interactive visualization features. 
</p><p class="l1">
Unlike previous related efforts (e.g., CodonO for codon usage bias analysis (NAR 2007), JCat for codon adaptation analysis (NAR 2005), and CodonW for correspondence analysis of codon usage), 
Cloud CAT features seamless integration of both analysis and visualization of molecular sequence composition. 
</p><p class="l1">
To achieve broad utility, Cloud CAT accepts sequences with widely-used fasta format and provides multiple important estimates, 
including Codon Deviation Coefficient 
([2]; our newly developed measure of estimating codon usage bias, which outperforms extant related measures as testified on both simulated and empirical datasets), 
composition usages of nucleotides, 
codons, and amino acids, 
relative synonymous codon usage (RSCU), 
sequence length, 
GC content as well as positional GC contents at three codon positions, etc. 
</p><p class="l1">
In addition, equipped with AJAX-supported libraries (e.g., <a href="http://jquery.com" target="view_window">jQuery</a>, <a target="view_window" href="http://d3js.org">d3.js<a>), 
the compositions of nucleotides, codons, and amino acids are 
innovatively displayed according to a content-centric organization of the genetic code [3-5], 
providing dynamic web pages and delivering interactive visualizations. 
					</p>
					
					<p class="l1">Please cite:
							Zhang, Z., et al. (2012) Codon Deviation Coefficient: a novel measure for estimating codon usage bias and its statistical significance, BMC Bioinformatics, 13, 43.
					</p>
				</li>	
				<li><strong><a name="background">Background</a></strong>
					<p class="l1">
						Compositions in the context of nucleotides, codons, and amino acids vary considerably within and across genomes. 
						</p><p class="l1">
						Such variability reflects unbalanced forces of mutation and selection acting on a huge diversity of molecular sequences, 
						as it has been extensively documented that the guanine-plus-cytosine (or GC) content differs dramatically from one species to another and also from one gene to another, 
						with a broad range from 20% to 80% in prokaryotes, 
						and the codons as well as the amino acids are differentially used with variable biased degrees in genes, 
						indicating different strengths of selection pressure for translational efficiency and/or accuracy as well as for protein synthesis, localization, and function. 
						</p><p class="l1">
						Therefore, sequence composition analysis within and across genomes is of fundamental significance in better understanding molecular evolution and providing insights for gene function.				
					</p>
				</li>	
					<li><strong><a name="inputfile">Input File</a></strong>
						<dt class="l2">3.1 <strong><a name="fasta">Fasta containing CDSs only</a></strong>
							<p class="l2">
								CAT accepts FASTA file (<a href="http://www.ncbi.nlm.nih.gov/BLAST/fasta.shtml" target="_blank">http://www.ncbi.nlm.nih.gov/BLAST/fasta.shtml</a>) which contains multiple nucleotide coding sequences (CDS region only. Please remove UTR.). Stop codons are eliminated from the analysis.
							</p>
							
							<p class="l2">Example:</p>
							<p class="l2">
								<font face="Courier">
									>b0001<br>
									ATGAAACGCATTAGCACCACCATTACCACCACCATCACCATTACCACAGGTAACGGTGCGGGCTGA<br>
									>b0075<br>
									ATGACTCACATCGTTCGCTTTATCGGTCTACTACTACTAAACGCATCTTCTTTGCGCGGTAGACGAGTGAGCGGCATCCAGCATTAA<br>
									>b1265<br>
									ATGAAAGCAATTTTCGTACTGAAAGGTTGGTGGCGCACTTCCTGA<br>	  			
									</font>
								</p>
							
						</dt>
						<dt class="l2">3.2 <strong><a name="fasta_with_tag">Use Tags</a></strong>
							<p class="l2">
							The input file can has description information in each title which will be used as tags in the Cloud CAT system.
							</p>
							
							<p class="l2">Example:</p>
							<p class="l1">
								<font face="Courier">
									>b0001<font color="lightgray">\t</font></a>human;brain,liver;ortholog<br>
									ATGAAACGCATTAGCACCACCATTACCACCACCATCACCATTACCACAGGTAACGGTGCGGGCTGA<br>
									>b0075<font color="lightgray">\t</font>human;skin;ortholog<br>
									ATGACTCACATCGTTCGCTTTATCGGTCTACTACTACTAAACGCATCTTCTTTGCGCGGTAGACGAGTGAGCGGCATCCAGCATTAA<br>
									>b1265<font color="lightgray">\t</font>mouse;brain,skin;new_gene<br>
									ATGAAAGCAATTTTCGTACTGAAAGGTTGGTGGCGCACTTCCTGA<br>	  			
									</font>
								</p>
							
						</dt>

					</li>	
								 
				<li><strong><a name="output">Format of Output</a></strong>
					<p class="l1">
					Cloud CAT provide standard CAT output (with extension ".cat"), a form of a tab-delimited text file containing data of all measures, 
					and dynamic web pages (See Fig.1. or the <a href="home.php" target="view_window">live demo</a>) delivering interactive visualizations based on data.
					</p>
<div id="fig_whole" class="figure" align="center">
	<div style="zoom:0.7">
        <img src="img/fig_whole.png" style="width:1440px;height:1054px;">
	</div>
        <p align="center">Fig.1. Dynamic web page.</p>
</div>
			
					<dt class="l2">4.1 <strong><a name="cat">*.cat</a></strong>
						<p class="l2">
							CAT output is in the form of a tab-delimited text file with one header row with extension ".cat". 
							Each row thereafter displays the results for each single gene, 
							including columns with gene ID and gene length (bp), GC and purine contents, the estimates of CDC and its significance level <i>P</i>-value. 
							In addition, the observed and expected compositions of nucleotides, codons and amino acids are also provided. 
						</p>
					
						<p class="l2">The description for each column is listed as follows.</p>
					
						<ul>
							<li>ID, Length: Gene ID and the length of the Gene.</li>
							<li>GC, AG: GC content and purine content.</li>
							<li>GCi, AGi: GC content and purine content at codon position i, i=1,2,3</li>
							<li>CDC: Codon Deviation Coefficient as a measure of codon usage bias</li>
							<li>P(CDC): <i>P</i>-value of CDC</li>
						</ul>
					
						<p class="l2">
							In addition, observed and expected compositions for nucleotide (3*4), codon (64) and amino acid (20) are also outputted. 
						</p>
					
						<p class="l2">
							The output file name, by default, will be same as the original input file name with the characters ".cat" appended.
						</p>
<p class="l2">Download link for the *.cat file is in the 3rd line of the page (Fig.1. in <font color="red">red box</font>).</p>
					</dt>
					<dt class="l2">4.2 <strong><a name="visualization">Visualizations</a></strong>
						<p class="l2">
						All figures visualize data in the *.cat file in a interactive way. 
						We encourage user to watch them on web browser, taking advantage of the interaction. 
						For example, in the Pendulum model codon table, user can see usage of any codon in the information panel (Fig.2.) in the central area by placing mouse pointer on the codon's sector. 
						</p>
							<div id="fig_information_panel" class="figure" align="center">
								<div style="zoom:0.7;">
								<img src="img/fig_information_panel.png" style="width:1440px;height:300px">
								</div>
								<p align="center">Fig.2. Information panel.</p>
							</div>
<p>
User can go through records one after one by click the up <img src="img/fig_up.png" style="width:16px;height:16px"> and down <img src="img/fig_down.png" style="width:16px;height:16px"> botton (Fig.2.) in the information panel.
</p>
						<p>						
						Single click on the amino acid's sector will reveal a bar chart on relative synonymous codon usage (RSCU) information (Fig.4. on the left side.) in the collapsible area name RSCU if the corresponding amino acid has more than one codons.						
						</p>
<p>
Keep in mind that we make amlost all clickable function with a symble <img src="img/fig_hand.png" style="width:17px;height:19px"> while you place your mouse pointer over it. 
Function requied click to be actived will appear <img src="img/on.gif" style="width:16px;height:16px"> in the title as the notification of activation, as shown in Fig.3. on title of collapsible area named "RSCU" and in Fig.4. on title of collapsible area named "Amini Acide Information".
</p>
							<div id="fig_rscu_aa_panel" class="figure" align="center">
								<div style="zoom:0.7;">
								<img src="img/fig_rscu_aa_panel_aa.png" style="width:1440px;height:300px">
								</div>
								<p align="center">Fig.3. Amino acid information panel.</p>
							</div>
<br>
<div id="fig_rscu_aa_panel" class="figure" align="center">
        <div style="zoom:0.7;">
        <img src="img/fig_rscu_aa_panel_rscu.png" style="width:1440px;height:300px">
        </div>
        <p align="center">Fig.4. RSCU panel.</p>
</div>
<dt class="l3">4.2.1 <strong><a name="record_list">Record List and record comparision</a></strong>
<p>
Record list is a dynamic table on the left side of the CAT result page (Fig.1. in the <font color="green">green box</font>.), conatining all your sequences' basic features (e.g., ID, length). Sort records by a feature by click on column title of the feature. Sort action will change the order of appearance when using the up and down button. Current record is in red color.
</p>
<p>
Click the check box of each record to select it for comparsion or deletion. We provide a compare tool using paremeter cosoin similarity. 
Select two records or more, then click <img src="img/fig_compare.png" style="width:54px;height:21px"> above the table for a new page, conatining a half matrix of cosine similarity and codon table figures on selected records
 (Fig.5.)
.
</p>

<div id="fig_compare_page" class="figure" align="center">
        <div style="zoom:0.7;">
        <img src="img/fig_compare_page.png" style="width:1440px;height:1052px">
        </div>
        <p align="center">Fig.5. Compare codon usage between records using consine similarity.</p>
</div>

</dt>
<!--
<dt class="l3">4.2.1 <strong><a name="record_list">TAGs and group comparision</a></strong>
<p>
We are working on this instruction.
</p>
<div id="fig_tag_wheel" class="figure" align="center">
        <div style="zoom:0.7;">
        <img src="img/fig_tag_wheel.png" style="width:1440px;height:200px">
        </div>
        <p align="center">Fig.8. Tag page.</p>
</div>                                                  
</dt>
i-->
						<p class="l2">
							All visualized figures in Cloud CAT can be downloaded in multiple different formats. We currently support:
							<ul>
								<li>svg: All figures floating on the web page are encoded in svg format. Instant download format.</li>
								<li>pdf: Portable Document Format. This is vector graphics with best resolution.</li>
								<li>png: Portable Network Graphics. A format with good quality in acceptable size. Note: PNG does not support non-RGB color spaces such as CMYK. </li>
								<li>ps: vector graphics encoded in PostScript.</li>
							</ul>
							Just click the format name in figure download panel (Fig.7. in <font color="blue">blue box</font>.) besides each visualization to get your desired figure. Please wait while the icon <img src="img/loading.gif"> is running above the panel. 
						</p>

<div id="fig_download_panel" class="figure" align="center">
        <div style="zoom:0.7;">
        <img src="img/fig_download_panel.png" style="width:1440px;height:200px">
        </div>
        <p align="center">Fig.7. Figure download panel.</p>
</div>
							
						<p class="l2">
						A live demo for illustrating these features is publicly accessible at http://cat.big.ac.cn/  
						</p>
						
					</dt>
				  	
				</li>	

				<li><strong><a name="download">Standalone version</a></strong>
					<p class="l1">The <a href="http://cbrc.kaust.edu.sa/CAT/CAT1.0.tar.gz">CAT</a> package (version 1.0), including source codes, compiled executables, and documentation, is freely available for academic use only. </p>
					<p class="l1">CAT version 1.0 for MAC OS with Graphical User Interface (GUI) can be downloaded <a href="http://cbrc.kaust.edu.sa/CAT/CAT1.0.dmg">here</a>.</p>

					<dt class="l2">5.1 <strong><a name="copyright">Copyright &amp; License</a></strong>
						<p class="l2">CAT is distributed as open-source software and licensed under the GNU General Public License (Version 3; http://www.gnu.org/licenses/gpl.txt), in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.</p>
						<p class="l2">Commercial use of CAT requires a special contract.</p>
					</dt>
					
					<dt class="l2">5.2 <strong><a name="install">Installation</a></strong>

						<p class="l2">For high efficiency and compatibility with more platforms, CAT is written in standard C++. The package is normally named CAT<font color="gray">XXX</font>.tar.gz (<font color="gray">XXX</font> stands for the version).</p>

						<dt class="l3">5.2.1  <a name="executables"><strong>Compiled Executables</strong></a>
							<p class="l3">
								Executables have been precompiled for Linux/Unix/Mac/Windows. Please unpack the package of CAT<font color="gray">XXX</font>.tar.gz (see below) and then you will find compiled executables in the folder of "CAT<font color="gray">XXX</font>/bin/".
							</p>
						</dt>
						
						<dt class="l3">5.2.2 <a name="compile"><strong>Linux/Unix/Mac/Windows</strong>
			
							<p class="l3">For compilation on your specific platform, please follow the steps below.</p>
							<p class="l3">(1) Unpack the package of CATXXX.tar.gz by the following commands.</p>
			
									<ul><font face="Courier">tar -zxf CATXXX.tar.gz</font></ul>
								
							<p class="l3">(2) If you use other Linux/Unix/Mac OS, you have to compile the program in the source codes folder with the help of g++/gcc compiler. </p>
								<ul><font face="Courier">cd CATXXX/src</font></ul>
								<ul><font face="Courier">make</font></ul>
							
							<p class="l3">That's it. Then you can find an executable named "CAT" in this folder. </p>
							<p class="l3">Note for Mac users: Mac on your computer might use the case insensitive file system, so that "CAT" would have the completely "same" name with a system command "cat". When running the "CAT" program, please specify the working directory of "CAT" for access.</p>	  				
						
						</dt>
					</dt>
					
					<dt class="l2">5.3 <strong><a name="parameters">Setting Parameters</a></strong>
						<p class="l2">
						CAT allows the user to customize parameters. The following are the parameters' settings, which can also be found by typing "CAT -h".
							<dd>-i&nbsp;&nbsp;&nbsp;&nbsp;	input fasta file name [string, required]</dd>
							<dd>-o&nbsp;&nbsp;&nbsp;&nbsp;	output file name [string, optional], default = input file name with the characters ".cat" appended</dd>
							<dd>-b&nbsp;&nbsp;&nbsp;&nbsp;	bootstrap replications [integer, optional], default = 10000</dd>
							<dd>-c&nbsp;&nbsp;&nbsp;&nbsp;	genetic code to be used [integer, optional], default = 1. All genetic codes are available at <a href="http://www.ncbi.nlm.nih.gov/Taxonomy/Utils/wprintgc.cgi" target="_blank">NCBI</a>.</dd>
						</p>
					
					</dt>
				</li>
				<li><strong><a name="acknowledgements">Acknowledgements</a></strong>
					<p class="l1">We thank Ang Li and XingJian Xu for providing assistance on hosting this web service.</p>
					<p class="l1">We thank Dong Zou, XingJian Xu and SiQi Liu for suggestions on technologies.</p>
					<p class="l1">We thank Yue Gao for Logo design.</p>
					<p class="l1">We also thank many users for reporting bugs and sending suggestions. </p>
				</li>	
			 
				<li><strong><a name="contact">Contact Information</a></strong>
					<p class="l1">Please send bugs or advice to Dr. DaWei Huang (cat.big.ac.cn(AT)gmail.com).</p>
					<p class="l1">Follow <a href="https://twitter.com/bigcloudcat">@bigCloudCAT</a> at twitter to report bug or request for help.</p>
				</li>								
				<li><strong><a name="reference">REFERENCE</a></strong>
					<p class="l1">
[1]	Zhang, Z. and Yu, J. (2010) Modeling compositional dynamics based on GC and purine contents of protein-coding sequences, Biology Direct, 5, 63.
</p><p class="l1">
[2] Zhang, Z., et al. (2012) Codon Deviation Coefficient: a novel measure for estimating codon usage bias and its statistical significance, BMC Bioinformatics, 13, 43.
</p><p class="l1">
[3] Zhang, Z., et al. (2013) Protein coding, In: eLS. John Wiley & Sons Ltd, Chichester. 
</p><p class="l1">
[4] Zhang, Z. and Yu, J. (2012) The pendulum model for genome compositional dynamics: from the four nucleotides to the twenty amino acids, Genomics Proteomics Bioinformatics, 10(4), 175-180.
</p><p class="l1">
[5] Zhang, Z. and Yu, J. (2011) On the organizational dynamics of the genetic code, Genomics Proteomics Bioinformatics, 9(1-2), 21-29.
					
					</p>
				</li>								
			</ol>	  

		</td>
	</tr>
</table>
<br><br><br><br>
<?php
	include ("php/svg_series_php_footer.php");
?>
<script src="js/d3.v3.min.js"></script>

<script>
d3.select("a.tzine").text("");
	d3.select("a.tzine")//.remove();
		.attr("href","home.php")
		.text("Go back to Home")
		.style({
			"color":"DodgerBlue",
			"left":"70%",
		});
//<a class="tzine" href="home.php" target="view_window" content="HOME">Head on to <i><b>Help page</b></i> for details.</a>
</script>
</body>
</html>


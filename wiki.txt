**Cloud Composition Analysis Toolkit (Cloud CAT)** is a web-based tool that integrates the server-side capabilities for composition analysis with the browser-based technology for interactive visualization of molecular sequence composition.

Based on our previously related study and the corresponding software package [CAT](http://cbb.big.ac.cn/Software#CAT), we implement Cloud CAT as a web-based version of CAT and expand its utility by providing interactive visualization features.

Unlike previous related efforts (e.g., CodonO for codon usage bias analysis (NAR 2007), JCat for codon adaptation analysis (NAR 2005), and CodonW for correspondence analysis of codon usage), Cloud CAT features seamless integration of both analysis and visualization of molecular sequence composition.

To achieve broad utility, Cloud CAT accepts sequences with widely-used fasta format and provides multiple important estimates, including Codon Deviation Coefficient ([2]; our newly developed measure of estimating codon usage bias, which outperforms extant related measures as testified on both simulated and empirical datasets), composition usages of nucleotides, codons, and amino acids, relative synonymous codon usage (RSCU), sequence length, GC content as well as positional GC contents at three codon positions, etc.

In addition, equipped with AJAX-supported libraries (e.g., [jQuery](http://jquery.com), [d3.js](https://github.com/mbostock/d3/)), the compositions of nucleotides, codons, and amino acids are innovatively displayed according to a content-centric organization of the genetic code [3-5], providing dynamic web pages and delivering interactive visualizations.

Please cite: Zhang, Z., et al. (2012) Codon Deviation Coefficient: a novel measure for estimating codon usage bias and its statistical significance, BMC Bioinformatics, 13, 43.


## Background

Compositions in the context of nucleotides, codons, and amino acids vary considerably within and across genomes.

Such variability reflects unbalanced forces of mutation and selection acting on a huge diversity of molecular sequences, as it has been extensively documented that the guanine-plus-cytosine (or GC) content differs dramatically from one species to another and also from one gene to another, with a broad range from 20% to 80% in prokaryotes, and the codons as well as the amino acids are differentially used with variable biased degrees in genes, indicating different strengths of selection pressure for translational efficiency and/or accuracy as well as for protein synthesis, localization, and function.

Therefore, sequence composition analysis within and across genomes is of fundamental significance in better understanding molecular evolution and providing insights for gene function.

## Input File

### 3.1 Fasta containing CDSs only

CAT accepts FASTA file (http://www.ncbi.nlm.nih.gov/BLAST/fasta.shtml) which contains multiple nucleotide coding sequences (CDS region only. Please remove UTR.). Stop codons are eliminated from the analysis.

Example:

```
>b0001
ATGAAACGCATTAGCACCACCATTACCACCACCATCACCATTACCACAGGTAACGGTGCGGGCTGA
>b0075
ATGACTCACATCGTTCGCTTTATCGGTCTACTACTACTAAACGCATCTTCTTTGCGCGGTAGACGAGTGAGCGGCATCCAGCATTAA
>b1265
ATGAAAGCAATTTTCGTACTGAAAGGTTGGTGGCGCACTTCCTGA
```

### 3.2 Use Tags

The input file can has description information in each title which will be used as tags in the Cloud CAT system.

Example:

```
>b0001\thuman;brain,liver;ortholog
ATGAAACGCATTAGCACCACCATTACCACCACCATCACCATTACCACAGGTAACGGTGCGGGCTGA
>b0075\thuman;skin;ortholog
ATGACTCACATCGTTCGCTTTATCGGTCTACTACTACTAAACGCATCTTCTTTGCGCGGTAGACGAGTGAGCGGCATCCAGCATTAA
>b1265\tmouse;brain,skin;new_gene
ATGAAAGCAATTTTCGTACTGAAAGGTTGGTGGCGCACTTCCTGA
```

## Format of Output

Cloud CAT provide standard CAT output (with extension ".cat"), a form of a tab-delimited text file containing data of all measures, and dynamic web pages (See Fig.1. or the live demo) delivering interactive visualizations based on data.


![Fig.1. Dynamic web page.](https://github.com/daweih/cloudcat/blob/master/img/fig_whole.png)

Fig.1. Dynamic web page.


### 4.1 *.cat

CAT output is in the form of a tab-delimited text file with one header row with extension ".cat". Each row thereafter displays the results for each single gene, including columns with gene ID and gene length (bp), GC and purine contents, the estimates of CDC and its significance level P-value. In addition, the observed and expected compositions of nucleotides, codons and amino acids are also provided.

The description for each column is listed as follows.

- ID, Length: Gene ID and the length of the Gene.
- GC, AG: GC content and purine content.
- GCi, AGi: GC content and purine content at codon position i, i=1,2,3
- CDC: Codon Deviation Coefficient as a measure of codon usage bias
- P(CDC): P-value of CDC

In addition, observed and expected compositions for nucleotide (3*4), codon (64) and amino acid (20) are also outputted.

The output file name, by default, will be same as the original input file name with the characters ".cat" appended.

Download link for the *.cat file is in the 3rd line of the page (Fig.1. in red box).

### 4.2 Visualizations

All figures visualize data in the *.cat file in a interactive way. We encourage user to watch them on web browser, taking advantage of the interaction. For example, in the Pendulum model codon table, user can see usage of any codon in the information panel (Fig.2.) in the central area by placing mouse pointer on the codon's sector.


![Fig.2. Information panel.](https://github.com/daweih/cloudcat/blob/master/img/fig_information_panel.png)
Fig.2. Information panel.

User can go through records one after one by click the up ![up](https://github.com/daweih/cloudcat/blob/master/img/fig_up.png) and down ![down](https://github.com/daweih/cloudcat/blob/master/img/fig_down.png) botton (Fig.2.) in the information panel.

Single click on the amino acid's sector will reveal a bar chart on relative synonymous codon usage (RSCU) information (Fig.4. on the left side.) in the collapsible area name RSCU if the corresponding amino acid has more than one codons.

Keep in mind that we make amlost all clickable function with a symble ![hand](https://github.com/daweih/cloudcat/blob/master/img/fig_hand.png) while you place your mouse pointer over it. Function requied click to be actived will show ![on](https://github.com/daweih/cloudcat/blob/master/img/on.gif) in the title as the notification of activation, as shown in Fig.3. on title of collapsible area named "RSCU" and in Fig.4. on title of collapsible area named "Amini Acide Information".

![Fig.3. Amino acid information panel.](https://github.com/daweih/cloudcat/blob/master/img/fig_rscu_aa_panel_aa.png)
Fig.3. Amino acid information panel.


![Fig.4. RSCU panel.](https://github.com/daweih/cloudcat/blob/master/img/fig_rscu_aa_panel_rscu.png)
Fig.4. RSCU panel.

#### 4.2.1 Record List and record comparison

Record list is a dynamic table on the left side of the CAT result page (Fig.1. in the green box.), conatining all your sequences' basic features (e.g., ID, length). Sort records by a feature by click on column title of the feature. Sort action will change the order of appearance when using the up and down button. Current record is in red color.

Click the check box of each record to select it for comparsion or deletion. We provide a compare tool using paremeter cosoin similarity. Select two records or more, then click ![click](https://github.com/daweih/cloudcat/blob/master/img/fig_compare.png) above the table for a new page, conatining a half matrix of cosine similarity and codon table figures on selected records (Fig.5.) .


![Fig.5. Compare codon usage between records using consine similarity.](https://github.com/daweih/cloudcat/blob/master/img/fig_compare_page.png)
Fig.5. Compare codon usage between records using consine similarity.

All visualized figures in Cloud CAT can be downloaded in multiple different formats. We currently support:

- svg: All figures floating on the web page are encoded in svg format. Instant download format.
- pdf: Portable Document Format. This is vector graphics with best resolution.
- png: Portable Network Graphics. A format with good quality in acceptable size. Note: PNG does not support non-RGB color spaces such as CMYK.
- ps: vector graphics encoded in PostScript.

Just click the format name in figure download panel (Fig.7. in blue box.) besides each visualization to get your desired figure. Please wait while the icon ![loading](https://github.com/daweih/cloudcat/blob/master/img/loading.gif) is running above the panel.

![Fig.7. Figure download panel.](https://github.com/daweih/cloudcat/blob/master/img/fig_download_panel.png)
Fig.7. Figure download panel.

A live demo for illustrating these features is publicly accessible at http://cat.big.ac.cn/

## Standalone version
The CAT package (version 1.0), including source codes, compiled executables, and documentation, is freely available for academic use only.

CAT version 1.0 for MAC OS with Graphical User Interface (GUI) can be downloaded here.

### 5.1 Copyright & License

CAT is distributed as open-source software and licensed under the GNU General Public License (Version 3; http://www.gnu.org/licenses/gpl.txt), in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.

Commercial use of CAT requires a special contract.

### 5.2 Installation

For high efficiency and compatibility with more platforms, CAT is written in standard C++. The package is normally named CATXXX.tar.gz (XXX stands for the version).

#### 5.2.1 Compiled Executables
Executables have been precompiled for Linux/Unix/Mac/Windows. Please unpack the package of CATXXX.tar.gz (see below) and then you will find compiled executables in the folder of "CATXXX/bin/".

#### 5.2.2 Linux/Unix/Mac/Windows

For compilation on your specific platform, please follow the steps below.

(1) Unpack the package of CATXXX.tar.gz by the following commands.

```
tar -zxf CATXXX.tar.gz
```

(2) If you use other Linux/Unix/Mac OS, you have to compile the program in the source codes folder with the help of g++/gcc compiler.

```
cd CATXXX/src

make
```

That's it. Then you can find an executable named "CAT" in this folder.

Note for Mac users: Mac on your computer might use the case insensitive file system, so that "CAT" would have the completely "same" name with a system command "cat". When running the "CAT" program, please specify the working directory of "CAT" for access.

### 5.3 Setting Parameters
CAT allows the user to customize parameters. The following are the parameters' settings, which can also be found by typing "CAT -h".

- -i    	input fasta file name [string, required]
- -o    	output file name [string, optional], default = input file name with the characters ".cat" appended
- -b    	bootstrap replications [integer, optional], default = 10000
- -c    	genetic code to be used [integer, optional], default = 1. All genetic codes are available at NCBI.

## Acknowledgements

We thank Ang Li and XingJian Xu for providing assistance on hosting this web service.

We thank Dong Zou, XingJian Xu and SiQi Liu for suggestions on technologies.

We thank Yue Gao for Logo design.

We also thank many users for reporting bugs and sending suggestions.

## Contact Information

Please send bugs or advice to Dr. DaWei Huang (cat.big.ac.cn(AT)gmail.com).

Follow @bigCloudCAT at twitter to report bug or request for help.

## Resources

* [Q&A](http://cat.big.ac.cn/report.php)


## REFERENCES

[1] Zhang, Z. and Yu, J. (2010) Modeling compositional dynamics based on GC and purine contents of protein-coding sequences, Biology Direct, 5, 63.

[2] Zhang, Z., et al. (2012) Codon Deviation Coefficient: a novel measure for estimating codon usage bias and its statistical significance, BMC Bioinformatics, 13, 43.

[3] Zhang, Z., et al. (2013) Protein coding, In: eLS. John Wiley & Sons Ltd, Chichester.

[4] Zhang, Z. and Yu, J. (2012) The pendulum model for genome compositional dynamics: from the four nucleotides to the twenty amino acids, Genomics Proteomics Bioinformatics, 10(4), 175-180.

[5] Zhang, Z. and Yu, J. (2011) On the organizational dynamics of the genetic code, Genomics Proteomics Bioinformatics, 9(1-2), 21-29.

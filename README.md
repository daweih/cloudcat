Cloud CAT
========

A cloud application for analysis and visualization of molecular sequence composition:http://cat.big.ac.cn

## Introduction

Cloud Composition Analysis Toolkit (Cloud CAT) is a web-based tool that integrates the server-side capabilities for composition analysis with the browser-based technology for interactive visualization of molecular sequence composition.

[Fig. 1: Windows and panels on Cloud CAT.](https://github.com/daweih/cloudcat/blob/master/images/cloud_cat_v5.jpg)

Cloud CAT has four window, including analysis-visualization window (fig. 1, No. 1), help window, report window, and genetic code window. Functional modules are organized in collapsible component which can hide or show when required.

## Data upload and analysis

Cloud CAT accepts multi-sequences data in fasta format which can be pasted directly or uploaded in a file through “input sequence” module (No. 2). Select proper genetic code number and click “start”. Result in text format file and package for implementation of visualization are available in the “Download” tab. There are several examples in the DEMO tab.

## Visual data exploration

Results are listed in the sortable table on the left of main window (No. 1). Visualize each record by clicking on table or pressing up and down button in the “information panel” (No.3 in orange box) and corresponding record will turn red. Select record by checking in red box. Click “COMPARE” button will execute comparison analysis in a new window (No. 4) when multi-records are checked. Checked records will be removed after page refresh when click the “DELETE” button. Sequence composition data are visualized in two rearranged forms of codon table, pendulum model and partition (No. 5). The “point” action through the mouse on codon or amino acid sector in the visualization will trigger changes in the “information panel”, showing type, name and usage information on pointed sector in detail. The “click” action will trigger changes in the “amino acid information” module (No. 7),  showing name, structure and side chain polarity, and “RSCU” module (No. 8), showing a bar chart while amino acid with synonymous codons is clicked. User can get information in detail while interacting with figures by different mouse actions. Use download module in green box to get static figures.

## Comparison analysis

There are seven examples listed under the DEMO tab in “input sequence” module. The dnaE-based grouping scheme has been proven biological justified when concerning the correlation between bacteriological features and sequence composition (Wu et al., 2012). Joined CDSs of each bacteria were used as inputs in 5 dnaE-based examples. When the GC content variation is concerned, sequence composition analysis and visualization showed distinct trend of unbalanced codon usage: bacteria with moderate GC content tend to have more balanced codon usage, whereas bacteria with high or low GC content exhibit a bias codon usage pattern. After sorted by GC content in sortable table,  bacteria with similar GC content have higher cosine similarity score in comparison analysis.

Want to learn more?

- [Wiki Cloud CAT](https://github.com/daweih/cloudcat/wiki)
- [Help page for Cloud CAT](http://cat.big.ac.cn/help.php)
- [Composition Analysis Toolkit (standalone version)](https://code.google.com/p/composition-analysis-toolkit)
- [About the author of CAT](http://cbb.big.ac.cn/Zhang_Zhang)
- [About the creator of Cloud CAT](http://cbb.big.ac.cn/Dawei_Huang)



## REFERENCES

[1]	Zhang, Z. and Yu, J. (2010) Modeling compositional dynamics based on GC and purine contents of protein-coding sequences, Biology Direct, 5, 63.

[2] Zhang, Z., et al. (2012) Codon Deviation Coefficient: a novel measure for estimating codon usage bias and its statistical significance, BMC Bioinformatics, 13, 43.

[3] Zhang, Z., et al. (2013) Protein coding, In: eLS. John Wiley & Sons Ltd, Chichester.

[4] Zhang, Z. and Yu, J. (2012) The pendulum model for genome compositional dynamics: from the four nucleotides to the twenty amino acids, Genomics Proteomics Bioinformatics, 10(4), 175-180.

[5] Zhang, Z. and Yu, J. (2011) On the organizational dynamics of the genetic code, Genomics Proteomics Bioinformatics, 9(1-2), 21-29.
/******************************************************************
* Copyright (c) 2011
* All rights reserved.
 
* Filename: CAT.h
* Abstract: Declaration of CAT class

* Version: 1.2
* Author: Zhang Zhang
* Date: Dec. 15, 2013
* Note: Add RSCU values

* Version: 1.1
* Author: Zhang Zhang
* Date: Mar. 12, 2011
 
* Version: 1.0
* Author: Zhang Zhang
* Date: Dec. 18, 2010

* Note: CAT - Composition Analysis Toolkit

CDC (Codon Deviation Coefficient): a novel measure of Codon Usage Bias

******************************************************************/
#if !defined(CAT_H)
#define  CAT_H

#define ABBRNAME   "CAT"	//Short name
#define FULLNAME   "Composition Analysis Toolkit"	//Full name
#define VERSION    "1.2"
#define WEBSITE    "http://cbb.big.ac.cn/software"
#define LASTUPDATE "Dec. 15, 2013"
#define CITATION   "Zhang, Z. et al. (2012) Codon Deviation Coefficient: a novel measure for estimating codon usage bias and its statistical significance, BMC Bioinformatics, 13, 43."	

#include "base.h"
//#include "chisquare.cpp"

class CAT: public Base {

public:
	CAT();
	
	int Run(int argc, const char* argv[]);
	int showHelpInfo();
	
protected:
	int analyzeCDSs(vector<string> seqs, vector<string> names);
	int analyzeOneCDS(string seq, string name);
	
	int predictExpected(double S[], double R[], long number_of_codon);
	
	int doBootStrap(double S[], double R[], long number_of_codon);
	int getBootstrapEstimates(string key, double reference_value, vector<double> Posterior);

	//Measure codon deviation coefficient
	double measureCDC(StringDouble observed, StringDouble expected);
        double measureCDC0(StringDouble observed);
        double measureTSC1(StringDouble observed, StringDouble map_tRNA);
        double measureTSC2(StringDouble observed, StringDouble expected, StringDouble map_tRNA);
        double measureTSC3(StringDouble observed, StringDouble expected, StringDouble map_tRNA);
        double measureTSC4(StringDouble pvalue, StringString flag, StringDouble map_tRNA);
        //double measureTSC4(StringDouble observed, StringDouble expected, StringDouble map_tRNA);
        double measureTSC5(StringDouble pvalue, StringString flag, StringDouble map_tRNA);
        double measureTSC6(StringDouble observed, StringDouble expected, StringDouble pvalue, StringString flag, StringDouble map_tRNA);
        double measureTSC7(StringDouble observed, StringDouble expected, StringDouble pvalue, StringString flag, StringDouble map_tRNA);
        


	//Measure amino acid deviation coefficient,
	double measureAADC(StringDouble observed, StringDouble expected);
	//Measure nucleotide deviation coefficient, pos=0, 1, 2, 3 for all, first, second, and third positions, respectively
	double measureNDC(StringDouble observed, StringDouble expected, string pos);

	//Get all codon bias by different measures
	string getAllMeasures(vector<double> observed, vector<double> expected, long sampling_size);
	//Cosine distance
	double computeCosineDistance(vector<double> observed, vector<double> expected);

	/* 
	//Pearson's Chi-square value
	double computeChiSquareDistance(vector<double> observed, vector<double> expected);
	//Pearson's Chi-square p-value
	double computeChiSquarePvalue(double chisquare, int df);
	*/
	
	/* More distances */
	double computeEuclideanDistance(vector<double> observed, vector<double> expected);
	double computeMinkowskiDistance(vector<double> observed, vector<double> expected);
	double computeHellingerDistance(vector<double> observed, vector<double> expected);
	double computeJensenShannonDivergence(vector<double> observed, vector<double> expected);
	double computeJeffreyDivergence(vector<double> observed, vector<double> expected);

	int predictBaseUsage(double GC, double Purine, StringDouble &N4);
	int predictBaseCodonAAUsage(double S[], double R[]);

	string setCDSHeader();

	bool parseParameter(int argc, const char* argv[]);

	int getSiRiContents(double S[], double R[]);

	string outputResults(string name, long len);
        int readtRNA(string seqfile, StringDouble &tRNAs);


public:
	//Sequence names
	vector<string> seq_names;
	//Sequences
	vector<string> seqs;

protected:
	//Input file name
	string inputFastaFileName;
	//Output file name
	string outputFileName;
	//tRNA file
	string tRNAFileName;	
        //Model(s) used
	int modelUsed;
	//Verbose output
	int verbose;
	//Bootstrap replication
	int bootstrap;

	//Observed composition frequencies
	StringDouble map_observed;
	//Expected composition frequencies
	StringDouble map_expected;
	//Estimated parameters by bootstrap resampling
	StringDouble map_estimated;
        //tRNAs
        StringDouble map_tRNA;
	//Bootstrap estimates
	StringDouble pvalue, median, lowerCI, upperCI;
	//Bootstrap estimates
	StringDouble pvalue2, median2, lowerCI2, upperCI2;
	//Bootstrap estimates
	StringString flag;

private:
	//Keywords for coding sequences
	vector<string> keywords_cds;
	//GC content: y = ax + b
	double aS[3], bS[3];
	//Purine content: y = ax + b
	double aR[3], bR[3];
};


#endif
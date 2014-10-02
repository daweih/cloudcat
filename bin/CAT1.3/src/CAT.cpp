/******************************************************************
* Copyright (c) 2011
* All rights reserved.
 
* Filename: CAT.cpp
* Abstract: Definition of base class

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

CDC:  Codon Deviation Coefficient, a meausre of Codon Usage Bias

******************************************************************/

#include "CAT.h"

CAT::CAT() {

	//default parameter setting
	bootstrap = 10000;
	modelUsed = 2;
	outputFileName = "";
        tRNAFileName = "";
	verbose = 0;
	
	//Correlations between S and Si
	aS[0] = 0.744;	bS[0] = 0.177;
	aS[1] = 0.465;	bS[1] = 0.177;
	aS[2] = 1.791;	bS[2] = -0.354;

	//Correlations between R and Ri
	aR[0] = 1.086;	bR[0] = 0.049;
	aR[1] = 0.781;	bR[1] = 0.074;
	aR[2] = 1.133;	bR[2] = -0.123;

	int i;
	
	//Nucleotides
	for (i=0; i<nucleotides.size(); i++) {
		keywords_cds.push_back(nucleotides[i]);
	}
	
	//Codon nucleotides at three codon positions
	for (i=0; i<codon_nucleotides.size(); i++) {
		keywords_cds.push_back(codon_nucleotides[i]);
	}
	
	//Contents, e.g, GC, purine
	for (i=0; i<contents.size(); i++) {
		keywords_cds.push_back(contents[i]);
	}

	//Codon Contents: GC[i], purine[i], i=1,2,3
	for (i=0; i<codon_contents.size(); i++) {
		keywords_cds.push_back(codon_contents[i]);
	}

	//64 Codons
	for (i=0; i<CODON; i++) {
		keywords_cds.push_back(ID2Codon[i]);
                keywords_cds.push_back("RSCU("+ID2Codon[i]+")");
	}

	//20 Amino Acids
	for (i=0; i<aminoacid.size(); i++) {
		keywords_cds.push_back(aminoacid[i]);
	}

}

int CAT::Run(int argc, const char* argv[]) {

	try {
		
		static time_t time_start = time(NULL);		
		
		if (!parseParameter(argc, argv)) {
			throw 1;
		}
		
		cout<<"Input file: "<<inputFastaFileName<<endl;
		cout<<"tRNA file: "<<tRNAFileName<<endl;
		//cout<<"Model(s) used: "<<modelUsed<<endl;
		cout<<"Genetic code used: "<<genetic_code_name[genetic_code-1]<<endl;
		cout<<"Bootstrap replications: "<<bootstrap<<endl;
		cout<<endl;

		if (!readFasta(inputFastaFileName, seq_names, seqs)) {
			throw 1;
		}
		
                //if ( !readtRNA(tRNAFileName, map_tRNA) ) {
		//	throw 1;
		//}
                
		cout<<"Please wait while analyzing..."<<endl;
		if (!analyzeCDSs(seqs, seq_names)) {
			throw 1;
		}
		
		time_t t = time(NULL) - time_start;
		
		cout<<endl<<"Mission accomplished. (Time elapsed: "<< formatDateTime(t)<<")"<<endl;
	}
	catch (...) {		
	}

	return 1;
}

/**************************************************
* Function: parseParameter
* Input Parameter: int, const char* []
* Output: Parse the input parameters
* Return Value: bool, success=true, fail=false
***************************************************/
bool CAT::parseParameter(int argc, const char* argv[]) {
	
	bool flag = true;
	string temp = "";
	string msg = "";

	try {
		int inputfile_flag = 0;
		int outputfile_flag = 0;

		temp=StringToUpper(argv[1]);
		if (argc<2) {
			throw 1;
		}
		else if (argc==2) {//help information			
			if (temp=="-H") throw 1;
			else throw temp.c_str();
		}
		else {			
			int i, j;
			
			//parse parameters			
			for (i=1; i<argc; i++) {				
				temp = StringToUpper(argv[i]);
				//Input file
				if (temp=="-I" && (i+1)<argc) {
					inputFastaFileName = argv[++i];
					inputfile_flag = 1;					
				}
                                //tRNA file
				else if (temp=="-T" && (i+1)<argc) {
					tRNAFileName = argv[++i];
                                }
				//Output file
				else if (temp=="-O" && (i+1)<argc) {					
					outputFileName = argv[++i];
					outputfile_flag = 1;
				}
				//Model: Model 1 (=1) or Model 2 (=2) or both (=0)
				else if (temp=="-M" && (i+1)<argc) {
					int num = toInteger(argv[++i]);
					if (num==0 || num==1 || num==2) modelUsed = num;
					else throw (msg=temp + " " + argv[i]).c_str();
				}
				//Genetic code
				else if (temp=="-C" && (i+1)<argc) {
					int num = toInteger(argv[++i]);
					if ((num>=1 && num<=6) || (num>=9 && num<=16) || (num>=21 && num<=23)) genetic_code = num;
					else throw (msg=temp + " " + argv[i]).c_str();
				}
				//Bootstrap count
				else if (temp=="-B" && (i+1)<argc) {
					int num = toInteger(argv[++i]);
					if (num>=0) bootstrap = num;
					else throw (msg=temp + " " + argv[i]).c_str();
				}
				//Verbose
				else if (temp=="-V" && (i+1)<argc) {
					int num = toInteger(argv[++i]);
					if (num==0 || num==1) verbose = num;
					else throw (msg=temp + " " + argv[i]).c_str();
				}
				//Slopes for GC contents
				else if (temp.find("-AS") > -1 && (i+1) < argc ) {
					double num = toDouble(argv[++i]);					
					for (j=0; j<3; j++) {
						string ab = "-AS" + toString(j+1);
						if (temp==ab) {
							aS[j] = num;
							break;
						}
					}
					if (j==3) throw temp.c_str();
				}
				//Intercepts for GC contents
				else if (temp.find("-BS") > -1 && (i+1) < argc ) {
					double num = toDouble(argv[++i]);
					for (j=0; j<3; j++) {
						string ab = "-BS" + toString(j+1);
						if (temp==ab) {
							bS[j] = num;
							break;
						}
					}
					if (j==3) throw temp.c_str();
				}
				//Slopes for purine contents
				else if (temp.find("-AR") > -1 && (i+1) < argc ) {
					double num = toDouble(argv[++i]);
					for (j=0; j<3; j++) {
						string ab = "-AR" + toString(j+1);
						if (temp==ab) {
							aR[j] = num;
							break;
						}
					}
					if (j==3) throw temp.c_str();
				}
				//Intercepts for purine contents
				else if (temp.find("-BR") > -1 && (i+1) < argc ) {
					double num = toDouble(argv[++i]);
					for (j=0; j<3; j++) {
						string ab = "-BR" + toString(j+1);
						if (temp==ab) {
							bR[j] = num;
							break;
						}
					}
					if (j==3) throw temp.c_str();
				}
				//Incorrect parameter
				else {
					throw temp.c_str();
				}
			}
			
			if (inputfile_flag==0) {				
				throw "no input file";
			}
			
			if (outputfile_flag==0) {
				outputFileName = inputFastaFileName + ".cat";
			}
			
		}		
	}
	catch (const char* e) {		
		cout<<ABBRNAME<<": incorrect option, '"<<e<<"'"<<endl;
		cout<<"For more help information, please type '"ABBRNAME<<" -h'."<<endl;
		flag = false;		
	}
	catch(int i) {
		showHelpInfo();
		flag = false;
	}
	catch (...) {		
		cout<<"For more help information, please type '"ABBRNAME<<" -h'."<<endl;
		flag = false;		
	}
	
	return flag;
}


int CAT::showHelpInfo() {
	cout<<"***********************************************************************"<<endl;
	cout<<ABBRNAME<<" ("<<FULLNAME<<"), Version "<<VERSION<<" ["<<LASTUPDATE<<"]"<<endl;	
	cout<<"Usage: "<<ABBRNAME<<" [OPTIONS]"<<endl;
	cout<<"***********************************************************************"<<endl<<endl;

	cout<<"OPTIONS:"<<endl;	
	cout<<"  -i\tinput fasta file name [string, required]"<<endl;
	cout<<"  -o\toutput file name [string, optional], default = input file name with the characters '.cat' appended."<<endl;
        //cout<<"  -t\ttRNA usage file [string, optional]"<<endl;	
	//cout<<"  -m\tmodel 1 (2-Parameter) or model 2 (6-Parameter) or both [integer, optional], {0:Both || 1:Model 1 || 2:Model 2}, default = "<<modelUsed<<endl;	
	cout<<"  -b\tbootstrap replications [integer, optional], default = "<<bootstrap<<endl;
	//cout<<"  -v\tverbose output [integer, optional], {0:No || 1:Yes}, default = "<<verbose<<endl;
	cout<<"  -c\tgenetic code to be used [integer, optional], default = "<<genetic_code<<endl;
	cout<<"    \tMore information about the genetic codes can be found at http://www.ncbi.nlm.nih.gov/Taxonomy/Utils/wprintgc.cgi"<<endl;
	cout<<endl;
	
	/*	
	int i;
	cout<<"  The following are the parameters used in Model 1, by linear regression between GC/purine content (S/R) and GC/purine content at three codon positions."<<endl;
	Parameters for GC contents
	for (i=1; i<=CODONSIZE; i++) cout<<"  -aS"<<i<<"\tslope for GC content at codon position "<<i<<", S"<<i<<" = aS"<<i<<" * S + bS"<<i<<", [double, optional], default = "<<aS[i-1]<<endl;	
	for (i=1; i<=CODONSIZE; i++) cout<<"  -bS"<<i<<"\tintercept for GC content at codon position "<<i<<", S"<<i<<" = aS"<<i<<" * S + bS"<<i<<", [double, optional], default = "<<bS[i-1]<<endl;
	Parameters for purine contents
	for (i=1; i<=CODONSIZE; i++) cout<<"  -aR"<<i<<"\tslope for purine content at codon position "<<i<<", R"<<i<<" = aR"<<i<<" * R + bR"<<i<<", [double, optional], default = "<<aR[i-1]<<endl;
	for (i=1; i<=CODONSIZE; i++) cout<<"  -bR"<<i<<"\tintercept for purine content at codon position "<<i<<", R"<<i<<" = aR"<<i<<" * R + bR"<<i<<", [double, optional], default = "<<bR[i-1]<<endl;
	cout<<endl;*/
	
	cout<<"COPYRIGHT & LICENSE:"<<endl;
	cout<<ABBRNAME" is distributed as open-source software and licensed under the GNU General Public License "<<endl;
	cout<<"(Version 3; http://www.gnu.org/licenses/gpl.txt), in the hope that it will be useful, but "<<endl;
	cout<<"WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A "<<endl;
	cout<<"PARTICULAR PURPOSE. See the GNU General Public License for more details."<<endl;
	cout<<endl;

	cout<<"CITATION:"<<endl;	
	cout<<CITATION<<endl;
	cout<<endl;

	cout<<"SEE ALSO:"<<endl;
	cout<<"For more information, please see <"<<WEBSITE<<">."<<endl;
	cout<<endl;

	cout<<"CONTACT:"<<endl;
	cout<<"Please send suggestions or bugs to Zhang Zhang at "<<EMAIL<<"."<<endl;
	cout<<endl;

	return 1;
}

/*
string CAT::getAllMeasures(vector<double> obs, vector<double> exp, long sampling_size) {
	string results = "";
	
	results += "\t" + toString(computeCosineDistance(obs, exp));
	
	double chisquare = computeChiSquareDistance(scaleVector(obs, sampling_size), scaleVector(exp,sampling_size));
	double pvalue = computeChiSquarePvalue(chisquare, obs.size()-1);
	results += "\t" + toString(chisquare);
	results += "\t" + toString(pvalue);
	
	results += "\t" + toString(computeEuclideanDistance(obs, exp));
	//results += "\t" + toString(computeMinkowskiDistance(obs, exp));
	//results += "\t" + toString(computeHellingerDistance(obs, exp));
	//results += "\t" + toString(computeJeffreyDivergence(obs, exp));
	//results += "\t" + toString(computeJensenShannonDivergence(obs, exp));

	return results;
}*/


/*************************************************************************
	CosineDistance (CD) = 1 - Cosine Similarity Coefficient
	cos(vec1, vec2) = vec1*vec2 / sqrt (sum(vec1*vec1) * sum(vec2*vec2) )
	CD ranges from 0 (no deviation) to 1 (significant deviation)
***********************************************************************************/
double CAT::computeCosineDistance(vector<double> vec1, vector<double> vec2) {

	int i;
	double sum1 = 0.0, sum2 = 0.0, sum3 = 0.0;
        
        vec1 = scaleVector(vec1, 1.0/sumVector(vec1));
        vec2 = scaleVector(vec2, 1.0/sumVector(vec2));

	for (i=0; i<vec1.size(); i++) {
		sum1 += vec1[i] * vec2[i];
		sum2 += vec1[i] * vec1[i];
		sum3 += vec2[i] * vec2[i];
	}
        
        //cout<<sum1<<" "<<sum2<<" "<<sum3<<endl;

	double DC = 1.0 - sum1 / sqrt(sum2 * sum3);

	return DC;	
}

double CAT::computeEuclideanDistance(vector<double> observed, vector<double> expected) {	

	int i;
	double sum = 0.0;

	for (i=0; i<observed.size(); i++) {
		sum += (observed[i] - expected[i]) * (observed[i] - expected[i]);
	}

	return sqrt(sum);
}

double CAT::computeMinkowskiDistance(vector<double> observed, vector<double> expected) {
	int i, order = observed.size();
	double sum = 0.0;

	for (i=0; i<order; i++) {
		sum += pow((observed[i] - expected[i]), order);
	}

	return pow(sum, 1.0 / order);
}

double CAT::computeHellingerDistance(vector<double> observed, vector<double> expected) {
	int i;
	double sum = 0.0;

	for (i=0; i<observed.size(); i++) {
		sum += pow(sqrt(observed[i]) - sqrt(expected[i]), 2);
	}

	return 0.5 * sum;
}

double CAT::computeJensenShannonDivergence(vector<double> observed, vector<double> expected) {
	int i;
	double sum1 = 0.0, sum2 = 0.0;

	for (i=0; i<observed.size(); i++) {
		double avg = 0.5 * (observed[i] + expected[i]);
		if (observed[i]>0.0) sum1 += observed[i] * log(observed[i] / avg) / log(2);
		sum2 += expected[i] * log(expected[i] / avg) / log(2);
	}

	return 0.5*sum1 + 0.5*sum2;
}

double CAT::computeJeffreyDivergence(vector<double> observed, vector<double> expected) {
	int i;
	double sum = 0.0;

	for (i=0; i<observed.size(); i++) {		
		sum += (expected[i]-observed[i]) * log(expected[i] / observed[i]);
	}

	return sum;
}

/*
//Chi-square = SUM [ (obvserved - expected)*(obvserved - expected) / expected ]	
double CAT::computeChiSquareDistance(vector<double> observed, vector<double> expected) {	
	
	int i;
	double ChiSquare = 0.0;
	int num = observed.size();
	for (i=0; i<num; i++) {
		if (expected[i] > SMALLVALUE) {
			ChiSquare += (observed[i] - expected[i]) * (observed[i] - expected[i]) / expected[i];
		}
	}
	
	return ChiSquare;
}


//P-value = Chi-square(d.f.)
double CAT::computeChiSquarePvalue(double chisquare, int df) {	
	ChiSquare ChiTest;
	return ChiTest.calc_pvalue_from_chi_df(chisquare, df);
}*/

int CAT::getSiRiContents(double S[], double R[]) {
	
	int i;
	for (i=0; i<CODONSIZE; i++) {
		//GC content: y = ax + b
		S[i+1] = aS[i] * S[0] + bS[i];
		//Purine content: y = ax + b
		R[i+1] = aR[i] * R[0] + bR[i];
	}

	return 1;
}

int CAT::predictBaseUsage(double S, double R, StringDouble &N4) {
	/* 
	Order: A. T. G. C
	A + G = P; G + C = S;
	=> A = R(1-S);	T = (1-R)(1-S);	G = RS;	C = (1-R)S;
	*/
	N4["A"] = R*(1-S);
	N4["T"] = (1-R)*(1-S);
	N4["G"] = R*S;
	N4["C"] = (1-R)*S;

	return 1;
}


int CAT::predictBaseCodonAAUsage(double S[], double R[]) {
	/* 
	Order: A. T. G. C
	Condition: A + G = R, G + C = S;
	=> A = R(1-S);	T = (1-R)(1-S);	G = RS;	C = (1-R)S;
	*/

	int i,j;

	//Nucletodies
	StringDouble N4[4];
	for (i=0; i<4; i++) {
		predictBaseUsage(S[i], R[i], N4[i]);
		string pos = (i==0)?"":toString(i);
		for (j=0; j<nucleotides.size(); j++) {
			map_expected[nucleotides[j]+pos] = N4[i][nucleotides[j]];
		}
	}

	//Codons
	StringDouble NNN64;
	initCodonMap(NNN64);
	double sum = 0.0;
	for (i=0; i<CODON; i++) {
		string codon = ID2Codon[i];
		double freq = N4[1][toString(codon[0])] * N4[2][toString(codon[1])] * N4[3][toString(codon[2])];
		if (getAminoAcid(codon)=='*' || getAminoAcid(codon)=='!') {
			NNN64[codon] = 0.0;
		}
		else {
			NNN64[codon] = freq;
			sum += freq;
		}
	}

	//Normalization of codon frequencies 
	for (i=0; i<CODON; i++) {
		NNN64[ID2Codon[i]] /= sum;
		map_expected[ID2Codon[i]] = NNN64[ID2Codon[i]];
	}

	//Amino Acids
	StringDouble AA20;
	initAminoAcidMap(AA20);
	for (i=0; i<CODON; i++) {
		string codon = ID2Codon[i];
		string aa3 = AminoAcid20[toString(getAminoAcid(codon))].ThreeLetter;
		AA20[aa3] += NNN64[codon];
	}

	for (i=0; i<aminoacid.size(); i++) {
		map_expected[aminoacid[i]] = AA20[aminoacid[i]];
	}

	return 1;
}

int CAT::analyzeOneCDS(string seq, string name) {

	long i,j,k;

	//initialize
	for (i=0; i<keywords_cds.size(); i++) {
		map_observed[keywords_cds[i]] = 0.0;
	}

	long len = seq.length();
	long number_of_codon = len / CODONSIZE;

	//Count 64 codons' frequencies
	for (i=0; i<seq.length(); i+=CODONSIZE) {
		string codon = seq.substr(i, CODONSIZE);
		map_observed[codon]++;
	}
	
	//Detailed analysis
	for (i=0; i<CODON; i++) {
		string codon = ID2Codon[i];
		string aa = toString(getAminoAcid(codon));

		map_observed[codon] = map_observed[codon] / number_of_codon;
		double frequency = map_observed[codon];

		//Nucleotides and nucleotides at three codon positions
		for (j=0; j<CODONSIZE; j++) {
			map_observed[toString(codon[j])] += frequency / CODONSIZE;
			map_observed[toString(codon[j]) + toString(j+1)] += frequency;
		}
		
		//Amino acid
		if (aa!="*" && aa!="!") map_observed[AminoAcid20[aa].ThreeLetter] += frequency;	
		
	}//End of i

        //RSCU
        for (i=0; i<CODON; i++) {
		string codon = ID2Codon[i];
		string aa = toString(getAminoAcid(codon));
		if (map_observed[codon]>0) {
                    map_observed["RSCU("+codon+")"] = CountOfSynCodons[genetic_code-1][aa] * map_observed[codon] / map_observed[AminoAcid20[aa].ThreeLetter];
                }
		
	}//End of i
        
	//Contents: GC, purine, etc.
	for (i=0; i<contents.size(); i++) {
		string cc = contents[i];
		for (j=0; j<cc.length(); j++) {			
			//Contents
			map_observed[cc] += map_observed[toString(cc[j])];
			//Contents at three codon positions
			for (k=1; k<=CODONSIZE; k++) {
				map_observed[cc+toString(k)] += map_observed[toString(cc[j])+toString(k)];
			}//End of k
		}//End of j
	}//End of i

	//GC and Purine Contents
	double GC[4], AG[4];
	GC[0] = map_observed["GC"];
	AG[0] = map_observed["AG"];
	
	//Model 1
	if (modelUsed==0 || modelUsed==1) {
		getSiRiContents(GC, AG);
		predictExpected(GC, AG, number_of_codon);
	}
	
	//Model 2
	if (modelUsed==0 || modelUsed==2) {
		for (i=1; i<=3; i++) {
			GC[i] = map_observed["GC" + toString(i)];
			AG[i] = map_observed["AG" + toString(i)];
		}
		predictExpected(GC, AG, number_of_codon);
	}
	
	//Bootstrap analyais and estimate bootstrap pvalues for each composition
	doBootStrap(GC, AG, number_of_codon);

        //map_estimated["tTSC4"] = measureTSC4(pvalue, flag, map_tRNA);
        //map_estimated["tTSC4"] = measureTSC4(map_observed, map_expected, map_tRNA);
        //map_estimated["tTSC5"] = measureTSC5(pvalue, flag, map_tRNA);
        //map_estimated["tTSC6"] = measureTSC6(map_observed, map_expected, pvalue, flag, map_tRNA);
        //map_estimated["tTSC7"] = measureTSC7(map_observed, map_expected, pvalue, flag, map_tRNA);
        
	return 1;
}

int CAT::doBootStrap(double S[], double R[], long number_of_codon) {
	
	long i, j, k, BS;
	
	double N34[3][4];   // e.g., 0---0.3---0.5---0.7---
	for (i=1; i<=3; i++) {
		string pos = toString(i);
		for (j=0; j<nucleotides.size(); j++) {
			double tmp = 0;
			for (k=0; k<j; k++) tmp += map_expected[nucleotides[k] + pos];
			N34[i-1][j] = tmp;
		}
	}

	double freq = 1.0 / number_of_codon;

	vector<DoubleVector> tally_codon(CODON);
	vector<DoubleVector> tally_nuc(DNASIZE), tally_nuc1(DNASIZE), tally_nuc2(DNASIZE), tally_nuc3(DNASIZE);
	vector<DoubleVector> tally_aa(20);
	vector<double> tally_cdc, tally_aadc, tally_ndc, tally_n1dc, tally_n2dc, tally_n3dc;

	//Bootstrap sampling
	for (BS=0; BS < bootstrap; BS++) {
	
		StringDouble BS_CODON64, BS_NUC16, BS_AMINOACID20;
		//init variables		
		for (i=0; i<=3; i++) {
			string pos = (i==0) ? "" : toString(i);
			for (j=0; j<nucleotides.size(); j++) BS_NUC16[nucleotides[j] + pos] = 0.0;
		}
		initCodonMap(BS_CODON64);
		initAminoAcidMap(BS_AMINOACID20);

		//randomly generate sequence with "len" codons
		long count = 0; 
		while (count < number_of_codon) {
			//Choose codon randomly
			string codon = "";
			for (j=0; j<CODONSIZE; j++) {
				double random = getRand0to1();
				string nuc = "";			
				for (k=nucleotides.size()-1; k>=0 && nuc==""; k--) {
					if (random >= N34[j][k]) {
						nuc = nucleotides[k];					
						codon += nuc;					
					}				
				}
			}
			//Check randomly generated codon
			string aa = toString(getAminoAcid(codon));				
			if (aa!="*" && aa!="!" && codon.length()==3) {	
				aa = AminoAcid20[aa].ThreeLetter;
				BS_CODON64[codon] += freq;
				for (j=0; j<CODONSIZE; j++) {
					BS_NUC16[toString(codon[j])] += (freq / 3.0);
					BS_NUC16[toString(codon[j]) + toString(j+1)] += freq;
				}
				BS_AMINOACID20[aa] += freq;
				count++;
			}
		}//End of while

		//Save codon frequencies into tally
		for (i=0; i<CODON; i++) {
			tally_codon[i].push_back(BS_CODON64[ID2Codon[i]]);
		}
		//Save Amino acids
		for(i=0; i<aminoacid.size(); i++) {
			tally_aa[i].push_back(BS_AMINOACID20[aminoacid[i]]);
		}
		//Nucletodies
		for (i=0; i<nucleotides.size(); i++) {					
			tally_nuc[i].push_back(BS_NUC16[nucleotides[i]]);
			tally_nuc1[i].push_back(BS_NUC16[nucleotides[i] + "1"]);
			tally_nuc2[i].push_back(BS_NUC16[nucleotides[i] + "2"]);
			tally_nuc3[i].push_back(BS_NUC16[nucleotides[i] + "3"]);
		}	
		
		//bootstrap estimates for codon deviation
		tally_cdc.push_back(measureCDC(BS_CODON64, map_expected));
		//bootstrap estimates for amino acid deviation
		tally_aadc.push_back(measureAADC(BS_AMINOACID20, map_expected));
		//bootstrap estimates for nucleotide deviation
		tally_ndc.push_back(measureNDC(BS_NUC16, map_expected, ""));
		tally_n1dc.push_back(measureNDC(BS_NUC16, map_expected, "1"));
		tally_n2dc.push_back(measureNDC(BS_NUC16, map_expected, "2"));
		tally_n3dc.push_back(measureNDC(BS_NUC16, map_expected, "3"));		

	}//End of BootStrap Sampling

	getBootstrapEstimates("CDC",  map_estimated["CDC"],  tally_cdc);
	getBootstrapEstimates("AADC", map_estimated["AADC"], tally_aadc);
	getBootstrapEstimates("NDC",  map_estimated["NDC"],  tally_ndc);
	getBootstrapEstimates("N1DC", map_estimated["N1DC"], tally_n1dc);
	getBootstrapEstimates("N2DC", map_estimated["N2DC"], tally_n2dc);
	getBootstrapEstimates("N3DC", map_estimated["N3DC"], tally_n3dc);

	//bootstrap estimates for codons
	for (i=0; i<CODON; i++) {
		string key = ID2Codon[i];
		vector<double> Posterior(tally_codon[i].begin(), tally_codon[i].end());
		getBootstrapEstimates(key, map_observed[key], Posterior);
	}
	
	//bootstrap estimates for amino acids
	for (i=0; i<aminoacid.size(); i++) {
		string key = aminoacid[i];
		vector<double> Posterior(tally_aa[i].begin(), tally_aa[i].end());
		getBootstrapEstimates(key, map_observed[key], Posterior);
	}

	//bootstrap estimates for nucletodies
	for (i=0; i<nucleotides.size(); i++) {
		string key = nucleotides[i];
		vector<double> Posterior(tally_nuc[i].begin(), tally_nuc[i].end());
		getBootstrapEstimates(key, map_observed[key], Posterior);
	}
	
	//bootstrap estimates for nucleotides at first codon position
	for (i=0; i<nucleotides.size(); i++) {
		string key = nucleotides[i] + "1";
		vector<double> Posterior(tally_nuc1[i].begin(), tally_nuc1[i].end());
		getBootstrapEstimates(key, map_observed[key], Posterior);
	}
	
	//bootstrap estimates for nucleotides at second codon position
	for (i=0; i<nucleotides.size(); i++) {
		string key = nucleotides[i] + "2";
		vector<double> Posterior(tally_nuc2[i].begin(), tally_nuc2[i].end());
		getBootstrapEstimates(key, map_observed[key], Posterior);
	}

	//bootstrap estimates for nucleotides at third codon position
	for (i=0; i<nucleotides.size(); i++) {
		string key = nucleotides[i] + "3";
		vector<double> Posterior(tally_nuc3[i].begin(), tally_nuc3[i].end());
		getBootstrapEstimates(key, map_observed[key], Posterior);
	}

	return 1;
}

int CAT::getBootstrapEstimates(string key, double reference_value, vector<double> Posterior) {
	
	//sort the vector
	sort(Posterior.begin(), Posterior.end());
	
	//(-)97.5% CI
	double low = Posterior[(int)(0.025 * Posterior.size())];		
	//Median Value 50%
	double med = Posterior[(int)(0.5 * Posterior.size())];
	//(+)97.5% CI
	double upp = Posterior[(int)(0.975 * Posterior.size())];
	
	//flag: obs > med or obs < med (-)
	string flg = "+";
	if (reference_value < med) flg = "-";

	int i, lower_count = 0, upper_count = 0;
	for (i=0; i < Posterior.size() && reference_value >= Posterior[i]; i++) lower_count++;
	for (i=Posterior.size()-1; i >= 0 && reference_value <= Posterior[i]; i--) upper_count++;
	
	//P-value
	double pvl = min2(lower_count, upper_count) * 2.0 / bootstrap;
	//Seldom case: 0.1, 0.1, 0.1, ....., 0.1, 0.3, if reference_value=0.1
	if (2*lower_count > bootstrap && 2*upper_count > bootstrap) pvl /= 2.0;  	
	
	pvalue[key] = pvl;
	flag[key] = flg;
	median[key] = med;
	lowerCI[key] = low;
	upperCI[key] = upp;

	return 1;
}

string CAT::outputResults(string name, long len) {
	
	int i, j;
	
	string output = name + "\t" + toString(len);
	

	//GC and purine contents
	for (i=0; i<contents.size(); i++) {
		output += "\t" + toString(map_observed[contents[i]]);
	}

	//Positional GC and purine contents
	for (i=0; i<codon_contents.size(); i++) {
		output += "\t" + toString(map_observed[codon_contents[i]]);
	}
	
	//CDC
	string output_codon = "";
        /*
        output_codon += toString(map_estimated["CDC0"]);
	output_codon += "\t"+toString(map_estimated["tTSC1"]);
	output_codon += "\t"+toString(map_estimated["tTSC2"]);
	output_codon += "\t"+toString(map_estimated["tTSC3"]);
        output_codon += "\t"+toString(map_estimated["tTSC4"]);
	output_codon += "\t"+toString(map_estimated["tTSC5"]);
        output_codon += "\t"+toString(map_estimated["tTSC6"]);
	output_codon += "\t"+toString(map_estimated["tTSC7"]);
        */
        
	output_codon += toString(map_estimated["CDC"]);
	output_codon += "\t" + toString(pvalue["CDC"]);
	//output_codon += "\t" + toString(pvalue["CDC"]) + " (" + flag["CDC"] + ")";
	//output_codon += "\t[" + toString(lowerCI["CDC"]) + ", " + toString(upperCI["CDC"]) + "]";

	//Output for codons
	for(i=0; i<CODON; i++) {
		string codon = ID2Codon[i];
		//Observed
		output_codon += "\t" + toString(map_observed[codon]);		
		//Expected
		output_codon += "\t" + toString(map_expected[codon]);
		//Bootstrap pvalue
		output_codon += "\t" + toString(pvalue[codon]) + " (" + flag[codon] + ")";
		//Bootstrap 95% confidence intervals
		//output_codon += "\t[" + toString(lowerCI[codon]) + ", " + toString(upperCI[codon]) + "]";
	}
        
        //RSCU values
        for(i=0; i<CODON; i++) {
		string codon = ID2Codon[i];
		output_codon += "\t" + toString(map_observed["RSCU("+codon+")"]);		
	}

	//Output for amino acids
	string output_aa = toString(map_estimated["AADC"]);
	output_aa += "\t" + toString(pvalue["AADC"]);
	//output_aa += "\t" + toString(pvalue["AADC"]) + " (" + flag["AADC"] + ")";
	//output_aa += "\t[" + toString(lowerCI["AADC"]) + ", " + toString(upperCI["AADC"]) + "]";
	for (i=0; i<aminoacid.size(); i++) {
		//Observed
		output_aa += "\t" + toString(map_observed[aminoacid[i]]);
		//Expected
		output_aa += "\t" + toString(map_expected[aminoacid[i]]);
		//Bootstrap pvalue
		output_aa += "\t"+ toString(pvalue[aminoacid[i]]) + " (" + flag[aminoacid[i]] + ")";
		//Bootstrap 95% confidence intervals
		//output_aa += "\t[" + toString(lowerCI[aminoacid[i]]) + ", " + toString(upperCI[aminoacid[i]]) + "]";
	}

	//Output for nucleotides
	string output_nuc[4];
	for (j=0; j<=3; j++) {
		string pos = (j==0) ? "" : toString(j);
		string key = "N" + pos + "DC";
		output_nuc[j] = toString(map_estimated[key]);
		output_nuc[j] += "\t" + toString(pvalue[key]);
		//output_nuc[j] += "\t" + toString(pvalue[key]) + " (" + flag[key] + ")";
		//output_nuc[j] += "\t[" + toString(lowerCI[key]) + ", " + toString(upperCI[key]) + "]";
		for (i=0; i<nucleotides.size(); i++) {
			key = nucleotides[i] + pos;
			//Observed
			output_nuc[j] += "\t" + toString(map_observed[key]);
			//Expected
			output_nuc[j] += "\t" + toString(map_expected[key]);			
			//Bootstrap pvalue
			output_nuc[j] += "\t" + toString(pvalue[key]) + " (" + flag[key] + ")";
			//Bootstrap 95% confidence intervals
			//output_nuc[j] += "\t[" + toString(lowerCI[key]) + ", " + toString(upperCI[key]) + "]";
		}
	}

	output += "\t" + output_codon + "\t" + output_aa;
	for (i=0; i<=3; i++) output += "\t" + output_nuc[i];
	output += "\n";

	return output;
}

int CAT::readtRNA(string seqfile, StringDouble &map_tRNA) {

	int flag = 1;
        
        initCodonMap(map_tRNA, 0);
        int sum_tRNA = 0;

	try {

		ifstream is(seqfile.c_str());
		if (!is) {
			cout<<"Error in opening file..."<<endl;
			throw 1;
		}		
				
		string temp="";
		
		getline(is, temp, '\n');
		while (temp!="") {
			if ( (int)(temp.find('#') ) < 0 ) {
                            vector<string> cell = splitString(temp, '\t');
                            string aa = toString(getAminoAcid(cell[0]));
                            if (aa!="!" && aa!="*") {
                                    map_tRNA[cell[0]] = toDouble(cell[1]);
                                    sum_tRNA += toDouble(cell[1]);
                            }
                            //cout<<cell[0]<<" "<<cell[1]<<endl;
                        }
                        getline(is, temp, '\n');
		}		

		is.close();
		is.clear();
	}
	catch (...) {		
		flag = 0;
		cout<<"Error in reading input fasta file."<<endl;
	}
        
        int i;
        for (i=0; i<CODON; i++) {
            map_tRNA[ID2Codon[i]] /= sum_tRNA;
            //cout<<ID2Codon[i]<<" "<<map_tRNA[ID2Codon[i]]<<endl;
        }
        
	return flag;
}

double CAT::measureCDC0(StringDouble observed) {
	//Measures for Codon
	int i;
	vector<double> obs_codon, exp_codon;	
	for (i=0; i<CODON; i++) {
		string aa = toString(getAminoAcid(ID2Codon[i]));		
		if (aa!="!" && aa!="*") {
			obs_codon.push_back(observed[ID2Codon[i]]);
			exp_codon.push_back( 1.0 / ( 64 - getNumNonsense() ) );
		}
	}
	return computeCosineDistance(obs_codon, exp_codon);
}

double CAT::measureTSC1(StringDouble observed, StringDouble map_tRNA) {
	//Measures for Codon
	int i;
        
	vector<double> obs_codon, exp_codon;	
	for (i=0; i<CODON; i++) {
		string aa = toString(getAminoAcid(ID2Codon[i]));		
		if (aa!="!" && aa!="*") {
			obs_codon.push_back(observed[ID2Codon[i]]);
			exp_codon.push_back(map_tRNA[ID2Codon[i]]);
		}
	}
	return computeCosineDistance(obs_codon, exp_codon);
}

double CAT::measureTSC2(StringDouble observed, StringDouble expected, StringDouble map_tRNA) {
	//Measures for Codon
	int i;
	vector<double> obs_codon, exp_codon;	
	for (i=0; i<CODON; i++) {
		string aa = toString(getAminoAcid(ID2Codon[i]));		
		if (aa!="!" && aa!="*") {
                    double dd=(observed[ID2Codon[i]] - expected[ID2Codon[i]]) / expected[ID2Codon[i]];
                    if (dd<0) dd=0;
                    obs_codon.push_back( dd );
		    exp_codon.push_back(map_tRNA[ID2Codon[i]]);
		}
	}
	return computeCosineDistance(obs_codon, exp_codon);
}

double CAT::measureTSC3(StringDouble observed, StringDouble expected, StringDouble map_tRNA) {
	//Measures for Codon
	int i;
	vector<double> obs_codon, exp_codon;	
	for (i=0; i<CODON; i++) {
		string aa = toString(getAminoAcid(ID2Codon[i]));		
		if (aa!="!" && aa!="*") {
                        double dd= observed[ID2Codon[i]] - expected[ID2Codon[i]];
                        if (dd<0) dd=0;
                        obs_codon.push_back( dd );
                        exp_codon.push_back(map_tRNA[ID2Codon[i]]);
		}
	}
	return computeCosineDistance(obs_codon, exp_codon);
}

double CAT::measureTSC4(StringDouble pvalue, StringString flag, StringDouble map_tRNA) {
	//Measures for Codon
	int i;
        vector<double> obs_codon, exp_codon;	
	for (i=0; i<CODON; i++) {
		string aa = toString(getAminoAcid(ID2Codon[i]));		
		if (aa!="!" && aa!="*") {
                        double dd = 1.0 - pvalue[ID2Codon[i]];
                        if (flag[ID2Codon[i]]=="-") dd = -dd;
                        //if (dd<0) dd=0;
                        obs_codon.push_back( dd );
                        exp_codon.push_back(map_tRNA[ID2Codon[i]]);
                }
	}
	return computeCosineDistance(obs_codon, exp_codon);
}

double CAT::measureTSC5(StringDouble pvalue, StringString flag, StringDouble map_tRNA) {
	//Measures for Codon
	int i;
        vector<double> obs_codon, exp_codon;	
	for (i=0; i<CODON; i++) {
		string aa = toString(getAminoAcid(ID2Codon[i]));		
		if (aa!="!" && aa!="*") {
                        double dd= 1-pvalue[ID2Codon[i]];
                        if (flag[ID2Codon[i]]=="-") dd = -dd;
                        if (dd<0) dd=0;
                        obs_codon.push_back( dd );
                        exp_codon.push_back(map_tRNA[ID2Codon[i]]);
                }
	}
	return computeCosineDistance(obs_codon, exp_codon);
}



double CAT::measureTSC6(StringDouble observed, StringDouble expected, StringDouble pvalue, StringString flag, StringDouble map_tRNA) {
	//Measures for Codon
	int i;
        vector<double> obs_codon, exp_codon;	
	for (i=0; i<CODON; i++) {
		string aa = toString(getAminoAcid(ID2Codon[i]));		
		if (aa!="!" && aa!="*") {
                        double dd = (1.0 - pvalue[ID2Codon[i]] ) * (observed[ID2Codon[i]] - expected[ID2Codon[i]]) / expected[ID2Codon[i]];
                        if (dd<0) dd=0;
                        obs_codon.push_back( dd );
                        exp_codon.push_back(map_tRNA[ID2Codon[i]]);
                }
	}
	return computeCosineDistance(obs_codon, exp_codon);
}

double CAT::measureTSC7(StringDouble observed, StringDouble expected, StringDouble pvalue, StringString flag, StringDouble map_tRNA) {
	//Measures for Codon
	int i;
        vector<double> obs_codon, exp_codon;	
	for (i=0; i<CODON; i++) {
		string aa = toString(getAminoAcid(ID2Codon[i]));		
		if (aa!="!" && aa!="*") {
                        double dd = (1.0 - pvalue[ID2Codon[i]] ) * (observed[ID2Codon[i]] - expected[ID2Codon[i]]);
                        if (dd<0) dd=0;
                        obs_codon.push_back( dd );
                        exp_codon.push_back(map_tRNA[ID2Codon[i]]);
                }
	}
	return computeCosineDistance(obs_codon, exp_codon);
}

double CAT::measureCDC(StringDouble observed, StringDouble expected) {
	//Measures for Codon
	int i;
	vector<double> obs_codon, exp_codon;	
	for (i=0; i<CODON; i++) {
		string aa = toString(getAminoAcid(ID2Codon[i]));		
		if (aa!="!" && aa!="*") {
			obs_codon.push_back(observed[ID2Codon[i]]);
			exp_codon.push_back(expected[ID2Codon[i]]);
		}
	}
	return computeCosineDistance(obs_codon, exp_codon);
}

double CAT::measureAADC(StringDouble observed, StringDouble expected) {
	//Measures for Codon
	int i;
	vector<double> obs_aa, exp_aa;		
	for (i=0; i<aminoacid.size(); i++) {
		obs_aa.push_back(observed[aminoacid[i]]);
		exp_aa.push_back(expected[aminoacid[i]]);
	}
	return computeCosineDistance(obs_aa, exp_aa);
}

double CAT::measureNDC(StringDouble observed, StringDouble expected, string pos) {
	//Measures for Codon
	int i;
	vector<double> obs_nuc, exp_nuc;	
	for (i=0; i<nucleotides.size(); i++) {	
		obs_nuc.push_back(observed[nucleotides[i] + pos]);
		exp_nuc.push_back(expected[nucleotides[i] + pos]);		
	}
	return computeCosineDistance(obs_nuc, exp_nuc);
}

int CAT::predictExpected(double GC[], double AG[], long number_of_codon) {

	int flag = 1;
	
	try {
		//Predict expected base, codon, and amino acid frequencies
		predictBaseCodonAAUsage(GC, AG);		
		map_estimated["CDC0"] = measureCDC0(map_observed);
                
                map_estimated["tTSC1"] = measureTSC1(map_observed, map_tRNA);
                map_estimated["tTSC2"] = measureTSC2(map_observed, map_expected, map_tRNA);
                map_estimated["tTSC3"] = measureTSC3(map_observed, map_expected, map_tRNA);

                
                //Measure Codon Deviation Coefficient
		map_estimated["CDC"] = measureCDC(map_observed, map_expected);
                //Measures Amino-Acid Deviation Coefficient
		map_estimated["AADC"] = measureAADC(map_observed, map_expected);
		//Measures Nucleotide Deviation Coefficient
		map_estimated["NDC"] = measureNDC(map_observed, map_expected, "");
		//Measures Deviation Coefficient of Nucleotide at first position
		map_estimated["N1DC"] = measureNDC(map_observed, map_expected, "1");
		//Measures Deviation Coefficient of Nucleotide at second position
		map_estimated["N2DC"] = measureNDC(map_observed, map_expected, "2");
		//Measures Deviation Coefficient of Nucleotide at third position
		map_estimated["N3DC"] = measureNDC(map_observed, map_expected, "3");		
	}
	catch (...) {
		flag = 0;
	}
	
	return flag;
}


int CAT::analyzeCDSs(vector<string> seqs, vector<string> names) { 

	int flag = 1;

	long i;

	try {

		//Open the output file
		ofstream os(outputFileName.c_str());			
		if (!os.is_open()) throw "Error in opening file";
		
		//Write the header
		os<<setCDSHeader();

		//Analyze all CDSs
		for (i=0; i<seqs.size(); i++) {
			cout<<"["<<i+1<<"] "<<names[i].c_str();
			string seq = StringToUpper(seqs[i]);
			if (seq.length()%3==0) {
				//Check input sequence
				seq = removeGapStopCodon(seq);
				//Analyze one CDS
				analyzeOneCDS(seq, names[i]);
				//Output results
				os<<outputResults(names[i], seq.length());				
				//Display message on screen
				cout<<"\t[OK]"<<endl;				
			}
			else {
				cout<<"\tCoding sequence? Length can be divided by 3.\t[Error]"<<endl;
			}
		}

		//Export results and close the file
		cout<<endl<<"Exporting results: ";
		cout<<outputFileName<<endl;
		os.close();
	}
	catch (const char* msg) {
		cout<<msg<<endl;
	}
	catch (...) {
		flag = 0;
	}
		

	return flag;
}

string CAT::setCDSHeader() {
	
	int i, j, m;

	vector<string> models;
	if (modelUsed==0) {
		models.push_back("(M1)");
		models.push_back("(M2)");
	}
	else {
		models.push_back("");
	}

	string output = "ID\tLength";

	for (i=0; i<contents.size(); i++) output += "\t" + contents[i];
	for (i=0; i<codon_contents.size(); i++) output += "\t" + codon_contents[i];
	
        /*
         output += "\tCDC0";
        
        output += "\ttTSC1";
        output += "\ttTSC2";
        output += "\ttTSC3";
        output += "\ttTSC4";
        output += "\ttTSC5";
        output += "\ttTSC6";
        output += "\ttTSC7";
        */
        
	for (m = 0; m < models.size(); m++) {
		
		//codons
		output += "\tCDC" + models[m];
		output += "\tP(CDC)" + models[m];
		//output += "\t95% Credible Interval(CDC)" + models[m];

		for (i=0; i<CODON; i++) {			
			output += "\tObserved " + ID2Codon[i];
			output += "\tExpected " + ID2Codon[i] + models[m];
			output += "\tP(" + ID2Codon[i] + ")" + models[m];
			//output += "\t95% Credible Interval(" + ID2Codon[i] + ")" + models[m];
		}
                
                //RSCU
                for (i=0; i<CODON; i++) {			
			output += "\tRSCU(" + ID2Codon[i] + ")";
		}

		//amino acids
		output += "\tAADC" + models[m];
		output += "\tP(AADC)" + models[m];
		//output += "\t95% Credible Interval(AADC)" + models[m];
		for (i=0; i<aminoacid.size(); i++) {
			output += "\tObserved " + aminoacid[i];
			output += "\tExpected " + aminoacid[i] + models[m];
			output += "\tP(" + aminoacid[i] + ")" + models[m];
			//output += "\t95% Credible Interval(" + aminoacid[i] + ")" + models[m];
		}

		//nucleotides
		for (j=0; j<=3; j++) {
			string pos = (j==0) ? "" : toString(j);	
			output += "\tN" + pos + "DC" + models[m];
			output += "\tP(N" + pos + "DC)" + models[m];
			//output += "\t95% Credible Interval(N" + pos + "DC)" + models[m];
			for (i=0; i<nucleotides.size(); i++) {
				string nuc = nucleotides[i] + pos;
				output += "\tObserved " + nuc;
				output += "\tExpected " + nuc + models[m];				
				output += "\tP(" + nuc + ")" + models[m];
				//output += "\t95% Credible Interval(" + nuc + ")" + models[m];
			}
		}
	}//end of m
	
	output += "\n";

	return output;
}


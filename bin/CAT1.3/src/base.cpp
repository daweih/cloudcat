/******************************************************************
* Copyright (c) 2013
* All rights reserved.
 
* Filename: base.h
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

* Note: 


******************************************************************/

#include "base.h"

//Constructor function
Base::Base() {
	
	srand((unsigned)time(NULL));
	
	//Nucleotides: 4
	nucleotides.push_back("A");
	nucleotides.push_back("T");
	nucleotides.push_back("G");
	nucleotides.push_back("C");

	//Nucleotide nucleotides: 3*4
	int i, j;
	for (i=1; i<=CODONSIZE; i++) {
		for (j=0; j<nucleotides.size(); j++) {
			codon_nucleotides.push_back(nucleotides[j]+toString(i));
		}
	}

	//Contents: GC, purine
	contents.push_back("GC");
	contents.push_back("AG");
	for (i=1; i<=CODONSIZE; i++) {
		for (j=0; j<contents.size(); j++) {
			codon_contents.push_back(contents[j]+toString(i));
		}
	}

	//Codons
	int id = 0;
	ID2Codon[id++] = "AAA";
	ID2Codon[id++] = "AAG";
	ID2Codon[id++] = "AAT";
	ID2Codon[id++] = "AAC";
	ID2Codon[id++] = "TAA";
	ID2Codon[id++] = "TAG";
	ID2Codon[id++] = "TAT";
	ID2Codon[id++] = "TAC";
	ID2Codon[id++] = "ATA";
	ID2Codon[id++] = "ATG";
	ID2Codon[id++] = "ATT";
	ID2Codon[id++] = "ATC";
	ID2Codon[id++] = "TTA";
	ID2Codon[id++] = "TTG";
	ID2Codon[id++] = "TTT";
	ID2Codon[id++] = "TTC";
	ID2Codon[id++] = "GAA";
	ID2Codon[id++] = "GAG";
	ID2Codon[id++] = "GAT";
	ID2Codon[id++] = "GAC";
	ID2Codon[id++] = "CAA";
	ID2Codon[id++] = "CAG";
	ID2Codon[id++] = "CAT";
	ID2Codon[id++] = "CAC";
	ID2Codon[id++] = "GTA";
	ID2Codon[id++] = "GTG";
	ID2Codon[id++] = "GTT";
	ID2Codon[id++] = "GTC";
	ID2Codon[id++] = "CTA";
	ID2Codon[id++] = "CTG";
	ID2Codon[id++] = "CTT";
	ID2Codon[id++] = "CTC";
	ID2Codon[id++] = "AGA";
	ID2Codon[id++] = "AGG";
	ID2Codon[id++] = "AGT";
	ID2Codon[id++] = "AGC";
	ID2Codon[id++] = "TGA";
	ID2Codon[id++] = "TGG";
	ID2Codon[id++] = "TGT";
	ID2Codon[id++] = "TGC";
	ID2Codon[id++] = "ACA";
	ID2Codon[id++] = "ACG";
	ID2Codon[id++] = "ACT";
	ID2Codon[id++] = "ACC";
	ID2Codon[id++] = "TCA";
	ID2Codon[id++] = "TCG";
	ID2Codon[id++] = "TCT";
	ID2Codon[id++] = "TCC";
	ID2Codon[id++] = "GGA";
	ID2Codon[id++] = "GGG";
	ID2Codon[id++] = "GGT";
	ID2Codon[id++] = "GGC";
	ID2Codon[id++] = "CGA";
	ID2Codon[id++] = "CGG";
	ID2Codon[id++] = "CGT";
	ID2Codon[id++] = "CGC";
	ID2Codon[id++] = "GCA";
	ID2Codon[id++] = "GCG";
	ID2Codon[id++] = "GCT";
	ID2Codon[id++] = "GCC";
	ID2Codon[id++] = "CCA";
	ID2Codon[id++] = "CCG";
	ID2Codon[id++] = "CCT";
	ID2Codon[id++] = "CCC";

	IntString::iterator pos;
	for(pos=ID2Codon.begin(); pos!=ID2Codon.end(); pos++) {
		Codon2ID[pos->second] = pos->first;
	}

	genetic_code = 1;

	/**********************************************************************************
	                               The Genetic Codes
	http://www.ncbi.nlm.nih.gov/Taxonomy/taxonomyhome.html/index.cgi?chapter=cgencodes 
	**********************************************************************************/
	genetic_code_name.push_back("1-The Standard Code");
	genetic_code_name.push_back("2-The Vertebrate Mitochondrial Code");
	genetic_code_name.push_back("3-The Yeast Mitochondrial Code");
	genetic_code_name.push_back("4-The Mold, Protozoan, and Coelenterate Mitochondrial Code and the Mycoplasma/Spiroplasma Code");
	genetic_code_name.push_back("5-The Invertebrate Mitochondrial Code");
	genetic_code_name.push_back("6-The Ciliate, Dasycladacean and Hexamita Nuclear Code");
	genetic_code_name.push_back("7-");
	genetic_code_name.push_back("8-");
	genetic_code_name.push_back("9-The Echinoderm and Flatworm Mitochondrial Code");
	genetic_code_name.push_back("10-The Euplotid Nuclear Code");
	genetic_code_name.push_back("11-The Bacterial, Archaeal and Plant Plastid Code");
	genetic_code_name.push_back("12-The Alternative Yeast Nuclear Code");
	genetic_code_name.push_back("13-The Ascidian Mitochondrial Code");
	genetic_code_name.push_back("14-The Alternative Flatworm Mitochondrial Code");
	genetic_code_name.push_back("15-The Blepharisma Nuclear Code");
	genetic_code_name.push_back("16-The Chlorophycean Mitochondrial Code");
	genetic_code_name.push_back("17-");
	genetic_code_name.push_back("18-");
	genetic_code_name.push_back("19-");
	genetic_code_name.push_back("20-");
	genetic_code_name.push_back("21-The Trematode Mitochondrial Code");
	genetic_code_name.push_back("22-The Scenedesmus Obliquus Mitochondrial Code");
	genetic_code_name.push_back("23-The Thraustochytrium Mitochondrial Code");
	
	//Codons & Genetic Codes
	Codon64["AAA"] = Codon("D", "1", "KKKKKK!!NKKKKNKK!!!!NKK");
	Codon64["AAG"] = Codon("D", "1", "KKKKKK!!KKKKKKKK!!!!KKK");
	Codon64["AAT"] = Codon("D", "1", "NNNNNN!!NNNNNNNN!!!!NNN");
	Codon64["AAC"] = Codon("D", "1", "NNNNNN!!NNNNNNNN!!!!NNN");
	Codon64["TAA"] = Codon("D", "1", "*****Q!!*****Y**!!!!***");
	Codon64["TAG"] = Codon("D", "1", "*****Q!!******QL!!!!*L*");
	Codon64["TAT"] = Codon("D", "1", "YYYYYY!!YYYYYYYY!!!!YYY");
	Codon64["TAC"] = Codon("D", "1", "YYYYYY!!YYYYYYYY!!!!YYY");
	Codon64["ATA"] = Codon("D", "1", "IMMIMI!!IIIIMIII!!!!MII");
	Codon64["ATG"] = Codon("D", "1", "MMMMMM!!MMMMMMMM!!!!MMM");
	Codon64["ATT"] = Codon("D", "1", "IIIIII!!IIIIIIII!!!!III");
	Codon64["ATC"] = Codon("D", "1", "IIIIII!!IIIIIIII!!!!III");
	Codon64["TTA"] = Codon("D", "1", "LLLLLL!!LLLLLLLL!!!!LL*");
	Codon64["TTG"] = Codon("D", "1", "LLLLLL!!LLLLLLLL!!!!LLL");
	Codon64["TTT"] = Codon("D", "1", "FFFFFF!!FFFFFFFF!!!!FFF");
	Codon64["TTC"] = Codon("D", "1", "FFFFFF!!FFFFFFFF!!!!FFF");

	Codon64["GAA"] = Codon("D", "2", "EEEEEE!!EEEEEEEE!!!!EEE");
	Codon64["GAG"] = Codon("D", "2", "EEEEEE!!EEEEEEEE!!!!EEE");
	Codon64["GAT"] = Codon("D", "2", "DDDDDD!!DDDDDDDD!!!!DDD");
	Codon64["GAC"] = Codon("D", "2", "DDDDDD!!DDDDDDDD!!!!DDD");
	Codon64["CAA"] = Codon("D", "2", "QQQQQQ!!QQQQQQQQ!!!!QQQ");
	Codon64["CAG"] = Codon("D", "2", "QQQQQQ!!QQQQQQQQ!!!!QQQ");
	Codon64["CAT"] = Codon("D", "2", "HHHHHH!!HHHHHHHH!!!!HHH");
	Codon64["CAC"] = Codon("D", "2", "HHHHHH!!HHHHHHHH!!!!HHH");
	Codon64["GTA"] = Codon("R", "2", "VVVVVV!!VVVVVVVV!!!!VVV");
	Codon64["GTG"] = Codon("R", "2", "VVVVVV!!VVVVVVVV!!!!VVV");
	Codon64["GTT"] = Codon("R", "2", "VVVVVV!!VVVVVVVV!!!!VVV");
	Codon64["GTC"] = Codon("R", "2", "VVVVVV!!VVVVVVVV!!!!VVV");
	Codon64["CTA"] = Codon("R", "2", "LLTLLL!!LLLLLLLL!!!!LLL");
	Codon64["CTG"] = Codon("R", "2", "LLTLLL!!LLLSLLLL!!!!LLL");
	Codon64["CTT"] = Codon("R", "2", "LLTLLL!!LLLLLLLL!!!!LLL");
	Codon64["CTC"] = Codon("R", "2", "LLTLLL!!LLLLLLLL!!!!LLL");

	Codon64["AGA"] = Codon("D", "3", "R*RRSR!!SRRRGSRR!!!!SRR");
	Codon64["AGG"] = Codon("D", "3", "R*RRSR!!SRRRGSRR!!!!SRR");
	Codon64["AGT"] = Codon("D", "3", "SSSSSS!!SSSSSSSS!!!!SSS");
	Codon64["AGC"] = Codon("D", "3", "SSSSSS!!SSSSSSSS!!!!SSS");
	Codon64["TGA"] = Codon("D", "3", "*WWWW*!!WC**WW**!!!!W**");
	Codon64["TGG"] = Codon("D", "3", "WWWWWW!!WWWWWWWW!!!!WWW");
	Codon64["TGT"] = Codon("D", "3", "CCCCCC!!CCCCCCCC!!!!CCC");
	Codon64["TGC"] = Codon("D", "3", "CCCCCC!!CCCCCCCC!!!!CCC");
	Codon64["ACA"] = Codon("R", "3", "TTTTTT!!TTTTTTTT!!!!TTT");
	Codon64["ACG"] = Codon("R", "3", "TTTTTT!!TTTTTTTT!!!!TTT");
	Codon64["ACT"] = Codon("R", "3", "TTTTTT!!TTTTTTTT!!!!TTT");
	Codon64["ACC"] = Codon("R", "3", "TTTTTT!!TTTTTTTT!!!!TTT");
	Codon64["TCA"] = Codon("R", "3", "SSSSSS!!SSSSSSSS!!!!S*S");
	Codon64["TCG"] = Codon("R", "3", "SSSSSS!!SSSSSSSS!!!!SSS");
	Codon64["TCT"] = Codon("R", "3", "SSSSSS!!SSSSSSSS!!!!SSS");
	Codon64["TCC"] = Codon("R", "3", "SSSSSS!!SSSSSSSS!!!!SSS");

	Codon64["GGA"] = Codon("R", "4", "GGGGGG!!GGGGGGGG!!!!GGG");
	Codon64["GGG"] = Codon("R", "4", "GGGGGG!!GGGGGGGG!!!!GGG");
	Codon64["GGT"] = Codon("R", "4", "GGGGGG!!GGGGGGGG!!!!GGG");
	Codon64["GGC"] = Codon("R", "4", "GGGGGG!!GGGGGGGG!!!!GGG");
	Codon64["CGA"] = Codon("R", "4", "RRRRRR!!RRRRRRRR!!!!RRR");
	Codon64["CGG"] = Codon("R", "4", "RRRRRR!!RRRRRRRR!!!!RRR");
	Codon64["CGT"] = Codon("R", "4", "RRRRRR!!RRRRRRRR!!!!RRR");
	Codon64["CGC"] = Codon("R", "4", "RRRRRR!!RRRRRRRR!!!!RRR");
	Codon64["GCA"] = Codon("R", "4", "AAAAAA!!AAAAAAAA!!!!AAA");
	Codon64["GCG"] = Codon("R", "4", "AAAAAA!!AAAAAAAA!!!!AAA");
	Codon64["GCT"] = Codon("R", "4", "AAAAAA!!AAAAAAAA!!!!AAA");
	Codon64["GCC"] = Codon("R", "4", "AAAAAA!!AAAAAAAA!!!!AAA");
	Codon64["CCA"] = Codon("R", "4", "PPPPPP!!PPPPPPPP!!!!PPP");
	Codon64["CCG"] = Codon("R", "4", "PPPPPP!!PPPPPPPP!!!!PPP");
	Codon64["CCT"] = Codon("R", "4", "PPPPPP!!PPPPPPPP!!!!PPP");
	Codon64["CCC"] = Codon("R", "4", "PPPPPP!!PPPPPPPP!!!!PPP"); 
        
	//Amino Acids and their physico-chemical properties
	AminoAcid20["K"] = AminoAcid("Lys",	"Lysine",         146.18934, -3.9, 200, 168.6, "Polar"    , "Positive", "alpha");
	AminoAcid20["N"] = AminoAcid("Asn",	"Asparagine",     132.11904, -3.5, 160, 114.1, "Polar"    , "Neutral" , "turn" );
	AminoAcid20["Y"] = AminoAcid("Tyr",	"Tyrosine",       181.19124, -1.3, 230, 193.6, "Polar"    , "Neutral" , "beta" );
	AminoAcid20["I"] = AminoAcid("Ile",	"Isoleucine",     131.17464,  4.5, 175, 166.7, "Nonpolar" , "Neutral" , "beta" );
	AminoAcid20["M"] = AminoAcid("Met",	"Methionine",     149.20784,  1.9, 185, 162.9, "Nonpolar" , "Neutral" , "alpha");
	AminoAcid20["L"] = AminoAcid("Leu",	"Leucine",        131.17464,  3.8, 170, 166.7, "Nonpolar" , "Neutral" , "alpha");
	AminoAcid20["F"] = AminoAcid("Phe",	"Phenylalanine",  165.19184,  2.8, 210, 189.9, "Nonpolar" , "Neutral" , "beta" );
	
	AminoAcid20["E"] = AminoAcid("Glu",	"Glutamic acid",  147.13074, -3.5, 190, 138.4, "Polar"    , "Negative", "alpha");
	AminoAcid20["D"] = AminoAcid("Asp",	"Aspartic acid",  133.10384, -3.5, 150, 111.1, "Polar"    , "Negative", "turn" );
	AminoAcid20["Q"] = AminoAcid("Gln",	"Glutamine",      146.14594, -3.5, 180, 143.8, "Polar"    , "Neutral" , "alpha");
	AminoAcid20["H"] = AminoAcid("His",	"Histidine",      155.15634, -3.2, 195, 153.2, "Polar"    , "Positive", "alpha");
	AminoAcid20["V"] = AminoAcid("Val",	"Valine",         117.14784,  4.2, 155,	140.0, "Nonpolar" , "Neutral" , "beta" );

	AminoAcid20["S"] = AminoAcid("Ser",	"Serine",         105.09344, -0.8, 115,  89.0, "Polar"    , "Neutral" , "turn" );
	AminoAcid20["W"] = AminoAcid("Trp",	"Tryptophan",     204.22844, -0.9, 255, 227.8, "Polar"    , "Neutral" , "beta" );
	AminoAcid20["C"] = AminoAcid("Cys",	"Cysteine", 	  121.15404,  2.5, 135, 108.5, "Polar"    , "Neutral" , "alpha");
	AminoAcid20["T"] = AminoAcid("Thr",	"Threonine",      119.12034, -0.7, 140, 116.1, "Polar"    , "Neutral" , "beta" );
	
	AminoAcid20["G"] = AminoAcid("Gly",	"Glycine",        75.06714 , -0.4,  75,  60.1, "Nonpolar" , "Neutral" , "turn" );
	AminoAcid20["R"] = AminoAcid("Arg",	"Arginine",       174.20274, -4.5, 225, 173.4, "Polar"    , "Positive", "all"  );
	AminoAcid20["A"] = AminoAcid("Ala",	"Alanine",        89.09404 ,  1.8, 115,  88.6, "Nonpolar" , "Neutral" , "alpha");
	AminoAcid20["P"] = AminoAcid("Pro",	"Proline",        115.13194, -1.6, 145, 112.7, "Nonpolar" , "Neutral" , "turn" );
	
	StringAminoAcid::iterator iter;
	for (iter=AminoAcid20.begin(); iter!=AminoAcid20.end(); iter++) {
            aminoacid.push_back(iter->second.ThreeLetter);
	}
        
        //Count of synonymous codons encoding the same amino acid
        int NumOfCodes = Codon64["AAA"].AAs.length();
        
        for (i=0; i<NumOfCodes; i++) {
            StringInt tmp;
            for (iter=AminoAcid20.begin(); iter!=AminoAcid20.end(); iter++) {
                tmp[iter->first] = 0;
            }
            CountOfSynCodons.push_back(tmp);
        }
        
        for (i=0; i<NumOfCodes; i++) {
            for (j=0; j<CODON; j++) {
                string codon = ID2Codon[j];
                string aa = toString(Codon64[codon].AAs[i]);
                CountOfSynCodons[i][aa]++;
            }
        }
}

/********************************************
* Function: addString
* Input Parameter: string, string, string
* Output: result = result + str + flag
* Return Value: void
* Note: flag = "\t" (default) or "\n"
*********************************************/
void Base::addString(string &result, string str, string flag) {
	result += str;
	result += flag;
}

string Base::concat(const char* fmt, ...) {
	string allstring="";	
	va_list  args; 
	va_start(args, fmt); 	
	while(fmt!=ENDCONCAT) {		
		allstring += fmt;
		fmt = va_arg(args, char*);		
	}	
	va_end(args);

	return allstring;
}

/**********************************************************************
* Function: getAminoAcid
* Input Parameter: codon
* Output: Calculate the amino acid according to codon.
* Return Value: char 
***********************************************************************/
char Base::getAminoAcid(string codon) {
	return Codon64[StringToUpper(codon)].AAs[genetic_code-1];
}

int Base::getNucleotideID(char base) {
	int i = 0;
	switch(base) {
		case 'A':
			i = 0;
			break;
		case 'T':
			i = 1;
			break;
		case 'G':
			i = 2;
			break;
		case 'C':
			i = 3;
			break;
		default:
			i = 0;
	}
	return i;
}

bool Base::toBool(int ch) {
	return (ch>0)?true:false;
}

double Base::toDouble(string ch) {
	return CONVERT<double>(ch);
}

int Base::toInteger(string ch) {
	return CONVERT<int>(ch);
}

string Base::toString(char ch) {
	return CONVERT<string>(ch);
}

string Base::toString(int ch) {
	return CONVERT<string>(ch);
}

string Base::toString(long ch) {
	return CONVERT<string>(ch);
}

string Base::toString(double ch) {
	return CONVERT<string>(ch);
}

string Base::toString(bool ch) {
	if (ch) return  "True";
	else return "False";
}

char Base::toChar(int i) {
	return CONVERT<char>(i);
}
/**********************************
* Function: getNumNonsense
* Input Parameter: int
* Output: get the number of nonsense codons
* Return Value: int
***********************************/
int Base::getNumNonsense() {

	int num=0;
	StringCodon::iterator pos;
	for(pos=Codon64.begin(); pos!=Codon64.end(); pos++) {
		if(Codon64[pos->first].AAs[genetic_code-1]=='*') num++;
	}

	return num;
}

/********************************************
* Function: stringtoUpper
* Input Parameter: string
* Output: upper string
* Return Value: string
*********************************************/
string Base::StringToUpper(string str) {
	int i;	
	for (i=0; i<str.length(); i++) str[i] = toupper(str[i]);
	return str;
}


vector<string> Base::splitString(string str, char delims) {
	vector<string> result;
	int pos;
	while (str.length() > 0) {		
		pos = str.find(delims);
		if (pos<0)  pos = str.length();
		string cellString = trim(str.substr(0, pos));
		if (pos<str.length()) str = str.substr(pos+1, str.length() - pos - 1);
		else str = "";

		if (cellString.length()==0) cellString = "";
		result.push_back(cellString);
	}
	return result;
}

string Base::trim(string str) {
	int i, flag;
	//left trim
	flag=0;
	for (i=0; i<str.length() && flag==0;) {
		int c = (char)str[i];
		if (iscntrl(c) || c<33 || c>127) i++;
		else flag=1;
	}
	str = str.substr(i, str.length()-i);

	//right trim
	flag=0;
	for (i=str.length()-1; i>=0 && flag==0;) {
		int c = (char)str[i];
		if (iscntrl(c) || c<33 || c>127) i--;
		else flag=1;
	}
	str = str.substr(0, i+1);

	return str;
}

string Base::filterString(string str) {
	int i=0;
	string tmp="";
	for (;i<str.length();i++) {		
        int c = (char)(str[i]);
		if (c>32 && c<128) tmp += str[i];
	}
	return tmp;
}

string Base::replaceAll(string str, char from, char to) {
	int i=0;
	string tmp="";
	while (i<str.length()) {
		if (str[i]!=from) tmp += str[i];
		else tmp += to;
		i++;
	}

	return tmp;
}

string Base::replaceAll(string str, char from) {
	int i=0;
	string tmp="";
	while (i<str.length()) {
		if (str[i]!=from) tmp += str[i];		
		i++;
	}

	return tmp;
}
/********************************************
* Function: getRandom
* Input Parameter: void
* Output: Generate a radnom integer
* Return Value: int
*********************************************/
int Base::getRandom() {	
	return rand();
}

double Base::getRand0to1() {
	return (double)rand()/RAND_MAX;
}

//Returns a random integer from lowbound to upperbound
int Base::getRandLow2High(int lowbound, int upperbound) {
	return (int)(getRand0to1()*(upperbound - lowbound) + lowbound);	
}

double Base::getRandNeg1toPos1() {
	return (2.0*(double)rand()-RAND_MAX)/RAND_MAX;
}

/********************************************
* Function: initArray
* Input Parameter: array of int/double, int, int/double(default=0)
* Output: Init the array x[0...n-1]=value
* Return Value: int
*********************************************/
int Base::initArray(double x[], int n, double value) {
	int i; 
	for(i=0; i<n; i++) x[i] = value;
	return 0;
}

int Base::initArray(int x[], int n, int value) {
	int i; 
	for(i=0; i<n; i++) x[i] = value;
	return 0;
}

int Base::initCodonMap(StringDouble &gCodon, double value) {
	int i;
	for (i=0; i<CODON; i++) gCodon[ID2Codon[i]] = value;
	return 1;
}

int Base::initAminoAcidMap(StringDouble &gAA, double value) {
	int i;
	for(i=0; i<aminoacid.size(); i++) gAA[aminoacid[i]] = value;
	return 1;
}



/********************************************
* Function: sumArray
* Input Parameter: double/int, int, int(default=0)
* Output: Sum of array x[]
* Return Value: double/int
*********************************************/
double Base::sumArray(double x[], int end, int begin) { 
	int i;
	double sum=0.;	
	for(i=begin; i<end; sum += x[i], i++);    
	return sum;
}

int Base::sumArray(int x[], int end, int begin) { 
	int i, sum=0;	
	for(i=begin; i<end; sum += x[i], i++);    
	return sum;
}

double Base::sumVector(vector<double> x) { 
	int i;
	double sum=0.0;	
	for(i=0; i<x.size(); sum += x[i], i++);    
	return sum;
}


double Base::sumMap(StringDouble x) {
	
	StringDouble::iterator i;
	double sum = 0.0;
	for (i=x.begin(); i!=x.end(); i++) sum += i->second;

	return sum; 
}

/********************************************
* Function: norm
* Input Parameter: array of double, int
* Output: Sqrt of the sum of the elements' square 
           sqrt(x0*x0 + x1*x1 + ...)
* Return Value: double
*********************************************/
double Base::norm(double x[], int n) {
	int i; 
	double t=0; 

	for(i=0; i<n; t += square(x[i]), i++);

	return sqrt(t);
}

/********************************************
* Function: scaleArray
* Input Parameter: double, array of double, int
* Output: Elements in array are mutipled by scale 
* Return Value: int
*********************************************/
int Base::scaleArray(double scale, double x[], int n) {	
	int i; 	
	for (i=0; i<n; i++) x[i] *= scale;

	return 1; 
}

vector<double> Base::scaleVector(vector<double> &x, double scale) {
	int i, n = x.size(); 	
	for (i=0; i<n; i++) x[i] *= scale;

	return x; 
}


/********************************************
* Function: copyArray
* Input Parameter: array, array, int
* Output: Copy array's values one by one: to[] = from[]
* Return Value: int
*********************************************/
int Base::copyArray(double from[], double to[], int n) {	
	int i; 
	for(i=0; i<n; i++) to[i] = from[i];
	
	return 1; 
}

int Base::copyVector(vector<double> from, vector<double> &to) {	
	int i; 
	for(i=0; i<from.size(); i++) to[i] = from[i];
	
	return 1; 
}

long Base::countChar(string str, char ch, int pos) {	
	long i, num; 
	if (pos==3) {
		for(i=num=0; i<str.length(); i++) if (str[i]==ch) num++;
	}
	else {
		for(i=num=0; i<str.length(); i++) if (i % CODONSIZE==pos && str[i]==ch) num++;
	}
	return num;
}

/********************************************
* Function: innerp
* Input Parameter: array, array, int
* Output: Sum of 'n' products multiplied by 
			two elements in x[], y[].
* Return Value: int
*********************************************/
double Base::innerp(double x[], double y[], int n) {
	
	int i; 
	double t=0;

	for(i=0; i<n; t += x[i]*y[i], i++); 

	return t; 
}

/********************************************
* Function: initIdentityMatrix
* Input Parameter: array of double, int
* Output: Set x[i,j]=0 when x!=j and 
			  x[i,j]=1 when x=j 
* Return Value: int
*********************************************/
int Base::initIdentityMatrix(double x[], int n) {
	
	int i,j;

	for (i=0; i<n; i++)  {
		for(j=0; j<n; x[i*n+j]=0, j++);
		x[i*n+i] = 1; 
	} 

	return 0; 
}


string Base::RGB(int r, int g, int b) {	
	char buffer[3];	

	sprintf(buffer, "%X", r);
	string rr = buffer;	
	if(rr.length()==1) rr = "0" + rr;

	sprintf(buffer, "%X", g);
	string gg = buffer;	
	if(gg.length()==1) gg = "0" + gg;

	sprintf(buffer, "%X", b);
	string bb = buffer;	
	if(bb.length()==1) bb = "0" + bb;

	return rr+gg+bb;	
}

/************************************************
* Function: writeFile
* Input Parameter: string, string
* Output: Write content into the given file.
* Return Value: True if succeed, otherwise false. 
*************************************************/
bool Base::writeFile(string output_filename, const char* result) {
	
	bool flag = true;
	try {
		//file name is ok
		if (output_filename!="" && output_filename.length() > 0) {
			ofstream os(output_filename.c_str());			
			if (!os.is_open()) throw 1;
			os<<result;
			os.close();							
		}
	}
	catch (...) {
		cout<<"Error in exporting results into file."<<endl;
		flag = false;
	}	

	return flag;
}

bool Base::removeCntrl(string name, vector<string> &str) {
	bool flag = true;
	int i;

	try {
		//Check whether (sequence length)/3==0
		for (i=0; i<str.size(); i++) {
			str[i] = StringToUpper(filterString(str[i]));
			if (str[0].length()!=str[i].length()) {
				cout<<endl<<"Error. The length of sequences "<<"'"<<name<<"' is not equal."<<endl;
				throw 1;
			}			
		}	
	}
	catch (...) {
		flag = false;
	}
	
	return flag;
}

bool Base::isNucleotide(string seq) {
	
	bool flag = true;
	long i;
	
	for (i=0; i<seq.length() && flag; i++) {
		char ch = seq[i];
		if (!(ch=='T' || ch=='U' || ch=='G' || ch=='A' || ch=='C')) {
			flag = false;
		}
	}
	return flag;

}

string Base::removeGapStopCodon(string str) {

	try {
		long i=0;		
		while (i < str.length()) {
			string codon = str.substr(i, 3);
			char aa = getAminoAcid(codon);
			bool flag = (isNucleotide(codon)) && (aa!='*') && (aa!='!') && (aa!=' ');

			if (flag==false) {
				str = str.replace(i, 3, "");				
			}
			else {
				i += 3;
			}
		}
	}
	catch (...) {
	}
	
	return str;
}


bool Base::checkValid(string name, vector<string> &str) {

	bool flag = true;
	long i;

	try {

		if (removeCntrl(name, str)) {

			string str1 = str[0];
			string str2 = str[1];
			
			//Delete gap and stop codon
			bool found;
			int j;
			for(i=0; i<str1.length(); i+=3) {			
				for(found=false, j=0; j<3 && !found; j++) {
					if (str1[j+i]=='-' || str2[j+i]=='-') {
						found = true;
					}
				}

				if ((getAminoAcid(str1.substr(i,3))=='*') || (getAminoAcid(str2.substr(i,3))=='*')) {
					found = true;
				}

				if (found) {
					str1 = str1.replace(i, 3, "");
					str2 = str2.replace(i, 3, "");
					i -= 3;
				}
			}

			str[0] = str1;
			str[1] = str2;

		}
		else {
			flag = true;
		}
	}
	catch (...) {
		flag = false;
	}
	
	return flag;
}

int Base::readAXT(string seqfile, vector<string> &seqname, vector<string> &seq) {

	int flag = 1;

	try	{

		ifstream is(seqfile.c_str());
		if (!is) {
			cout<<"Error in opening file..."<<endl;
			throw 1;
		}		
				
		string temp="", name="", str="";

		while (!is.eof() && getline(is, temp, '\n'))	{
			
			name = temp;			
			
			getline(is, temp, '\n');
			cout<<"reading first seq"<<endl;
			while (temp!="") {				
				str += temp;
				temp = "";
				getline(is, temp, '\n');
			}
			cout<<"reading all seq"<<endl;
			cout<<str.length()<<endl;
			//Check str's validility
			vector<string> strr;
			strr.push_back(str.substr(0, str.length()/2));
			strr.push_back(str.substr(str.length()/2, str.length()/2));

			if (checkValid(name, strr)) {
				seq.push_back(generalInput(strr));
				seqname.push_back(name);
			}			
			name = str = "";
		}
		is.close();
		is.clear();	

	}
	catch (...) {
		cout<<"Error in reading AXT."<<endl;
		flag = 0;
	}

	return flag;
}

int Base::readFasta(string seqfile, vector<string> &seqname, vector<string> &seq) {

	int flag = 1;

	try	{

		ifstream is(seqfile.c_str());
		if (!is) {
			cout<<"Error in opening file..."<<endl;
			throw 1;
		}		
				
		string temp="", name="";
		
		getline(is, temp, '\n');
		while ( (int)(temp.find('>')) > -1) {
			name = temp.substr(1, temp.length()-1); 	
			string str="";
			getline(is, temp, '\n');
			while (temp!="" && (int)(temp.find('>'))<0) {
				str += temp;
				temp = "";
				getline(is, temp, '\n');				
			}

			//name = Trim(filterString(name));
			name = trim(name);
			str = trim(filterString(str));

			seqname.push_back(name);
			seq.push_back(str);
		}		

		is.close();
		is.clear();
	}
	catch (...) {		
		flag = 0;
		cout<<"Error in reading input fasta file."<<endl;
	}

	return flag;
}


string Base::generalInput(vector<string> seq) {

	int i, j;
	string output = "";
	for (i=0; i<seq[0].length(); i++) {		
		int issame = 1;
		for (j=1; j<seq.size() && issame==1; j++) {
			if (seq[0][i]!=seq[j][i]) issame=0;
		}
		if (issame==1) output += "0";
		else output += "1";
	}

	return output;
}

string Base::formatDateTime(time_t t) {
	string time_string = "";
	int h=t/3600, m=(t%3600)/60, s=t-(t/60)*60;
	if(h)  time_string += toString(h) +":";
	time_string += toString(m) + ":" + toString(s);
	return time_string;
}

/*

int matby (double a[], double b[], double c[], int n,int m,int k)
// a[n*m], b[m*k], c[n*k]  ......  c = a*b

{
   int i,j,i1;
   double t;
   FOR (i,n)  FOR(j,k) {
      for (i1=0,t=0; i1<m; i1++) t+=a[i*m+i1]*b[i1*k+j];
      c[i*k+j] = t;
   }
   return (0);
}





void PMatrixTaylor(double P[], double n, double t) {

// Get approximate PMat using polynomial approximation
//   P(t) = I + Qt + (Qt)^2/2 + (Qt)^3/3!

   int nterms=1000, i,j,k, c[2],ndiff,pos=0,from[3],to[3];
   double *Q=space, *Q1=Q+n*n, *Q2=Q1+n*n, mr, div;

   FOR (i,n*n) Q[i]=0;
   for (i=0; i<n; i++) FOR (j,i) {
      from[0]=i/16; from[1]=(i/4)%4; from[2]=i%4;
      to[0]=j/16;   to[1]=(j/4)%4;   to[2]=j%4;
      c[0]=GenetCode[com.icode][i];
      c[1]=GenetCode[com.icode][j];
      if (c[0]==-1 || c[1]==-1)  continue;
      for (k=0,ndiff=0; k<3; k++)  if (from[k]!=to[k]) { ndiff++; pos=k; }
      if (ndiff!=1)  continue;
      Q[i*n+j]=1;
      if ((from[pos]+to[pos]-1)*(from[pos]+to[pos]-5)==0)  Q[i*n+j]*=kappa;
      if(c[0]!=c[1])  Q[i*n+j]*=omega;
      Q[j*n+i]=Q[i*n+j];
   }
   FOR(i,n) FOR(j,n) Q[i*n+j]*=pi[j];
   for (i=0,mr=0;i<n;i++) { 
      Q[i*n+i]=-sum(Q+i*n,n); mr-=pi[i]*Q[i*n+i]; 
   }
   FOR(i,n*n) Q[i]*=t/mr;

   xtoy(Q,P,n*n);  FOR(i,n) P[i*n+i]++;   // I + Qt 
   xtoy(Q,Q1,n*n);
   for (i=2,div=2;i<nterms;i++,div*=i) {  // k is divisor 
      matby(Q, Q1, Q2, n, n, n);
      for(j=0,mr=0;j<n*n;j++) { P[j]+=Q2[j]/div; mr+=fabs(Q2[j]); }
      mr/=div;
      // if(debug) printf("Pmat term %d: norm=%.6e\n", i, mr); 
      if (mr<e) break;
      xtoy(Q2,Q1,n*n);
   }

   FOR(i,n*n) if(P[i]<0) P[i]=0;

}

*/

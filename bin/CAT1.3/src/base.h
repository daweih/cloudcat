/******************************************************************
* Copyright (c) 2011
* All rights reserved.
 
* Filename: base.h
* Abstract: Declaration of base class

* Version: 1.1
* Author: Zhang Zhang
* Date: Mar. 12, 2011
 
* Version: 1.0
* Author: Zhang Zhang
* Date: Dec. 18, 2010

* Note: 


******************************************************************/
#pragma warning(disable:4786)		//Disable warnings when using vector

#if !defined(BASE_H)
#define  BASE_H

#define CODONSIZE 3				//Codon Size = 3
#define DNASIZE 4				//A C G T
#define XSIZE DNASIZE*DNASIZE   //Size of one group AXX (X=A,C,G,T) 
#define CODON 64				//Codon Count
#define NULL 0					//Zero
#define NA -1					//Not Available
#define SMALLVALUE 1e-30		//Value near to zero

#define gammap(x,alpha) (alpha*(1-pow(x,-1/alpha)))
#define square(a) ((a)*(a))

#define min2(a,b) ((a)<(b)?(a):(b))
#define max2(a,b) ((a)>(b)?(a):(b))
#define SIGN(a,b) ((b) >= 0.0 ? fabs(a) : -fabs(a))
#define Pi 3.1415926535897932384626433832795

#define ENDCONCAT "EndOfStringConcat"	//for funcation concat
#define DECIMAL_POINT '.'
#define EMAIL "zhang.zhang@kaust.edu.sa or zhangzhang.cn@gmail.com"
#define UNEXPECTED_ERROR "Unexpected error. Please contact Zhang Zhang at " EMAIL "."

/* Stanard lib of C++ */
#include<iostream>
#include<sstream>
#include<fstream>
#include<vector>
#include<cstdlib>
#include<limits>
#include<string>
#include<cctype>
#include<algorithm>
#include<map>
#include<iomanip>

#include<stdlib.h>
#include<stdio.h>
#include<stdarg.h>
#include<math.h>
#include<time.h>
#include<ctype.h>
//#include<conio.h>

using namespace std;


/* Convert one type to any other type */
template<class out_type,class in_value>
	out_type CONVERT(const in_value & t) {
		stringstream stream;
		//Put the value 't' into the stream
		stream<<t;			
		out_type result;
		//Put the stream into the 'result'
		stream>>result;

		return result;
	}

class Codon {
	
public:
	Codon() {}
	
	Codon(string RorD, string q, string a) {
		RobustnessORDiversity = RorD;
		Quarter = q;
		AAs = a;
	}

	/* Amino Acids in 23 genetic code tables for a give codon */
	string AAs;
	/* R or D*/
	string RobustnessORDiversity;
	/* Quarter Location: 1:low gc, 2:gc p1, 3:gc p2, 4:high gc */
	string Quarter;
};

class AminoAcid {

public:
	AminoAcid(){}

	AminoAcid(string letter3, string letterfull, double mw, double hvalue, double residuevolume, double surfacearea, string polar, string charge, string structure) {
		this->ThreeLetter = letter3;
		this->FullLetter = letterfull;
		this->MolecularWeight = mw;
		this->HydrophobicityValue = hvalue;
		this->ResidueVolume = residuevolume;
		this->SurfaceArea = surfacearea;
		this->Polar = polar;
		this->Charge = charge;
		this->Structure = structure;
	}

	/* Three letter and full letter for an amino acid*/
	string ThreeLetter, FullLetter;
	/* Molecular Weight */
	double MolecularWeight;
	/* KYTE-DOOLITTLE Hydrophobicity Value */
	double HydrophobicityValue;
	/* Redidue Volume */
	double ResidueVolume;
	/* Surface Area */
	double SurfaceArea;
	/* Polar */
	string Polar;
	/* Charge */
	string Charge;
	/* Secondary Structure */
	string Structure;
};

typedef vector<double> DoubleVector;
typedef map<string, Codon> StringCodon;
typedef map<string, AminoAcid> StringAminoAcid;
typedef map<int, string> IntString;
typedef map<string, int> StringInt;
typedef map<string, double> StringDouble;
typedef map<string, string> StringString;

class Base {

public:
	/* Set current time as random seed */
	Base();	

	/* Write the content into file */
	bool writeFile(string output_filename, const char* result);

	/* Parse results */
	string parseOutput();	
	/* Format string for outputing into file */
	void addString(string &result, string str, string flag="\t");
	string concat(const char* fmt, ...);

	/* Generate a radnom integer */
	int getRandom();
	/* Generate a radnom double from 0 to 1 */
	double getRand0to1();
	/* Generate a radnom double from -1 to 1 */
	double getRandNeg1toPos1();
	/* Generate a radnom integar from lowerbound to upperbound */
	int getRandLow2High(int lowbound, int upperbound);	

	/* Remove gap and stop codon from input sequence*/
	string removeGapStopCodon(string str);

	long countChar(string str, char ch, int pos=3);
	
	/* Convert a string to uppercase */
	string StringToUpper(string str);

	vector<string> splitString(string str, char delims='\t');

	string trim(string str);
	string filterString(string str);
	
	string replaceAll(string str, char from, char to);
	string replaceAll(string str, char from);

	//Convert to boolean
	bool toBool(int ch);
	//Convert to int
	int toInteger(string ch);
	//Convert to double
	double toDouble(string ch);	
	//Convert to string
	string toString(char ch);
	string toString(int ch);
	string toString(long ch);
	string toString(double ch);
	string toString(bool boolflag);
	//Convert to char
	char toChar(int);
	
	/* Calculate the amino acid of codon by codon */
	char getAminoAcid(string codon);	
	/* Get the number of stop codon in a given genetic code table */
	int getNumNonsense();
	
	/* Get nucleotide id: A=0, T=1, G=2, C=3 */
	int getNucleotideID(char nuc);

	/* Return the codon's id from codon table */
	int getID(string codon);
	/* Return a codon according to the id */
	string getCodon(int IDcodon);

	/* Sum array's elements */
	double sumArray(double x[], int end, int begin=0);
	int sumArray(int x[], int end, int begin=0);
	double sumVector(vector<double> x);
	double sumMap(StringDouble x);

	/* Init value to array */
	int initArray(double x[], int n, double value=0.0);
	int initArray(int x[], int n, int value=0);
	int initCodonMap(StringDouble &gCodon, double value=0.0);
	int initAminoAcidMap(StringDouble &gAA, double value=0.0);

	/* Elements in array are mutipled by scale */
	int scaleArray(double scale, double x[], int n);
	vector<double> scaleVector(vector<double> &x, double scale);
	
	/* Sqrt of the sum of the elements' square */
	double norm(double x[], int n);
	/* Copy array's values one by one: to[] = from[] */
	int copyArray(double from[], double to[], int n);
	int copyVector(vector<double> from, vector<double> &to);	

	/* Sum of 'n' products multiplied by two elements x[], y[] */
	double innerp(double x[], double y[], int n);
	/* Set x[i,j]=0 when x!=j and x[i,j]=1 when x=j */
	int initIdentityMatrix(double x[], int n);

	bool removeCntrl(string name, vector<string> &str);
	bool checkValid(string name, vector<string> &str);
	bool isNucleotide(string seq);

	//Read AXT sequences
	int readAXT(string seqfile, vector<string> &seqname, vector<string> &seq);
	//Read Fasta sequences
	int readFasta(string seqfile, vector<string> &seqname, vector<string> &seq);
	string generalInput(vector<string> seq);
	string RGB(int r, int g, int b);

	//Format time as hh:mm:ss
	string formatDateTime(time_t t);

public:
	//4 Nucleotides
	vector<string> nucleotides;
	//12 Codon Nucleotides
	vector<string> codon_nucleotides;
	
	//Contents: GC, purine
	vector<string> contents;
	//Codon Contents: GC[i], purine[i], i=1,2,3
	vector<string> codon_contents;
	//Amino acids' threeletters
	vector<string> aminoacid;

	//64 Codons
	StringCodon Codon64;
        //Count of synonymous codons encoding the same amino acid
        vector<StringInt> CountOfSynCodons;
	//20 Amino Acids
	StringAminoAcid AminoAcid20; 
	
	//Genetic code names
	vector<string> genetic_code_name;
	//Genetic codes
	int genetic_code;

protected:	
	//ID(1~64) to Codon
	IntString ID2Codon;
	//Codon to ID
	StringInt Codon2ID;

private:
	unsigned long Seed;
	
};

#endif



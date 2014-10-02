PRGS = CAT 
CC = g++
CFLAGS = -O3

all:	$(PRGS) 

CAT: main_CAT.cpp CAT.cpp base.cpp
	$(CC) $(CFLAGS) -o  $@ main_CAT.cpp CAT.cpp base.cpp  -w
install: CAT
	install CAT ~/bin/

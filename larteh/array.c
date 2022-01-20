// array.c
// This will only have effect on Windows with MSVC
#ifdef _MSC_VER
   #define _CRT_SECURE_NO_WARNINGS 1
    #define restrict __restrict
#endif

#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <stdint.h>
#include <errno.h>

/*
14 POSIX getline replacement for non-POSIX systems (like Windows)
15 Differences:
16     - the function returns int64_t instead of ssize_t
17     - does not accept NUL characters in the input file
18 Warnings:
19     - the function sets EINVAL, ENOMEM, EOVERFLOW in case of errors. The above are not defined by ISO C17,
20     but are supported by other C compilers like MSVC
21 */
int64_t my_getline(char **restrict line, size_t *restrict len, FILE *restrict fp) {
    // Check if either line, len or fp are NULL pointers
    if(line == NULL || len == NULL || fp == NULL) {
        errno = EINVAL;
        return -1;
    }
    
    // Use a chunk array of 128 bytes as parameter for fgets
    char chunk[128];

    // Allocate a block of memory for *line if it is NULL or smaller than the chunk array
    if(*line == NULL || *len < sizeof(chunk)) {
        *len = sizeof(chunk);
        if((*line = malloc(*len)) == NULL) {
            errno = ENOMEM;
            return -1;
        }
    }

    // "Empty" the string
    (*line)[0] = '\0';

    while(fgets(chunk, sizeof(chunk), fp) != NULL) {
        // Resize the line buffer if necessary
        size_t len_used = strlen(*line);
        size_t chunk_used = strlen(chunk);

        if(*len - len_used < chunk_used) {
            // Check for overflow
            if(*len > SIZE_MAX / 2) {
                errno = EOVERFLOW;
                return -1;
            } else {
                *len *= 2;
            }
            
            if((*line = realloc(*line, *len)) == NULL) {
                errno = ENOMEM;
                return -1;
            }
        }

        // Copy the chunk to the end of the line buffer
        memcpy(*line + len_used, chunk, chunk_used);
        len_used += chunk_used;
        (*line)[len_used] = '\0';

        // Check if *line contains '\n', if yes, return the *line length
        if((*line)[len_used - 1] == '\n') {
            return len_used;
        }
    }

    return -1;
}


/*
 Razbienie 1
*/
int razb1(int inArr[], int inArrSize, int a, int b) {



  if (a>=inArrSize || b>=inArrSize || a>b) {
	  perror("Nevernye Parametry Razbienija!");
	  return -1;
  }

  int sum=0;
  for (int i = a; i <= b; i++) {
    sum = sum + inArr[i];
  }
  return sum;
}


/*
 Max Razbienie 1 for the array
*/
int *maxrazb1(int inArr[], int inArrSize) {

	int rmax=-2000000; // minimum sum of 2 elements
	int r1;
	char buffer[16] = {0};
	static int out[3];
	
    for (int i = 0; i < inArrSize; i++) {
	  for (int j = i; j < inArrSize; j++) {
        r1=razb1(inArr, inArrSize, i, j);
		if (r1>rmax) {rmax=r1;out[0]=r1;out[1]=i;out[2]=j;}
      }
      
    }
	
	return out;
}



/*
 Razbienie 2
*/
int hasValue(int inArr[], int inArrSize, int val) {
    for (int i = 0; i < inArrSize; i++) {
		if (inArr[i]==val) return 1;
	}
	return 0;
}

int razb2(int inArr[], int inArrSize) {

	char buffer[16] = {0};
	int p1Size, p2Size;
	int p1[inArrSize];
	int p2[inArrSize];

	int resultFound;
	int resultsCount=0;
    for (int c = 0; c < inArrSize; c++) {
	  for (int d = 0; d < inArrSize; d++) {
		p1Size=c+1;
		p2Size=inArrSize-d;
		for (int i = 0; i < p1Size; i++) {
			p1[i]=inArr[i];
		}
		for (int i = 0; i < p2Size; i++) {
			p2[i]=inArr[d+i];
		}
		
		resultFound=1;
		for (int i = 0; i < p1Size; i++) {
			if (!hasValue(p2, p2Size, p1[i])) {resultFound=0;break;}
		}
		if (!resultFound) continue;
		for (int i = 0; i < p2Size; i++) {
			if (!hasValue(p1, p1Size, p2[i])) {resultFound=0;break;}
		}		
		if (!resultFound) continue;
		
		sprintf(buffer, "(R2) - (%d,%d)\n", c, d);
		fputs(buffer, stdout);
		resultsCount++;
		//free(p1);
		//free(p2);
      }
      
    }
	
	sprintf(buffer, "Num of (R2) - %d\n", resultsCount);
	fputs(buffer, stdout);
	return resultsCount;
}




int main(void) {
	
	int out1, out2, out3;
	
    FILE *fp = fopen("in.txt", "r");
    if(fp == NULL) {
       perror("Unable to open file!");
        exit(1);
    }

	char buffer[16] = {0};
    char * pch;
	int c=0;
  
    // Read lines from a text file using our own a portable getline implementation
    char *line = NULL;
    size_t len = 0;
	int readline=0;

	int inArrSize=0;


	readline=my_getline(&line, &len, fp);
	if (readline==-1) {perror("Error in file data!"); exit(1);}
	inArrSize=atoi(line);
	sprintf(buffer, "%d\n", inArrSize);
    fputs(buffer, stdout);
	
	int inArr[inArrSize];	
	readline=my_getline(&line, &len, fp);
    //fputs(line, stdout);
    pch = strtok (line," ");
    while (pch != NULL)
    {
	   inArr[c]=atoi(pch);
       //printf ("%s\n",pch);
	   sprintf(buffer, "%d\n", inArr[c]);
       fputs(buffer, stdout);
       pch = strtok (NULL, " ");
	   c++;
    }
    fclose(fp);
    free(line);
	
	// END of Read lines from a text file using our own a portable getline implementation

	// Razbienie 1
	int *maxr1;
	maxr1=maxrazb1(inArr, inArrSize);
	sprintf(buffer, "(R1) max - (%d,%d)=%d\n", *(maxr1+1), *(maxr1+2), *maxr1);
    fputs(buffer, stdout);
	out1=*maxr1;


	// Razbienie 1 s perestanovkami
	int inArr2[inArrSize];
	int t;
	int mr1, mr1st, mr1ed;
	int mmr1=-2000000, mmr1st=0, mmr1ed=0;
    for (int i = 0; i < inArrSize; i++) {
	  for (int j = i; j < inArrSize; j++) {
		for (int i2 = 0; i2 < inArrSize; i2++) {
	      inArr2[i2]=inArr[i2];
		}
        t=inArr[i];
		inArr[i]=inArr[j];
		inArr[j]=t;
		maxr1=maxrazb1(inArr2, inArrSize);
		mr1=*maxr1; mr1st=*(maxr1+1); mr1ed=*(maxr1+2);
		if (mr1>mmr1) {mmr1=mr1; mmr1st=mr1st; mmr1ed=mr1ed;}
      }
      
    }
	
	sprintf(buffer, "(R1) max 2 - (%d,%d)=%d\n", mmr1st, mmr1ed, mmr1);
    fputs(buffer, stdout);
	out2=mmr1;

	// Razbienie 2
	out3=razb2(inArr2, inArrSize);
/*
    while(1) {
		readline=my_getline(&line, &len, fp);
        fputs(line, stdout);
        fputs("|*\n", stdout);
        printf("line length: %zd\n", strlen(line));
		if (readline==-1) break;
    }
*/


    // Write lines to a text file
    FILE *fp2 = fopen("out.txt", "w");
	fprintf(fp2, "%d\n%d\n%d\n", out1, out2, out3); // write to file

}
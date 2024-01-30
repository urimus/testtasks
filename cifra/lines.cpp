//g++ lines.cpp -o lines

#include <iostream>
#include <fstream>
#include <math.h>
#include <stdio.h>
#include <stdlib.h>
using namespace std;

/*
Function what returns distance between 2 points
*/
int distance(int x1, int y1, int x2, int y2) {
    return (int)std::sqrt(std::pow((x2 - x1), 2) + std::pow((y2 - y1), 2));
}

/*
Function what returns intersection point between line1 and line2
*/
int* intersect(int line1[], int line2[]) {
	static int out[2];
	
	int x1, y1, x2, y2, x3, y3, x4, y4;
	float px, py;

	x1=line1[0];
	y1=line1[1];
	x2=line1[2];
	y2=line1[3];
	x3=line2[0];
	y3=line2[1];
	x4=line2[2];
	y4=line2[3];
	
	// https://ru.wikipedia.org/wiki/Пересечение_прямых
	px=(float)((x1*y2 - y1*x2)*(x3 - x4) - (x1-x2)*(x3*y4-y3*x4)) / (float)((x1-x2)*(y3-y4) - (y1-y2)*(x3-x4));
	py=(float)((x1*y2 - y1*x2)*(y3 - y4) - (y1-y2)*(x3*y4-y3*x4)) / (float)((x1-x2)*(y3-y4) - (y1-y2)*(x3-x4));

	out[0]=round(px); out[1]=round(py);
	
	return out;
}
 
 
int main()
{

	
	std::fstream myfile("check-lines.txt", std::ios_base::in);

	int M, N, c=0, px, py;
	float a;
	myfile >> M;
	myfile >> N;
	
	int lines[M][4]; // x1, y1, x2, y2
	
	// Working Area [-1000 ... 1000]
	// Creating 2D array of pointers using Dynamic Memory
	// allocation through malloc() function
	int** area = (int**)malloc(2003 * sizeof(int*));
	for (int i = 0; i < 2003; i++)
		area[i] = (int*)malloc(2003 * sizeof(int));
	for (int i = 0; i < 2003; i++) {
		for (int j = 0; j < 2003; j++) {
			area[i][j] = 0;
		}
	}
	
//	int* area = (int*)malloc((1001 * 1001) * sizeof(int));
	
	
	printf("M=%d ", M);
	printf("N=%d ", N);

	
	while (myfile >> a)
	{
		lines[c][0]=(int)a; // x1
//        printf("x1=%d ", lines[c][0]);
		
		myfile >> a;
		lines[c][1]=(int)a; // y1
//        printf("y1=%d ", lines[c][1]);
		
		myfile >> a;
		lines[c][2]=(int)a; // x2
//        printf("x2=%d ", lines[c][2]);
		
		myfile >> a;
		lines[c][3]=(int)a; // y2
//        printf("y2=%d ", lines[c][3]);
		c++;
	}
	printf("\n");
	myfile.close();

	int* inters; //pointer to hold address
	
	// storing intersections, every intersection in area array, value in array - number of intersections in every point
	for (int i = 0; i < M; i++) {
		for (int j = i; j < M; j++) {
			inters=intersect(lines[i], lines[j]);
			px=inters[0]; py=inters[1];
			px=px+1001; py=py+1001;
			if (px<1 || px>2001 || py<1 || py>2001) continue; // outside working area
			area[px][py]=area[px][py]+1;
			// taking into account calculation error
			area[px][py+1]=area[px][py+1]+1;
			area[px][py-1]=area[px][py-1]+1;
			area[px+1][py+1]=area[px+1][py+1]+1;
			area[px+1][py-1]=area[px+1][py-1]+1;
			area[px-1][py+1]=area[px-1][py+1]+1;
			area[px-1][py-1]=area[px-1][py-1]+1;
			area[px+1][py]=area[px+1][py]+1;
			area[px-1][py]=area[px-1][py]+1;

		}
	}

	// Intersections selection algorithm:
	// 1. Selecting point in area with maximum intersections
	// 2. Setting it to 0 and all points around maximum point in distance of 99, according to task contiting distance between points >=100
	// 3. Selecting next pont
	// 4. N points in total
	
	int maxInt, maxX, maxY;
	ofstream MyFile("result.txt");

	printf("Points: \n");
	for (int c = 0; c < N; c++) {
	
		maxInt=0, maxX=0, maxY=0;
		for (int i = 0; i < 2001; i++) {
			for (int j = 0; j < 2001; j++) {
				if (area[i][j]>maxInt) {
					maxInt=area[i][j];
					maxX=i;
					maxY=j;
				}
			}
		}

		for (int i = maxX-100; i < maxX+100; i++) {
			for (int j = maxY-100; j < maxY+100; j++) {
				if (i<0 || i>2000 || j<0 || j>2000) continue; // outside working area
				if (distance(i,j,maxX, maxY)<100) {
					area[i][j]=0;
				}
			}
		}
		printf("(%d, %d)=%d ", maxX-1001, maxY-1001, maxInt);
		MyFile << maxX-1001 << ".000000 ";
		MyFile << maxY-1001 << ".000000\n";
	}


	MyFile.close();
	
	

	return 0;
}


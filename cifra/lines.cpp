//g++ lines.cpp -o lines

#include <iostream>
#include <fstream>
using namespace std;
 
int round(float var)
{
    // 37.66666 * 100 =3766.66
    // 3766.66 + .5 =3767.16    for rounding off value
    // then type cast to int so value is 3767
    // then divided by 100 so the value converted into 37.67
	if (var>=0) {
		return (int)(var+.5);
	} else {
		return (int)(var-.5);
	}
}

int* intersect(int line1[], int line2[]) {
	static int out[2];
	
	int x1, y1, x2, y2, x3, y3, x4, y4;
	float px, py;

	x1=line1[0];
	y1=line1[1];
	x2=line1[2];
	y2=line1[3];
	printf("x1=%d ", x1);
	printf("y1=%d ", y1);
	printf("x2=%d ", x2);
	printf("y2=%d ", y2);
	
	x3=line2[0];
	y3=line2[1];
	x4=line2[2];
	y4=line2[3];
	
	// https://ru.wikipedia.org/wiki/Пересечение_прямых
	px=(float)((x1*y2 - y1*x2)*(x3 - x4) - (x1-x2)*(x3*y4-y3*x4)) / (float)((x1-x2)*(y3-y4) - (y1-y2)*(x3-x4));
	py=(float)((x1*y2 - y1*x2)*(y3 - y4) - (y1-y2)*(x3*y4-y3*x4)) / (float)((x1-x2)*(y3-y4) - (y1-y2)*(x3-x4));


	out[0]=round(px); out[1]=round(py);
	
	printf("px=%d ", out[0]);
	printf("py=%d ", out[1]);
	return out;
}
 
 
int main()
{
	std::cout << "Hello METANIT.COM!";

	
    std::fstream myfile("1-lines.txt", std::ios_base::in);

	int M, N, c=0;
	float a;
	myfile >> M;
	myfile >> N;
	
	int lines[M][4]; // x1, y1, x2, y2
	printf("M=%d ", M);
	printf("N=%d ", N);

	
    while (myfile >> a)
    {
		lines[c][0]=(int)a; // x1
        printf("x1=%d ", lines[c][0]);
		
		myfile >> a;
		lines[c][1]=(int)a; // y1
        printf("y1=%d ", lines[c][1]);
		
		myfile >> a;
		lines[c][2]=(int)a; // x2
        printf("x2=%d ", lines[c][2]);
		
		myfile >> a;
		lines[c][3]=(int)a; // y2
        printf("y2=%d ", lines[c][3]);
		c++;
    }

	int* inters; //pointer to hold address
	
	inters=intersect(lines[0], lines[1]);
	inters=intersect(lines[0], lines[2]);
	inters=intersect(lines[0], lines[3]);
	
	
//	printf("px=%f ", inters[0]);
//	printf("py=%f ", inters[1]);
//    getchar();


	return 0;
}

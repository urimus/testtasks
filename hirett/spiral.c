/*
 Программа построения спирали из центра в матрице размером s на v.
 Алгоритм - 
 1. Матрица заполняется значениями y
 2. Вычисляетя центр, устанавливается туда курсор cx, cy, записывается 0
 3. Устанавливается направление прорисовки спирали, dir, 1 - left, 2 - down, 3 - right, 4 - up, сначала 1
 4. Рисуется 1 шаг, устанавливая значение x в матрицу
 5. Если значение в матрице для dir+1 (если dir+1=5 то dir=1) = y (пусто) то dir увеличивается +1. Если нет (центр (0) или уже нарисовано (x)) то dir остаётся прежним. 
    Если за краем матрицы то dir увеличивается +1 как будто пусто но ничего не рисуется.
 6. Шаг 4 вповторяется s*v/2 раз
 
Программа компилируется компилятором gcc.
Вывод программы:
cx -    4, xy -    3
   6   6   6   6   6   6   6   6   4
   4   4   4   4   4   4   4   6   4
   4   6   6   6   6   6   4   6   4
   4   6   4   4   0   6   4   6   4
   4   6   4   6   6   6   4   6   4
   4   6   4   4   4   4   4   6   4
   4   6   6   6   6   6   6   6   4
   
Требовалось:
   
6 6 6 6 6 6 6 6 4
4 4 4 4 4 4 4 6 4
4 6 6 6 6 6 4 6 4
4 6 4 4 x 6 4 6 4
4 6 4 6 6 6 4 6 4
4 6 4 4 4 4 4 6 4
4 6 6 6 6 6 6 6 4 

Точно.
Спасибо.

*/



#include <stdio.h>


/*
 Increase dir
*/
int incdir (int dir) {

	// direction, 1 - left, 2 - down, 3 - right, 4 - up
	dir++;
	if (dir==5) dir=1;
	return dir;
	
}


/*
 Is coord in matrix
*/
int inmat (int y, int x, int v, int s) {

	// direction, 1 - left, 2 - down, 3 - right, 4 - up
	if (x<0 || x>=s) return 0;
	if (y<0 || y>=v) return 0;
	return 1;

}


/*
 Value in some direction
*/
int dirval(int cx, int cy, int v, int s, int dir, int mat[v][s]) {

	// direction, 1 - left, 2 - down, 3 - right, 4 - up
	
	if (dir==1) {
		if (!inmat(cy, cx-2, v, s)) return -1;
		return mat[cy][cx-2];
		
	}
	if (dir==2) {
		if (!inmat(cy+2, cx, v, s)) return -1;
		return mat[cy+2][cx];
	}
	if (dir==3) {
		if (!inmat(cy, cx+2, v, s)) return -1;
		return mat[cy][cx+2];
	}
	if (dir==4) {
		if (!inmat(cy-2, cx, v, s)) return -1;
		return mat[cy-2][cx];
	}

}


int main() {
  int v = 7, s = 9, x = 4, y = 6, mat[7][9], i, j, l, k;
  
  // cursor
  int cx, cy;
  cx=((int)s/2);
  cy=((int)v/2);
  printf("cx - %4d, xy - %4d\n", cx, cy);
  
  
  
  int dir=1; // direction, 1 - left, 2 - down, 3 - right, 4 - up
  
  int dv;
  
  for (i = 0; i < v; i++)
    for (j = 0; j < s; j++)
      mat[i][j] = y;
  
  mat[cy][cx]=0; // start
  // spiral goes here
  for (i = 0; i < s*v/2; i++) {


	if (dir==1) {
		if (inmat(cy, cx-1, v, s)) mat[cy][cx-1]=x;
		if (inmat(cy, cx-2, v, s)) mat[cy][cx-2]=x;
		cx=cx-2;
	}
	if (dir==2) {
		if (inmat(cy+1, cx, v, s)) mat[cy+1][cx]=x;
		if (inmat(cy+2, cx, v, s)) mat[cy+2][cx]=x;
		cy=cy+2;
	}
	if (dir==3) {
		if (inmat(cy, cx+1, v, s)) mat[cy][cx+1]=x;
		if (inmat(cy, cx+2, v, s)) mat[cy][cx+2]=x;
		cx=cx+2;
	}
	if (dir==4) {
		if (inmat(cy-1, cx, v, s)) mat[cy-1][cx]=x;
		if (inmat(cy-2, cx, v, s)) mat[cy-2][cx]=x;
		cy=cy-2;
	}

	dv=dirval(cx, cy, v, s, incdir(dir), mat);
	if (dv==y || dv==-1) dir=incdir(dir);

  }

  for (i = 0; i < v; i++) {
    for (j = 0; j < s; j++) 
      printf("%4d", mat[i][j]);
    printf("\n");
  }
  return 0;
}
//// 10. Create Full Pyramid Of *? ////
#include<stdio.h>
int main ()

{
    int i,j,k,rows;
    printf("How Many Rows Of Pyramid You Wanna Build Stars:");
    scanf("%d",&rows);
    int space = rows-1;

    for(i=1; i<rows*2; i=i+2)
       {
           for(j=space; j>0; j=j-1)
              {
                 printf(" ");
              }
                 space = space-1;

           for(k=0; k<i; k=k+1)
              {
                 printf("*");
              }
                 printf("\n");
       }
}

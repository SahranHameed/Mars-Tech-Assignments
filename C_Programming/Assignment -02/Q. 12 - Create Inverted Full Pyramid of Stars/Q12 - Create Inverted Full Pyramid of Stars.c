//// 12. Creat inverted Full Pyramid Of * ? ////
#include<stdio.h>
int main()
{
    int i, j, k, rows;
    printf("How Many Rows Of Pyramid You Wanna Build Stars: ");
    scanf("%d", &rows);
    int space = 0;

    for(i=rows*2-1; i>0; i=i-2)
    {
        for(j=0; j<space; j++)
        {
            printf(" ");
        }
        space = space+1;

        for(k=0; k<i; k++)
        {
            printf("*");
        }
        printf("\n");
    }
    return 0;
}

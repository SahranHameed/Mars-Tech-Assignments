//// 11. Creat Full Pyramid Of Alphabets ? ////
#include<stdio.h>
int main()
{
    int i, j, k, rows;
    printf("How Many Rows Of Pyramid You Wanna Build Alphabets: ");
    scanf("%d", &rows);
    int space = rows - 1;

    for (i = 1; i <= rows; i++)
    {
        // Print leading spaces
        for (j = 1; j <= space; j++)
        {
            printf(" ");
        }
        space--;
        // Print alphabets in increasing order
        for (k=1; k<=(i*2-1); k++)
        {
            printf("%c", 'A' + k - 1);
        }
        printf("\n");
    }
    return 0;
}



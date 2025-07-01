//// 13. Creat Inverted Full Pyramid Of Numbers ? ////
#include<stdio.h>
int main()
{
    int i, j, k, rows;
    printf("How Many Rows Of Pyramid You Wanna Build Numbers: ");
    scanf("%d", &rows);
    int space = 0;

    for (i = rows; i > 0; i--)
    {
        // Print leading spaces
        for (j = 0; j < space; j++)
        {
            printf(" ");
        }
        space++;

        // Print numbers
        for (k = 1; k <= (i * 2 - 1); k++)
        {
            printf("%d", k);
        }
        printf("\n");
    }
    return 0;
}


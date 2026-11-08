// Q 01 - Multiplication Table
#include <stdio.h>

void multiplication_table(int number)
{
    int i;
    printf("\nMultiplication Table for %d:\n", number);
    for (i = 1; i <= 15; i++)
    {
        printf("%d x %d = %d\n", i, number, number * i);
    }
}

int main()
{
    int number;
    printf("Enter a number greater than 1: ");
    scanf("%d", &number);

    if (number > 1)
        multiplication_table(number);
    else
        printf("Invalid! Number must be greater than 1.\n");

    return 0;
}

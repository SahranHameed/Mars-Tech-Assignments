// Q 02 - Decompose a number into digits
#include <stdio.h>

void decompose(int num)
{
    int place = 1, digit;

    printf("\nResult:\n");
    while (num > 0)
    {
        digit = num % 10;
        printf("No. of %ds = %d\n", place, digit);
        num = num / 10;
        place = place * 10;
    }
}

int main()
{
    int num;
    printf("Enter a number: ");
    scanf("%d", &num);

    decompose(num);
    return 0;
}

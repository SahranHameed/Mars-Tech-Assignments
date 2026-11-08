// Q 03 - Reverse Number
#include <stdio.h>

int reverse_number(int num)
{
    int reverse = 0, rem;
    while (num)
    {
        rem = num % 10;
        reverse = reverse * 10 + rem;
        num = num / 10;
    }
    return reverse;
}

int main()
{
    int num;
    printf("Enter an input Number: ");
    scanf("%d", &num);

    printf("\nReversed Number is %d\n", reverse_number(num));
    return 0;
}

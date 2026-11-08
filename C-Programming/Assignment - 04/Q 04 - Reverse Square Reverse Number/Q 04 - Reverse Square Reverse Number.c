// Q 04 - Reverse Square Reverse Number
#include <stdio.h>

int reverse_number(int num)
{
    int reverse = 0;
    while (num)
    {
        reverse = reverse * 10 + num % 10;
        num = num / 10;
    }
    return reverse;
}

int is_rsrn(int n)
{
    int rev = reverse_number(n);
    int sq1 = n * n;
    int sq2_rev = reverse_number(rev * rev);

    return (sq1 == sq2_rev);
}

int main()
{
    int i;
    printf("Reverse Square Reverse Numbers from 1 to 100:\n");

    for (i = 1; i <= 100; i++)
    {
        if (is_rsrn(i))
            printf("%d is a reverse square number.\n", i);
    }
    return 0;
}

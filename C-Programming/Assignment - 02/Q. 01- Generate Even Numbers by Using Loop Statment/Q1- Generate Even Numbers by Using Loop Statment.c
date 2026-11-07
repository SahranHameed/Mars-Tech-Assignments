//// 1. Generate Even Numbers by using Loop Statement ////

#include<stdio.h>
int main ()

{
    int num,i;
    printf("Enter a Number:");
    scanf("%d",&num);

    for(i=2; i<=num; i=i+2)
    {
        printf("%d\n",i);
    }
}

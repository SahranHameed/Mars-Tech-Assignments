//// 14. Creat Pascal's Triangle ? ////
#include<stdio.h>
int main()
{
    int input,h,i,j,k=1,m=32;
    printf("Enter Your Desired Number: ");
    scanf("%d",&input);

    for(i=0; i<input; i++)
    {
        for(h=i; h<=input; h++)
        {
            printf("%c",m); // Spaces
        }
        for(j=0; j<i; j++)
        {
            printf("%d",k);
            k=k*(i-j)/(j+1);
        }
        if(input>0)
        {
            printf("%d",1);
        }
        printf("\n");
    }
    return 0;
}


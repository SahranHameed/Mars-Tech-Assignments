////  6. Create Half Pyramid Of *  ////
#include<stdio.h>
int main ()

{
    int i,j,input;
    printf("Enter Your * Limit: ");
    scanf("%d",&input);

    for(i=1; i<=input; i=i+1)
       {
          for(j=1; j<=i; j=j+1)
            {
                printf("* ");
            }
                printf("\n");
       }
}

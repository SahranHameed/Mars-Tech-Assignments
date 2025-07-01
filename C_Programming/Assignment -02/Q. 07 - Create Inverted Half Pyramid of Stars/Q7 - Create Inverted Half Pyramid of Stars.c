////  7. Create Inverted Half Pyramid Of *?  ////
#include<stdio.h>
int main ()

{
    int i,j,input;
    printf("Enter Your Inverted Half * Limit: ");
    scanf("%d",&input);

    for(i=input; i>=1; i=i-1)
       {
          for(j=i; j>=1; j=j-1)
            {
                printf("* ");
            }
                printf("\n");
       }
}

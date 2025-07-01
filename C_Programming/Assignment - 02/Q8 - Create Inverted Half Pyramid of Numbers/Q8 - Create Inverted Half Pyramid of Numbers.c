////  8. Create Inverted Half Pyramid Of Numbers  ////
#include<stdio.h>
int main ()

{
    int i,j,input;
    printf("Enter Your Inverted Pyramid Of Numbers: ");
    scanf("%d",&input);

    for(i=input; i>=1; i=i-1)
       {
          for(j=1; j<=i; j=j+1)
            {
                printf("%d",j);
                //printf("%d",i);
            }
                printf("\n");
       }
}

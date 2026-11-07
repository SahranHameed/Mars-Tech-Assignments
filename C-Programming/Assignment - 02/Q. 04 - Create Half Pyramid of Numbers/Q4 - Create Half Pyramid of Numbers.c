//// 4. Create Half Pyramid Of Numbers  ////
#include<stdio.h>
int main ()

{
    int i,j,num;
    printf("Pyramid Limit Of Number :");
    scanf("%d",&num);

    for(i=1; i<=num; i=i+1)
       {
          for(j=1; j<=i; j=j+1)
            {
                printf("%d",j);
              //printf("%d",i);
            }
                printf("\n");
       }
}

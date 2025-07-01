//// 5. Create Half Pyramid Of Alphabets  ////
#include<stdio.h>
int main ()

{
    int i,j;
    char input;
    printf("Enter an Uppercase Charector You Want to Print in the Last Row: ");
    scanf("%c",&input);

    for(i='A'; i<=input; i=i+1)
       {
          for(j='A'; j<=i; j=j+1)
            {
                //printf("%c",j);
                printf("%c",i);
            }
                printf("\n");
       }
}

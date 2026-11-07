//// 9. Create Inverted Half Pyramid Of Alphabets  ////
#include<stdio.h>
int main ()

{
    int i,j;
    char input;
    printf("Enter The Alphabet Range: ");
    scanf("%c",&input);

    for(i=input; i>='A'; i=i-1)
       {
          for(j='A'; j<=i; j=j+1)
            {
                printf("%c",j);
                //printf("%c",i);
            }
                printf("\n");
       }
}

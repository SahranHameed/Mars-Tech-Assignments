#include <stdio.h>
#include <string.h>
#include <ctype.h>

int check_password(char *password)
{
    int i, len = strlen(password);
    int upper = 0, lower = 0, digit = 0, symbol = 0, sequential = 0;
    int score = 0;

    if (len < 8)
        return 0;

    for (i = 0; i < len; i++)
    {
        if (isupper(password[i]))       upper++;
        else if (islower(password[i]))  lower++;
        else if (isdigit(password[i]))  digit++;
        else if (ispunct(password[i]))  symbol++;
    }

    // sequential check (e.g. 123, 456)
    for (i = 0; i + 2 < len; i++)
    {
        if (isdigit(password[i]) && isdigit(password[i+1]) && isdigit(password[i+2])
            && password[i+1] == password[i] + 1
            && password[i+2] == password[i+1] + 1)
            sequential = 1;
    }

    if (upper >= 1)  score += 2;
    if (lower >= 3)  score += 2;
    if (symbol >= 1) score += 2;
    if (digit >= 3 && !sequential) score += 3;

    return score;
}

int main()
{
    char password[100];
    int rank;

    printf("Enter a password: ");
    scanf("%99s", password);

    rank = check_password(password);
    printf("Password rank: %d\n", rank);

    if (rank == 0)       printf("Weakest\n");
    else if (rank <= 2)  printf("Weak\n");
    else if (rank <= 4)  printf("Average\n");
    else if (rank <= 6)  printf("Medium\n");
    else if (rank <= 8)  printf("Strong\n");
    else                 printf("Strongest\n");

    return 0;
}

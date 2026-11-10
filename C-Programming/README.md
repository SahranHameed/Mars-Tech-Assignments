# C Programming - Assignments

**Program:** AI & CS - 1 Year Project (Mars Tech)
**Registration No:** AI-1131
**IDE / Compiler:** Code::Blocks 20.03 (GCC)

This folder contains my C Programming assignment solutions, the output screenshots
(code + console output) and the assignment PDFs.

---

## Assignments Overview

| No. | Topic | Description |
|-----|-------|-------------|
| 01 | Fundamental Of Programming | Number system concepts including decimal, binary, and hexadecimal representation and conversions. |
| 02 | Loops Statements in C | 15 programs: even/odd numbers, ASCII codes and number / alphabet / star patterns. |
| 03 | Password Validation | String handling - checks password strength and returns a rank from 0 to 9. |
| 04 | User Defined Functions | Multiplication table, decompose a number, reverse a number, Reverse Square Reverse Number. |

---

## Assignment 02 - Loops Statements in C Programming

| Q | Program |
|---|---------|
| 1 | Generate even numbers using a loop |
| 2 | Generate odd numbers using a loop |
| 3 | Generate ASCII codes using a loop |
| 4 | Half pyramid of numbers |
| 5 | Half pyramid of alphabets |
| 6 | Half pyramid of `*` |
| 7 | Inverted half pyramid of `*` |
| 8 | Inverted half pyramid of numbers |
| 9 | Inverted half pyramid of alphabets |
| 10 | Full pyramid of `*` |
| 11 | Full pyramid of alphabets |
| 12 | Inverted full pyramid of `*` |
| 13 | Inverted full pyramid of numbers |
| 14 | Pascal's triangle |
| 15 | Floyd's triangle |

Concepts used: `for` loops, nested loops, `while` loops, `char` arithmetic
(`'A' + i`) and the `%d` / `%c` format specifiers.

---

## Assignment 03 - Password Validation

`int check_password(char *password);`

The function returns a score from 0 (weakest) to 9 (strongest):

| Condition | Score |
|-----------|-------|
| Minimum 8 characters (otherwise rank is 0) | required |
| At least 1 uppercase letter | 2 |
| At least 3 lowercase letters | 2 |
| At least 1 symbol | 2 |
| At least 3 numeric characters that are not sequential | 3 |

`main()` reads the password, calls `check_password()` and prints
Weakest / Weak / Average / Medium / Strong / Strongest.

---

## Assignment 04 - User Defined Functions

1. **Multiplication Table** - table from 1 to 15 for a number greater than 1.
2. **Decompose a Number** - digits with their position values
   (`1234` -> No. of 1s = 4, 10s = 3, 100s = 2, 1000s = 1).
3. **Reverse a Number** - `123` -> `321`.
4. **Reverse Square Reverse Number (RSRN)** - finds all RSRN numbers from 1 to 100
   (e.g. `12`, because `sqr(12) = 144` and `rev(sqr(rev(12))) = 144`).

---

## Folder Structure

```
C_Programming/
├── README.md
├── C_Programming_Assignment_01/
├── C_Programming_Assignment_02/
│   ├── Q01_Even_Numbers.c
│   ├── ...
│   ├── Q15_Floyds_Triangle.c
│   ├── output screenshots (.png)
│   └── Assignment_02.pdf
├── C_Programming_Assignment_03/
│   ├── Assignment_03.c
│   ├── output screenshots (.png)
│   └── Assignment_03.pdf
└── C_Programming_Assignment_04/
    ├── Q01_Multiplication_Table.c
    ├── Q02_Decompose_Number.c
    ├── Q03_Reverse_Number.c
    ├── Q04_Reverse_Square_Reverse_Number.c
    ├── output screenshots (.png)
    └── Assignment_04.pdf
```

---

## How to Run

1. Open the `.c` file in **Code::Blocks**.
2. Press **F9** (Build and Run).
3. Enter the input values in the console window.

Or compile with GCC:

```
gcc filename.c -o program
./program
```

---

## Author

**AI-1131**

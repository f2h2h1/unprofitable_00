#include <stdio.h>
#include <stdlib.h>

enum {Num};
int token;
int token_val;
char *src = NULL;

int factor();
int term_tail(int lvalue);
int expr_tail(int lvalue);
void next();

int factor() {
    int value = 0;
    if (token == '(') {
        next();
        value = expr_tail(term_tail(factor()));
        next();
    } else {
        value = token_val;
        next();
    }
    return value;
}

int term_tail(int lvalue) {
    if (token == '*') {
        next();
        int value = lvalue * factor();
        return term_tail(value);
    } else if (token == '/') {
        next();
        int value = lvalue / factor();
        return term_tail(value);
    } else {
        return lvalue;
    }
}

int expr_tail(int lvalue) {
    if (token == '+') {
        next();
        int value = lvalue + term_tail(factor());
        return expr_tail(value);
    } else if (token == '-') {
        next();
        int value = lvalue - term_tail(factor());
        return expr_tail(value);
    } else {
        return lvalue;
    }
}


void next() {
    // skip white space
    while (*src == ' ' || *src == '\t') {
        src ++;
    }

    token = *src++;

    if (token >= '0' && token <= '9' ) {
        token_val = token - '0';
        token = Num;

        while (*src >= '0' && *src <= '9') {
            token_val = token_val*10 + *src - '0';
            src ++;
        }
        return;
    }
}

int main(int argc, char *argv[])
{
    // char str[100] = "(10 - 2) * (10 / 2) + 1";
    // char str[100] = "10*8-3+1";
    char str[100];
    gets(str);
    src = str;
    next();
    printf("%d\n", expr_tail(term_tail(factor())));

    return 0;
}

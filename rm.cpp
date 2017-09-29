
#include<bits/stdc++.h>
using namespace std;

int nCr(int n, int r)
{
    if(n == r || r == 0) return 1;
    return nCr(n - 1, r) + nCr(n - 1, r - 1);
}

int F(int n, int r, int k){


    return F(n-1, r, k) * k + F(n)
}

int main()
{
    return 0;
}

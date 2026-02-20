function bigIntSqrt(n) {
    if (n < 0n) throw "negative";
    if (n < 2n) return n;
    let x0 = n >> 1n;
    let x1 = (x0 + n / x0) >> 1n;
    while (x1 < x0) {
        x0 = x1;
        x1 = (x0 + n / x0) >> 1n;
    }
    return x0;
}

function computePi(digits = 50, iterations = 8) {

    const scale = 10n ** BigInt(digits + 5); // guard digits

    let a = scale;                     // 1
    let b = scale / bigIntSqrt(2n*scale*scale/scale);
    // easier way to compute b = 1/sqrt(2)
    b = (scale * scale) / bigIntSqrt(2n * scale * scale);

    let t = scale / 4n;                // 1/4
    let p = 1n;

    for (let i=0;i<iterations;i++){
        const an = (a + b) / 2n;
        const bn = bigIntSqrt(a * b);
        const diff = a - an;
        t = t - (p * diff * diff) / scale;
        a = an;
        b = bn;
        p = 2n * p;
    }

    const pi = ((a + b) * (a + b) * scale) / (4n * t);

    const s = pi.toString();
    return s[0] + "." + s.slice(1, digits+1);
}

// try it
console.log(computePi(100000));
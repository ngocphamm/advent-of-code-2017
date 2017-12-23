<?php

function is_prime($number)
{
    if ($number <= 1) return false;

    if ($number < 4) return true; // 2 & 3

    // All prime numbers except 2 are odd
    if ($number % 2 === 0) return false;

    // All prime numbers > 3 will be in form of 3*k +/- 1
    if ($number % 3 === 0) return false;

    $i = 5;
    while ($i <= floor(sqrt($number))) {
        if ($number % $i === 0 || $number % ($i + 2) === 0) return false;
        $i += 6;
    }

    return true;
}

// So... This is totally a trick. And I have not yet come up with a generic solution
// for all cases (by reading the input and analyze it)
// In this particular case, the interesting part will be that the value of h will be
// "considered" only 1001 times, from the value of b to the value of c, while
// c = b + 17000, with the step of 17 (line "sub b -17").
// Each time, the value of h is set only when f = 0, and that only happens when
// b = e * d. e and d both increment by 1 in the inner loops, so this becomes when
// b is NOT a prime number! That's it.
$count = 0;
for ($b = 106500; $b <= 123500; $b += 17) {

    if (!is_prime($b)) $count++;
}

var_dump($count);
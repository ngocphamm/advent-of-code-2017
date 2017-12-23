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

$vals = [];

// Instructions
$ins = file('input_d23.txt', FILE_IGNORE_NEW_LINES);

$i = 0;
$steps = 0;

$count = 0;
for ($b = 106500; $b <= 123500; $b += 17) {

    if (!is_prime($b)) $count++;
}

var_dump($count);
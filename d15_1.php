<?php

// $a = 65;
// $b = 8921;

$a = 703;
$b = 516;

$a_factor = 16807;
$b_factor = 48271;

$divide = 2147483647;

$match = 0;

for ($i = 0; $i < 40000000; $i++) {
    $a = ($a * $a_factor) % $divide;
    $b = ($b * $b_factor) % $divide;

    $last16_bin_a = substr(decbin($a), -16);
    $last16_bin_b = substr(decbin($b), -16);

    if ($last16_bin_a === $last16_bin_b) $match++;
}

var_dump($match);
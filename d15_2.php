<?php

$a = 703;
$b = 516;

$a_factor = 16807;
$b_factor = 48271;

$divide = 2147483647;

$need = 5000000;
$match = 0;

$a_values = [];
$b_values = [];

while (count($a_values) < $need) {
    $a = ($a * $a_factor) % $divide;

    if ($a % 4 === 0) array_push($a_values, $a);
}

while (count($b_values) < $need) {
    $b = ($b * $b_factor) % $divide;

    if ($b % 8 === 0) array_push($b_values, $b);
}

for ($i = 0; $i < $need; $i++) {
    $last16_bin_a = substr(decbin($a_values[$i]), -16);
    $last16_bin_b = substr(decbin($b_values[$i]), -16);

    if ($last16_bin_a === $last16_bin_b) $match++;
}

var_dump($match);
<?php

$arr = array_map(function($a) {
    return intval($a);
}, file('input_d05_1.txt', FILE_IGNORE_NEW_LINES));

$index = 0;
$steps = 0;

while ($index < count($arr)) {
    $tmp = $arr[$index];

    $arr[$index]++;
    $index += $tmp;
    $steps++;
}

var_dump($steps);

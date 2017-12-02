<?php

$input = trim(file_get_contents('input_d01_1.txt'));

$arr = str_split($input);
$half = count($arr) / 2;
$sum = 0;

for ($i = 0; $i < $half; $i++) {
    if ($arr[$i] == $arr[$i + $half]) $sum += $arr[$i]*2;
}

var_dump($sum);

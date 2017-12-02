<?php

$input = trim(file_get_contents('input_d01_1.txt'));

$arr = str_split($input);
$sum = 0;

for ($i = 0; $i < count($arr); $i++) {
    // Last one. Check with the first digit
    if ($i === (count($arr) - 1)) {
        if ($arr[$i] == $arr[0]) $sum += $arr[0];
    } else {
        if ($arr[$i] == $arr[$i+1]) $sum += $arr[$i];
    }   
}
var_dump($sum);

<?php

$arr = [0];

$steps = 329;
$count = 1;
$pos = 0;

for ($i = 0; $i < 2017; $i++) {
    $pos = ($pos + $steps) % count($arr) + 1;

    array_splice($arr, $pos, 0, $count++);
}

var_dump($arr[$pos+1]);
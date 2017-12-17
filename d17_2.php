<?php

$steps = 329;

$size = 1;
$count = 1;
$pos = 0;
$val = 0;

// This is a trick as 0 will ALWAYS be at the beginning
// So value after 0 will be the LAST value got inserted at postion 1
// We do not need to store, and process an array here to save resources
for ($i = 0; $i < 50000000; $i++) {
    $pos = ($pos + $steps) % $size + 1;

    if ($pos === 1) $val = $count;

    $count++;
    $size++;    // Pretend that the array got inserted one element
}

var_dump($val);
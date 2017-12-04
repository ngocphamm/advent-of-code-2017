<?php

$fh = fopen('input_d04_1.txt','r');
$valid_count = 0;

while ($line = fgetcsv($fh, 1000, ' ')) {
    if (count($line) === count(array_unique($line))) $valid_count++;
}

var_dump($valid_count);

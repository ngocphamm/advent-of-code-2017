<?php

$fh = fopen('input_d04_1.txt','r');
$valid_count = 0;

while ($line = fgetcsv($fh, 1000, ' ')) {
    $line_sorted = array_map(function($word) {
        $word_array = str_split($word);
        sort($word_array);

        return join($word_array);
    }, $line);

    if (count($line_sorted) === count(array_unique($line_sorted))) $valid_count++;
}

var_dump($valid_count);

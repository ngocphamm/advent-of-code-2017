<?php

$sum = 0;
$fh = fopen('input_d02.txt','r');

while ($line = fgetcsv($fh, 1000, "\t")) {
    sort($line);

    $sum += $line[count($line) - 1] - $line[0];
}

fclose($fh);

var_dump($sum);

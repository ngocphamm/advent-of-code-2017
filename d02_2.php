<?php

$sum = 0;
$fh = fopen('input_d02.txt','r');

while ($line = fgetcsv($fh, 1000, "\t")) {
    sort($line);

    for ($i = 0; $i < count($line); $i ++) {
        for ($j = count($line) - 1; $j >= 0; $j--) {
            if ($line[$j] != $line[$i] && $line[$j] % $line[$i] === 0) {
                $sum += $line[$j] / $line[$i];
                break 2;
            }
        }
    }
}

fclose($fh);

var_dump($sum);

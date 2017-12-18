<?php

$depth = [];
$range = [];

$lines = file('input_d13.txt', FILE_IGNORE_NEW_LINES);

foreach ($lines as $line) {
    $parts = explode(':', $line);

    array_push($depth, intval(trim($parts[0])));
    array_push($range, intval(trim($parts[1])));
}

$delay = 0;

do {
    $severity = 0;

    for ($i = 0; $i < count($depth); $i++) {
        $dd = $delay + $depth[$i];
        $r21 = 2 * ($range[$i] - 1);

        if ($dd % $r21 === 0) {
            $severity = 1;
            break;
        }
    }

    $delay++;
} while ($severity != 0);

echo ($delay - 1) . PHP_EOL;
<?php

$vals = [];

// Instructions
$ins = file('input_d23.txt', FILE_IGNORE_NEW_LINES);

$mul_count = 0;

$i = 0;
while (1) {
    if ($i >= count($ins)) break;

    $in = $ins[$i];
    $parts = explode(' ', substr($in, 4));

    if (!isset($vals[$parts[0]])) $vals[$parts[0]] = intval($parts[0]);

    $val = 0;
    if (count($parts) > 1) {
        if (!is_numeric($parts[1])) {
            $val = $vals[$parts[1]];
        } else {
            $val = intval($parts[1]);
        }
    }

    switch(substr($in, 0, 3)) {
        case 'set':
            $vals[$parts[0]] = $val;
            break;

        case 'sub':
            $vals[$parts[0]] -= $val;
            break;

        case 'mul':
            $vals[$parts[0]] *= $val;
            $mul_count++;
            break;

        case 'jnz':
            if ($vals[$parts[0]] != 0) {
                $i += $val;
                continue 2;
            }
            break;
    }

    $i++;
}

var_dump($mul_count);
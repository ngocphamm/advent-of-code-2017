<?php

$vals = [];
$sound = 0;

// Instructions
$ins = file('input_d18_1.txt', FILE_IGNORE_NEW_LINES);

$i = 0;
while (1) {
    $in = $ins[$i];
    $parts = explode(' ', substr($in, 4));

    if (!isset($vals[$parts[0]])) $vals[$parts[0]] = 0;

    $val = 0;
    if (count($parts) > 1) {
        if (!is_numeric($parts[1])) {
            $val = $vals[$parts[1]];
        } else {
            $val = intval($parts[1]);
        }
    }

    switch(substr($in, 0, 3)) {
        case 'snd':
            $sound = $vals[$parts[0]];
            break;

        case 'set':
            $vals[$parts[0]] = $val;
            break;

        case 'add':
            $vals[$parts[0]] += $val;
            break;

        case 'mul':
            $vals[$parts[0]] *= $val;
            break;

        case 'mod':
            $vals[$parts[0]] = $vals[$parts[0]] % $val;
            break;

        case 'rcv':
            if ($sound !== 0) echo $sound;
            break 2;

        case 'jgz':
            if ($vals[$parts[0]] > 0) {
                $i += $val;
                continue 2;
            }
            break;
    }

    $i++;
}
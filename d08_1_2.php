<?php

$mems = [];
$max = 0;
$highest = 0;

$fh = fopen('input_d08.txt','r');

while ($line = fgets($fh, 100)) {
    $parts = explode('if', $line);

    // instruction part
    $instructions = explode(' ', trim($parts[0]));

    $ins_target = isset($mems[$instructions[0]]) ? $mems[$instructions[0]] : 0;
    $ins_value = intval($instructions[2]);

    // condition part
    $conditions = explode(' ', trim($parts[1]));

    $con_target = isset($mems[$conditions[0]]) ? $mems[$conditions[0]] : 0;
    $con_value = intval($conditions[2]);

    $condition_met = false;
    switch (trim($conditions[1])) {
        case '>':
            $condition_met = $con_target > $con_value;
            break;

        case '<':
            $condition_met = $con_target < $con_value;
            break;

        case '>=':
            $condition_met = $con_target >= $con_value;
            break;

        case '<=':
            $condition_met = $con_target <= $con_value;
            break;

        case '==':
            $condition_met = $con_target == $con_value;
            break;

        case '!=':
            $condition_met = $con_target != $con_value;
            break;
    }

    if ($condition_met) {
        switch (trim($instructions[1])) {
            case 'inc':
                $ins_target += $ins_value;
                break;

            case 'dec':
                $ins_target -= $ins_value;
                break;
        }
    }

    if ($ins_target > $highest) $highest = $ins_target;

    $mems[$instructions[0]] = $ins_target;
}

foreach ($mems as $mem => $val) {
    if ($val > $max) {
        $max = $val;
    }
}

echo 'Max value is: ' . $max;
echo 'Highest value is: ' . $highest;


<?php

function process_line($line, & $group0, & $to_process)
{
    $line_parts = explode('<->', $line);
    $ns_right = explode(',', trim($line_parts[1]));

    foreach ($ns_right as $n_right) {
        $n = intval(trim($n_right));

        if (!in_array($n, $to_process) && !in_array($n, $group0)) {
            array_push($to_process, $n);
        }
    }
}

$lines = file('input_d12_1.txt', FILE_IGNORE_NEW_LINES);

$group0 = [];
$to_process = [ 0 ];

while (count($to_process) > 0) {
    $n = array_shift($to_process);
    array_push($group0, $n);

    process_line($lines[$n], $group0, $to_process);
}

var_dump(count($group0));
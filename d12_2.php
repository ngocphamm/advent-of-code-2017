<?php

function process_line($line, &$group_members, &$to_process)
{
    $line_parts = explode('<->', $line);
    $ns_right = explode(',', trim($line_parts[1]));

    foreach ($ns_right as $n_right) {
        $n = intval(trim($n_right));

        if (!in_array($n, $to_process) && !in_array($n, $group_members)) {
            array_push($to_process, $n);
        }
    }
}

$lines = file('input_d12_1.txt', FILE_IGNORE_NEW_LINES);

$group_count = 0;
$processed_lines = [];
$remaining_lines = array_keys($lines);

while (count($remaining_lines) > 0) {

    $group_members = [];
    $to_process = [ $remaining_lines[0] ];

    while (count($to_process) > 0) {
        $n = array_shift($to_process);
        array_push($group_members, $n);
        array_push($processed_lines, $n);

        process_line($lines[$n], $group_members, $to_process);
    }

    $group_count++;
    
    $t = array_values($processed_lines);
    $u = array_keys($lines);
    $remaining_lines = array_merge(array_diff($t, $u), array_diff($u, $t));
}

var_dump($group_count);
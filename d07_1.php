<?php

$lines = file('input_d07.txt', FILE_IGNORE_NEW_LINES);

$processes = [];
$child_processes = [];

foreach ($lines as $line) {
    $parts = explode('->', trim($line));

    $sub_parts = explode(' ', trim($parts[0]));
    array_push($processes, $sub_parts[0]);

    if (count($parts) > 1) {
        // Has children
        foreach (explode(', ', trim($parts[1])) as $child) {
            array_push($child_processes, $child);
        }
    }
}

// There SHOULD BE only 1 process that NOT in child process list.
// And that's the culprit.
var_dump(array_diff(array_unique($processes), array_unique($child_processes)));

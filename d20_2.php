<?php

function manhattan_dist($vector)
{
    return abs($vector[0]) + abs($vector[1]) + abs($vector[2]);
}

function move(&$particle)
{
    $particle['v'][0] += $particle['a'][0];
    $particle['v'][1] += $particle['a'][1];
    $particle['v'][2] += $particle['a'][2];

    $particle['p'][0] += $particle['v'][0];
    $particle['p'][1] += $particle['v'][1];
    $particle['p'][2] += $particle['v'][2];
}

$particles = [];
$dst = [];

$lines = file('input_d20.txt', FILE_IGNORE_NEW_LINES);

$index = 0;
foreach ($lines as $line) {
    array_push($dst, []);
    $parts = explode(', ', $line);

    array_push($particles, [
        'i' => $index,
        'p' => explode(',', substr(explode('=', $parts[0])[1], 1, -1)),
        'v' => explode(',', substr(explode('=', $parts[1])[1], 1, -1)),
        'a' => explode(',', substr(explode('=', $parts[2])[1], 1, -1))
    ]);

    $index++;
}

$i = 0;
// Totally dumb shit. There's no guarantee that 100000 iterations would be enough.
// But I got lucky as after such iterations, I got the right answer.
// And this is fucking slow.
// Apparently 40 iterations was enough???
while ($i < 40) {
    $p_pos = [];
    $p_dup = [];

    foreach ($particles as &$particle) {
        move($particle);

        $p_str = implode('-', $particle['p']);

        if (!isset($p_pos[$p_str])) $p_pos[$p_str] = [];

        array_push($p_pos[$p_str], $particle['i']);
    }

    foreach ($p_pos as $pos) {
        if (count($pos) > 1) {
            // duplicates
            foreach ($pos as $idx) {
                unset($particles[$idx]);
            }
        }
    }

    $i++;
}

var_dump(count($particles));
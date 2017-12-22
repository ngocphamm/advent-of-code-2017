<?php

function manhattan_dist($vector)
{
    return abs($vector[0]) + abs($vector[1]) + abs($vector[2]);
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

// The one that tends to stay closest to root is the one with smallest
// acceleration, AND started closest to root
usort($particles, function($a, $b) {
    $aam = manhattan_dist($a['a']);
    $bam = manhattan_dist($b['a']);

    // Check acceleration
    if ($aam > $bam) return 1;
    else if ($aam < $bam) return -1;
    else if ($aam === $bam) {
        // Check current position
        $apm = manhattan_dist($a['p']);
        $bpm = manhattan_dist($b['p']);

        if ($apm > $bpm) return 1;
        if ($apm < $bpm) return -1;
        return 0;
    }
});

var_dump($particles[0]['i']);
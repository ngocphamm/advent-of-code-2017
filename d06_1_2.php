<?php

$banks = [5, 1, 10, 0, 1, 7, 13, 14, 3, 12, 8, 10, 7, 12, 0, 6];
$hashes = [ get_array_hash($banks) ];
$steps = 0;

while (1) {
    $steps++;

    $max = max($banks);
    $key = array_search($max, $banks);

    $counter = 1;
    $banks[$key] = 0;
    while ($max > 0) {
        $index = $key + $counter++;

        // Wrap around
        if ($index >= count($banks)) $index = $index % count($banks);

        $banks[$index]++;
        $max--;
    }

    $arr_hash = get_array_hash($banks);

    if (in_array($arr_hash, $hashes)) {
        // How many steps between the 2 times the banks look alike
        var_dump(count($hashes) - array_search($arr_hash, $hashes));
        var_dump($steps);
        break;
    }

    array_push($hashes, $arr_hash);
}

function get_array_hash($arr)
{
    return hash('sha256', implode($arr, '-'));
}

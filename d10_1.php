<?php

function array_cut($input, $offset, $length)
{
    $slice = array_slice($input, $offset, $length);

    if ($offset + $length > count($input)) {
        $slice = array_merge($slice, array_slice($input, 0, $length - count($slice)));
    }

    return $slice;
}

function array_swap($input, $offset, $length, $swap_array)
{
    for ($i = 0; $i < $length; $i++) {
        $index = $i + $offset;
        if ($index > (count($input) - 1)) $index = $index % count($input);

        $input[$index] = $swap_array[$i];
    }

    return $input;
}

$lengths = [102, 255, 99, 252, 200, 24, 219, 57, 103, 2, 226, 254, 1, 0, 69, 216];
$list = range(0, 255);

$index = $skip = 0;

foreach ($lengths as $length) {
    $list = array_swap(
        $list, 
        $index, 
        $length,
        array_reverse(array_cut($list, $index, $length))
    );

    $index += $length + $skip;
    if ($index > (count($list) - 1)) $index = $index % count($list);

    $skip++;
}

var_dump(count($list));
var_dump($list[0] * $list[1]);

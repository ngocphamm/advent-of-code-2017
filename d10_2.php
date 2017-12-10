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

function str_to_ascii_sequence($input)
{
    return array_merge(
        array_map(function ($c) {
            return ord($c);
        }, str_split( ($input))),
        [17, 31, 73, 47, 23]
    );
}

$sequence = '102,255,99,252,200,24,219,57,103,2,226,254,1,0,69,216';

$lengths = str_to_ascii_sequence($sequence);
$list = range(0, 255);

$index = $skip = 0;

for ($i = 0; $i < 64; $i++) {
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
}

$hash = '';
foreach (array_chunk($list, 16) as $chunk) {
    $xor = 0;
    foreach ($chunk as $num) {
        $xor ^= $num;
    }

    // convert to hex
    $hash .= str_pad(dechex($xor), 2, '0', STR_PAD_LEFT);
}

var_dump($hash);
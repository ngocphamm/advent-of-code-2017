<?php

function array_swap(&$array, $offset, $length)
{
    $arr_length = count($array);

    for ($i = 0; $i < intval($length / 2); $i++) {
        // Wrap around list
        $index = ($offset + $i) % $arr_length;
        $index_to = ($offset + $length - 1 - $i) % $arr_length;

        $tmp = $array[$index_to];
        $array[$index_to] = $array[$index];
        $array[$index] = $tmp;
    }
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
        array_swap($list, $index, $length);

        // Wrap around list
        $index = ($index + $length + $skip) % count($list);

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
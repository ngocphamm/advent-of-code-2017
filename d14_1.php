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
        }, str_split($input)),
        [17, 31, 73, 47, 23]
    );
}

function calculate_knot_hash($input)
{
    $hash = '';
    $lengths = str_to_ascii_sequence($input);
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

    foreach (array_chunk($list, 16) as $chunk) {
        $xor = 0;
        foreach ($chunk as $num) {
            $xor ^= $num;
        }

        // convert to hex
        $hash .= str_pad(dechex($xor), 2, '0', STR_PAD_LEFT);
    }

    return $hash;
}

$key = 'hxtvlmkl';
$used_square = 0;

for ($i = 0; $i < 128; $i++) {
    $hash = calculate_knot_hash("{$key}-{$i}");

    for ($j = 0; $j < strlen($hash); $j++) {
        $bin = base_convert($hash[$j], 16, 2);
        $used_square += substr_count($bin, '1');
    }
}

var_dump($used_square);
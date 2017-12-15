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
$grid = [];

for ($i = 0; $i < 128; $i++) {
    $bin = '';
    $hash = calculate_knot_hash("{$key}-{$i}");

    for ($j = 0; $j < strlen($hash); $j++) {
        $bin .= str_pad(base_convert($hash[$j], 16, 2), 4, '0', STR_PAD_LEFT);
    }

    $grid[$i] = str_split($bin);
}

// Now check the grid
$check = [];
$region = 0;

for ($i = 0; $i < 128; $i++) {
    for ($j = 0; $j < 128; $j++) {
        $si = 0; // stack index
        $stack = [];

        if (!isset($check[$i][$j]) && $grid[$i][$j] === '1') {
            $region++;
            $check[$i][$j] = $region;
            array_push($stack, "{$i}-{$j}");

            while ($si < count($stack)) {
                $cur = explode('-', $stack[$si]);
                $x = $cur[0];
                $y = $cur[1];
                $si++;

                // Check adjacents
                if (!isset($check[$x+1][$y]) && isset($grid[$x+1][$y]) && $grid[$x+1][$y] === '1') {
                    $check[$x+1][$y] = $region;
                    array_push($stack, ($x+1) . '-' . ($y));
                }

                if (!isset($check[$x-1][$y]) && isset($grid[$x-1][$y]) && $grid[$x-1][$y] === '1') {
                    $check[$x-1][$y] = $region;
                    array_push($stack, ($x-1) . '-' . ($y));
                }

                if (!isset($check[$x][$y+1]) && isset($grid[$x][$y+1]) && $grid[$x][$y+1] === '1') {
                    $check[$x][$y+1] = $region;
                    array_push($stack, ($x) . '-' . ($y+1));
                }

                if (!isset($check[$x][$y-1]) && isset($grid[$x][$y-1]) && $grid[$x][$y-1] === '1') {
                    $check[$x][$y-1] = $region;
                    array_push($stack, ($x) . '-' . ($y-1));
                }
            }
        }
    }
}

var_dump($region);
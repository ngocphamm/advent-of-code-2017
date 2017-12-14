<?php

function array_swap(&$array, $offset, $length)
{
    $arr_length = count($array);

    for ($i = 0; $i < intval($length / 2); $i++) {
        $index = $offset + $i;
        $index_to = $offset + $length - 1 - $i;

        if ($index > ($arr_length - 1)) $index = $index % $arr_length;
        if ($index_to > ($arr_length - 1)) $index_to = $index_to % $arr_length;

        $tmp = $array[$index_to];
        $array[$index_to] = $array[$index];
        $array[$index] = $tmp;
    }
}

$lengths = [102, 255, 99, 252, 200, 24, 219, 57, 103, 2, 226, 254, 1, 0, 69, 216];
$list = range(0, 255);

$index = $skip = 0;

foreach ($lengths as $length) {
    array_swap($list, $index, $length);

    $index += $length + $skip;
    if ($index > (count($list) - 1)) $index = $index % count($list);

    $skip++;
}

var_dump($list[0] * $list[1]);
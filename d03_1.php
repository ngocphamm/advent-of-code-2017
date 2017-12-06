<?php

$to_number = 361527;
$distance = 0;
$round_num = 1;
$round = 0;

while ($round_num < $to_number) {
    $round++;
    $round_num += 8*$round;
}

$distance += $round;
$edge = $round*2 + 1;

$edge_center = $round_num - $round;
$edge_distance = abs($to_number - $edge_center);
while ($edge_distance > $round) {
    // next edge
    $edge_center -= $round*2;
    $edge_distance = abs($to_number - $edge_center);
}

$distance += $edge_distance;

// var_dump($round);
// var_dump($round_num);
var_dump($distance);

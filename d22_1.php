<?php

$grid = [];
$lines = file('input_d22.txt', FILE_IGNORE_NEW_LINES);

$half = intval(floor(count($lines) / 2));

// Do it this way so the center of the grid is 0,0
// and we can just expand the grid at will
for ($i = $half*-1; $i <= $half; $i++) {
    $line_chars = str_split($lines[$i+$half]);

    for ($j = $half*-1; $j <= $half; $j++) {
        $grid[$i][$j] = $line_chars[$j+$half];
    }
}

$burst = 0;
$x = $y = 0;
$dir = 'up';
$infection = 0;

while ($burst < 10000) {
    if (!isset($grid[$x][$y])) $grid[$x][$y] = '.';

    if ($grid[$x][$y] === '.') {
        // Clean node. Turn left. Infect the node. Then move forward (left).
        $grid[$x][$y] = '#';
        $infection++;

        switch ($dir) {
            case 'up':
                $y--;
                $dir = 'left';
                break;

            case 'right':
                $x--;
                $dir = 'up';
                break;

            case 'down':
                $y++;
                $dir = 'right';
                break;

            case 'left':
                $x++;
                $dir = 'down';
                break;
        }
    } else {
        // Infected node. Turn right. Clean the node. Then move forward (right).
        $grid[$x][$y] = '.';

        switch ($dir) {
            case 'up':
                $y++;
                $dir = 'right';
                break;

            case 'right':
                $x++;
                $dir = 'down';
                break;

            case 'down':
                $y--;
                $dir = 'left';
                break;

            case 'left':
                $x--;
                $dir = 'up';
                break;
        }
    }

    $burst++;
}

var_dump($infection);


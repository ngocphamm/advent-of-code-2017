<?php

$grid = [];
$lines = file('input_d22.txt', FILE_IGNORE_NEW_LINES);

$half = intval(floor(count($lines) / 2));

// Do it this way so the center of the grid is 0,0
// and we can just expand the grid at will
for ($i = $half * -1; $i <= $half; $i++) {
    $line_chars = str_split($lines[$i + $half]);

    for ($j = $half * -1; $j <= $half; $j++) {
        $grid[$i][$j] = $line_chars[$j + $half] === '.' ? 'C' : 'I';
    }
}

$burst = 0;
$x = $y = 0;
$dir = 'up';
$infection = 0;

while ($burst < 10000000) {
    if (!isset($grid[$x][$y])) $grid[$x][$y] = 'C';

    if ($grid[$x][$y] === 'C') {
        // Clean node. Turn left. Weaken the node. Then move forward (left).
        $grid[$x][$y] = 'W';

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
    } else if ($grid[$x][$y] === 'I') {
        // Infected node. Turn right. Flag the node. Then move forward (right).
        $grid[$x][$y] = 'F';

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
    } else if ($grid[$x][$y] === 'W') {
        // Weaken node. No turn. Infect the node. Move forward.
        $grid[$x][$y] = 'I';
        $infection++;

        switch ($dir) {
            case 'up':
                $x--;
                break;

            case 'right':
                $y++;
                break;

            case 'down':
                $x++;
                break;

            case 'left':
                $y--;
                break;
        }
    } else if ($grid[$x][$y] === 'F') {
        // Flagged node. Reverse direction. Clean the node. Go back.
        $grid[$x][$y] = 'C';

        switch ($dir) {
            case 'up':
                $x++;
                $dir = 'down';
                break;

            case 'right':
                $y--;
                $dir = 'left';
                break;

            case 'down':
                $x--;
                $dir = 'up';
                break;

            case 'left':
                $y++;
                $dir = 'right';
                break;
        }
    }

    $burst++;
}

var_dump($infection);


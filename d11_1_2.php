<?php

// http://keekerdc.com/2011/03/hexagon-grids-coordinate-systems-and-distance-calculations/

$moves = explode(',', file_get_contents('input_d11_1.txt'));

$x = $y = $z = 0;
$max = 0;

foreach ($moves as $move) {
    switch (trim($move)) {
        case 'n':
            $y++;
            $z--;
            break;
        case 'ne':
            $x++;
            $z--;
            break;
        case 'se';
            $x++;
            $y--;
            break;
        case 's':
            $y--;
            $z++;
            break;
        case 'sw':
            $x--;
            $z++;
            break;
        case 'nw':
            $x--;
            $y++;
            break;
    }

    $max = max($x, $y, $z, $max);
}


echo $x . ':' . $y . ':' . $z . PHP_EOL;
echo 'Distance: ' . max($x, $y, $z) . PHP_EOL;
echo 'Max: ' . $max . PHP_EOL;


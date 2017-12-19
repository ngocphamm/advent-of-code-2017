<?php

function travel_path($grid, &$x, &$y, &$dir, &$letters)
{
    if ($dir === 'down' || $dir === 'up') {
        if ($grid[$x][$y] === '+') {
            // Check left or right if has value
            if (isset($grid[$x][$y - 1]) && $grid[$x][$y - 1] === '-') {
                $dir = 'left';
                $y--;
            } else if (isset($grid[$x][$y + 1]) && $grid[$x][$y + 1] === '-') {
                $dir = 'right';
                $y++;
            }
        } else {
            // Collect the letter
            if (ctype_alpha($grid[$x][$y])) {
                $letters .= $grid[$x][$y];
                // echo 'Letter ' . $grid[$x][$y] . ' at ' . $x . ', ' . $y . " Dir: {$dir}" . PHP_EOL;
            }

            $x = ($dir === 'down') ? $x + 1 : $x - 1;

            if (!isset($grid[$x][$y]) || $grid[$x][$y] === ' ') $dir = NULL; // Reached the end
        }
    } else {
        if ($grid[$x][$y] === '+') {
            // Check left or right if has value
            if (isset($grid[$x - 1][$y]) && $grid[$x - 1][$y] === '|') {
                $dir = 'up';
                $x--;
            } else if (isset($grid[$x + 1][$y]) && $grid[$x + 1][$y] === '|') {
                $dir = 'down';
                $x++;
            }
        } else {
            // Collect the letter
            if (ctype_alpha($grid[$x][$y])) {
                $letters .= $grid[$x][$y];
                // echo 'Letter ' . $grid[$x][$y] . ' at ' . $x . ', ' . $y . " Dir: {$dir}" . PHP_EOL;
            }

            $y = ($dir === 'right') ? $y + 1 : $y - 1;

            if (!isset($grid[$x][$y]) || $grid[$x][$y] === ' ') $dir = NULL; // Reached the end
        }
    }
}

$grid = [];
$lines = file('input_d19.txt', FILE_IGNORE_NEW_LINES);

foreach ($lines as $line) {
    array_push($grid, str_split($line));
}

// Start at the last place in first row
$letters = '';
$x = 0;
$y = count($grid[0]) - 1;
$dir = 'down';

$i = 0;
while (1) {
    travel_path($grid, $x, $y, $dir, $letters);

    if ($dir === null) break;

    $i++;
}

var_dump($letters, $i + 1); // + 1 for the last letter
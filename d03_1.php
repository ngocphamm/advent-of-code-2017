<?php

function find_closest_sqrt(int $number)
{
    $sqrt = sqrt($number);

    if (intval($sqrt)**2 === $number) return $sqrt;

    return intval($sqrt) + 1;
}

function travel_sprial_matrix(int $size, int $dest_number)
{
    // We need odd size
    if ($size % 2 === 0) $size += 1;

    $matrix = [];
    $center = intval(floor($size / 2));
    $x = $y = $center;

    $count = 1;

    // Start at matrix's center
    $matrix[$x][$y] = $count++;

    $step_right_up = 1;

    while (1) {
        $step_left_down = $step_right_up + 1;

        // Go right
        for ($i = 1; $i <= $step_right_up; $i++) {
            $y += 1;

            if ($count == $dest_number) return get_manhattan_distance($center, $center, $x, $y);

            $matrix[$x][$y] = $count++;

            // Reach the bottom right of the matrix. We are done!
            if ($x == ($size - 1) && $y == ($size - 1)) break 2;
        }

        // Go up
        for ($i = 1; $i <= $step_right_up; $i++) {
            $x -= 1;

            if ($count == $dest_number) return get_manhattan_distance($center, $center, $x, $y);

            $matrix[$x][$y] = $count++;
        }

        // Go left
        for ($i = 1; $i <= $step_left_down; $i++) {
            $y -= 1;

            if ($count == $dest_number) return get_manhattan_distance($center, $center, $x, $y);

            $matrix[$x][$y] = $count++;
        }

        // Go down
        for ($i = 1; $i <= $step_left_down; $i++) {
            $x += 1;

            if ($count == $dest_number) return get_manhattan_distance($center, $center, $x, $y);

            $matrix[$x][$y] = $count++;
        }

        $step_right_up += 2;
    }

    return $matrix;
}

function print_spiral_matrix(array $matrix)
{
    $pad = strlen(count($matrix)**2) + 1;

    for ($i = 0; $i < count($matrix); $i++) {
        for ($j = 0; $j < count($matrix); $j++) {
            echo str_pad($matrix[$i][$j], $pad);
        }

        echo PHP_EOL;
    }
}

function get_manhattan_distance($x1, $y1, $x2, $y2)
{
    return abs($x1 - $x2) + abs($y1 - $y2);
}

$dest = 361527;
$size = find_closest_sqrt($dest);
var_dump(travel_sprial_matrix($size, $dest));

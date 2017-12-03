<?php

function get_adjacent_values($matrix, $x, $y)
{
    $sum = 0;

    $sum += isset($matrix[$x-1][$y-1]) ? $matrix[$x-1][$y-1] : 0;
    $sum += isset($matrix[$x-1][$y]) ? $matrix[$x-1][$y] : 0;
    $sum += isset($matrix[$x-1][$y+1]) ? $matrix[$x-1][$y+1] : 0;
    $sum += isset($matrix[$x][$y-1]) ? $matrix[$x][$y-1] : 0;
    $sum += isset($matrix[$x][$y+1]) ? $matrix[$x][$y+1] : 0;
    $sum += isset($matrix[$x+1][$y-1]) ? $matrix[$x+1][$y-1] : 0;
    $sum += isset($matrix[$x+1][$y]) ? $matrix[$x+1][$y] : 0;
    $sum += isset($matrix[$x+1][$y+1]) ? $matrix[$x+1][$y+1] : 0;

    return $sum;
}

function travel_sprial_matrix(int $size, int $dest_number)
{
    // We need odd size
    if ($size % 2 === 0) $size += 1;

    $matrix = [];
    $center = intval(floor($size / 2));
    $x = $y = $center;

    $next_num = 1;

    // Start at matrix's center
    $matrix[$x][$y] = $next_num++;

    $step_right_up = 1;

    while (1) {
        $step_left_down = $step_right_up + 1;

        // Go right
        for ($i = 1; $i <= $step_right_up; $i++) {
            $y += 1;

            $matrix[$x][$y] = get_adjacent_values($matrix, $x, $y);

            if ($matrix[$x][$y] > $dest_number) return $matrix[$x][$y];
        }

        // Go up
        for ($i = 1; $i <= $step_right_up; $i++) {
            $x -= 1;

            $matrix[$x][$y] = get_adjacent_values($matrix, $x, $y);

            if ($matrix[$x][$y] > $dest_number) return $matrix[$x][$y];
        }

        // Go left
        for ($i = 1; $i <= $step_left_down; $i++) {
            $y -= 1;

            $matrix[$x][$y] = get_adjacent_values($matrix, $x, $y);

            if ($matrix[$x][$y] > $dest_number) return $matrix[$x][$y];
        }

        // Go down
        for ($i = 1; $i <= $step_left_down; $i++) {
            $x += 1;

            $matrix[$x][$y] = get_adjacent_values($matrix, $x, $y);

            if ($matrix[$x][$y] > $dest_number) return $matrix[$x][$y];
        }

        $step_right_up += 2;
    }
}

var_dump(travel_sprial_matrix(1000, 361527));

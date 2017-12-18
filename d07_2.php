<?php

$lines = file('input_d07.txt', FILE_IGNORE_NEW_LINES);

$processes = [];
$unbalanced = false;

foreach ($lines as $line) {
    $parts = explode('->', trim($line));

    $sub_parts = explode(' ', trim($parts[0]));
    $processes[$sub_parts[0]]['weight'] = substr($sub_parts[1], 1, -1);

    if (count($parts) > 1) {
        // Has children
        $processes[$sub_parts[0]]['children'] = explode(', ', trim($parts[1]));
    }
}

function sum_weight(&$processes, &$unbalanced, $process_name) {
    $weight = $processes[$process_name]['weight'];

    if (isset($processes[$process_name]['children'])) {
        $child_weights = [];
        foreach ($processes[$process_name]['children'] as $child) {
            $processes[$child]['sum_weight'] = sum_weight($processes, $unbalanced, $child);

            $weight += $processes[$child]['sum_weight'];

            array_push($child_weights, $processes[$child]['sum_weight']);
        }

        // All children should have same weights
        if (count(array_unique($child_weights)) > 1 && $unbalanced === false) {
            $unbalanced = true;

            if (count($child_weights) === 2) {
                // One of the childrens need change. Does not matter which one
                // However the problem assumes there will only one process has
                // the wrong weight and need to be changed, so this is not happening.
            } else {
                // These calculation might be way more complicated than it should be
                foreach (array_count_values($child_weights) as $weight => $count) {
                    if ($count === 1) {
                        $weight_index = array_search($weight, $child_weights);
                        break;
                    }
                }

                $other_weight = ($weight_index === 0) ? $child_weights[1] : $child_weights[0];

                $child_name = $processes[$process_name]['children'][$weight_index];
                echo 'Process weight should be: '
                    . ($processes[$child_name]['weight'] - ($processes[$child_name]['sum_weight'] - $other_weight))
                    . PHP_EOL;
            }

            // var_dump($child_weights);
            // var_dump($processes[$process_name]['children']);
            // var_dump($process_name);
        }
    }

    return $weight;
}

sum_weight($processes, $unbalanced, 'hlqnsbe'); // root process

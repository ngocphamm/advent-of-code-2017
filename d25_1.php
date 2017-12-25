<?php

$tape = [];
$cur = 0;
$state = 'A';

for ($i = 0; $i < 12861455; $i++) {
    if (!isset($tape[$cur])) $tape[$cur] = 0;

    switch ($state) {
        case 'A':
            if ($tape[$cur] === 0) {
                $tape[$cur] = 1;
                $cur++;
            } else {
                $tape[$cur] = 0;
                $cur--;
            }
            $state = 'B';
            break;

        case 'B':
            if ($tape[$cur] === 0) {
                $tape[$cur] = 1;
                $cur--;
                $state = 'C';
            } else {
                $tape[$cur] = 0;
                $cur++;
                $state = 'E';
            }
            break;

        case 'C':
            if ($tape[$cur] === 0) {
                $tape[$cur] = 1;
                $cur++;
                $state = 'E';
            } else {
                $tape[$cur] = 0;
                $cur--;
                $state = 'D';
            }
            break;

        case 'D':
            $tape[$cur] = 1;
            $cur--;
            $state = 'A';
            break;

        case 'E':
            if ($tape[$cur] === 0) {
                $state = 'A';
            } else {
                $state = 'F';
            }
            $tape[$cur] = 0;
            $cur++;
            break;

        case 'F':
            if ($tape[$cur] === 0) {
                $state = 'E';
            } else {
                $state = 'A';
            }
            $tape[$cur] = 1;
            $cur++;
            break;

    }
}

var_dump(array_count_values($tape)[1]);
<?php

$fh = fopen('input_d09.txt','r');

// Vars
$score = 0;
$ignored = '';
$no_garbage = '';

$ignore_next = false;
while ($char = fgetc($fh)) {
    if ($ignore_next === true) {
        $ignore_next = false;
        continue;
    }

    if ($char !== '!') {
        $ignored .= $char;
        continue;
    }

    $ignore_next = true;
}

$is_garbage = false;
$garbage_char_count = 0;
for ($i = 0; $i < strlen($ignored); $i++) {
    if ($ignored[$i] === '>') {
        $is_garbage = false;
        continue;
    }

    if ($is_garbage === true) {
        $garbage_char_count++;
        continue;
    }

    if ($ignored[$i] === '<') {
        $is_garbage = true;
        continue;
    }

    $no_garbage .= $ignored[$i];
}

// echo $ignored . PHP_EOL;
// echo $no_garbage . PHP_EOL;
$level = 0;
for ($i = 0; $i < strlen($no_garbage); $i++) {
    if ($no_garbage[$i] === '{') {
        $level++;
    }

    if ($no_garbage[$i] === '}') {
        $score += $level;
        $level--;
    }
}

echo $score . PHP_EOL;
echo $garbage_char_count . PHP_EOL;

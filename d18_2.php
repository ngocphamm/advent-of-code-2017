<?php

function exec_prog($ins, $prog_id, $send_to_prog_id, &$data)
{
    // It should stop processing when it sees there's nothing else to receive
    while (1) {
        $data['runs']++;

        $in = $ins[$data['cur'][$prog_id]];
        $parts = explode(' ', substr($in, 4));

        if (!isset($data['vals'][$prog_id][$parts[0]])) {
            if ($parts[0] === 'p') {
                $data['vals'][$prog_id][$parts[0]] = $prog_id;
            } else {
                // the intval() because of the freaking "jgz 1 3" instruction
                $data['vals'][$prog_id][$parts[0]] = intval($parts[0]);
            }
        }

        $val = 0;
        if (count($parts) > 1) {
            if (!is_numeric($parts[1])) {
                $val = $data['vals'][$prog_id][$parts[1]];
            } else {
                $val = intval($parts[1]);
            }
        }

        switch (substr($in, 0, 3)) {
            case 'snd':
                array_push($data['queue'][$send_to_prog_id], $data['vals'][$prog_id][$parts[0]]);
                $data['sent_count'][$prog_id]++;
                break;

            case 'set':
                $data['vals'][$prog_id][$parts[0]] = $val;
                break;

            case 'add':
                $data['vals'][$prog_id][$parts[0]] += $val;
                break;

            case 'mul':
                $data['vals'][$prog_id][$parts[0]] *= $val;
                break;

            case 'mod':
                $data['vals'][$prog_id][$parts[0]] = $data['vals'][$prog_id][$parts[0]] % $val;
                break;

            case 'rcv':
                if (count($data['queue'][$prog_id]) > 0) {
                    $data['vals'][$prog_id][$parts[0]] = array_shift($data['queue'][$prog_id]);
                } else {
                    // Nothing to receive. Return current position and wait.
                    return;
                }
                break;

            case 'jgz':
                if ($data['vals'][$prog_id][$parts[0]] > 0) {
                    $data['cur'][$prog_id] += $val;
                    continue 2;
                }
                break;
        }

        $data['cur'][$prog_id]++;
    }
}

// Instructions
$ins = file('input_d18_1.txt', FILE_IGNORE_NEW_LINES);

$data = [
    'vals' => [0 => [], 1 => []],
    'queue' => [0 => [], 1 => []],
    'sent_count' => [0 => 0, 1 => 0],
    'cur' => [0 => 0, 1 => 0],
    'runs' => 0
];

while ($data['cur'][0] === 0 || count($data['queue'][0]) > 0 || count($data['queue'][1]) > 0) {
    if ($data['cur'][0] === 0 || count($data['queue'][0]) > 0) exec_prog($ins, 0, 1, $data);
    if ($data['cur'][1] === 0 || count($data['queue'][1]) > 0) exec_prog($ins, 1, 0, $data);
}

var_dump($data['runs'], $data['sent_count'][1]);
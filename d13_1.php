<?php

// $fw = [];
// $last_index = 0;
// $severity = 0;

// $lines = file('input_d13_1.txt', FILE_IGNORE_NEW_LINES);

// foreach ($lines as $line) {
//     $parts = explode(':', $line);

//     $last_index = intval(trim($parts[0]));

//     $fw[$last_index] = [
//         'depth' => intval(trim($parts[1])),
//         'cur'   => 0,
//         'down'  => true
//     ];
// }

// // Packet travelling
// foreach (range(0, $last_index) as $layer) {
//     // Only care if the firewall actually has the scanner at this layer
//     if (isset($fw[$layer])) {
//         if ($fw[$layer]['cur'] === 0) {
//             $severity += $layer * $fw[$layer]['depth'];
//         }
//     }

//     // At each layer that firewall has the scanner, it's always moving up/down
//     foreach ($fw as & $fw_layer) {
//         if ($fw_layer['cur'] === 0) {
//             $fw_layer['down'] = true;
//         } else if ($fw_layer['cur'] === $fw_layer['depth'] - 1) {
//             $fw_layer['down'] = false;
//         }

//         if ($fw_layer['down']) {
//             $fw_layer['cur']++;
//         } else {
//             $fw_layer['cur']--;
//         }
//     }
// }

// var_dump($severity);

// Yeah my friend helped me with this. My original solution is above. Pretty bad!
$depth = [];
$range = [];
$severity = 0;

$lines = file('input_d13_1.txt', FILE_IGNORE_NEW_LINES);

foreach ($lines as $line) {
    $parts = explode(':', $line);

    array_push($depth, intval(trim($parts[0])));
    array_push($range, intval(trim($parts[1])));
}

for ($i = 0; $i < count($depth); $i++) {
    if ($depth[$i] % (2 * ($range[$i] - 1)) === 0) {
        $severity += $depth[$i] * $range[$i];
    }
}

var_dump($severity);


<?php

echo "Enter number of elements: ";
$n = (int) trim(fgets(STDIN));

$arr = [];

echo "Enter the elements:\n";

for ($i = 0; $i < $n; $i++) {
    $arr[$i] = (int) trim(fgets(STDIN));
}

echo "Original Array:\n";
print_r($arr);

/* Selection Sort */

for ($i = 0; $i < $n - 1; $i++) {

    $min = $i;

    for ($j = $i + 1; $j < $n; $j++) {
        if ($arr[$j] < $arr[$min]) {
            $min = $j;
        }
    }

    $temp = $arr[$i];
    $arr[$i] = $arr[$min];
    $arr[$min] = $temp;
}

echo "Sorted Array:\n";
print_r($arr);

?>
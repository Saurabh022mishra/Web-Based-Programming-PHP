<?php

echo "How many elements you want to enter: ";
$n = (int) trim(fgets(STDIN));

$array = array();

echo "Enter $n elements:\n";

for ($i = 0; $i < $n; $i++) {
    $array[$i] = (int) trim(fgets(STDIN));
}

echo "\nOriginal Array:\n";
print_r($array);

/* Bubble Sort */
for ($i = 0; $i < $n - 1; $i++) {
    for ($j = 0; $j < $n - $i - 1; $j++) {
        if ($array[$j] > $array[$j + 1]) {
            $temp = $array[$j];
            $array[$j] = $array[$j + 1];
            $array[$j + 1] = $temp;
        }
    }
}

echo "\nSorted Array (Ascending Order):\n";
print_r($array);

?>
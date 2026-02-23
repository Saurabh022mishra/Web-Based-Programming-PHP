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
    echo "Pass " . ($i + 1) . ":\n";
    for ($j = 0; $j < $n - $i - 1; $j++) {
        echo "Comparing " . $array[$j] . " and " . $array[$j + 1] . "\n";
        echo "jvalue: " . $array[$j] . ", j+1 value: " . $array[$j + 1] . "\n";
        if ($array[$j] > $array[$j + 1]) {
            echo "Swapping " . $array[$j] . " and " . $array[$j + 1] . "\n";
            $temp = $array[$j];

            $array[$j] = $array[$j + 1];

            $array[$j + 1] = $temp;
        }
echo"\n";
    }
}

echo "\nSorted Array (Ascending Order):\n";
print_r($array);

?>
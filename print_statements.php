<?php
$a=10;
$b=20;
$array = array(1, 2, 3, 4, 5);
//printing variables using echo
echo "Value of a: " . $a . "\n"; // Output: Value of a: 10
echo "Value of b: " . $b . "\n"; // Output: Value of b: 20
//printing variables using print
print "Value of a: " . $a . "\n"; // Output: Value of a: 10
print "Value of b: " . $b . "\n"; // Output: Value of b: 20
//printing variables using printf
printf("Value of a: %d\n", $a); // Output: Value of a: 10
printf("Value of b: %d\n", $b); // Output: Value of b: 20
//printing variables using print_r
print_r($array); // Output: Array ( [0] => 1 [1] => 2 [2] => 3 [3] => 4 [4] => 5 )
//printing variables using var_dump
var_dump($array); // Output: array(5) { [0]=> int(1) [1]=> int(2) [2]=> int(3) [3]=> int(4) [4]=> int(5) }
?>
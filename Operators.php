<?php
// Arithmetic Operators
$a = 10;
$b = 5;
echo "Addition: " . ($a + $b) . "\n";
echo "Subtraction: " . ($a - $b) . "\n";
echo "Multiplication: " . ($a * $b) . "\n";
echo "Division: " . ($a / $b) . "\n";
echo "Modulus: " . ($a % $b) . "\n";

// Assignment Operators
$c = 15;
$c += 5;
echo "New value of c (after += 5): " . $c . "\n";

// Comparison Operators
$d = 20;
$e = 25;
echo "Is d equal to e? " . ($d == $e ? "Yes" : "No") . "\n";
echo "Is d not equal to e? " . ($d != $e ? "Yes" : "No") . "\n";

// Increment/Decrement Operators
$f = 30;
echo "Original value of f: " . $f . "\n";
echo "Post-increment: " . $f++ . "\n";
echo $f."\n"; // To show the updated value after post-increment
echo "Pre-increment: " . ++$f . "\n";
echo "Post-decrement: " . $f-- . "\n";
echo "Pre-decrement: " . --$f . "\n";

// Logical Operators
$g = true;
$h = false;
echo "AND Operator: " . ($g && $h ? "True" : "False") . "\n";
echo "OR Operator: " . ($g || $h ? "True" : "False") . "\n";
echo "NOT Operator: " . (!$g ? "True" : "False") . "\n";
?>
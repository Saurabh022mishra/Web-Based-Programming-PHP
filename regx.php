<?php
// Regular Expressions in PHP

// Example 1: Simple pattern matching
$pattern = "/hello/";
$string = "hello world";
if (preg_match($pattern, $string)) {
    echo "Pattern found!\n";
} else {
    echo "Pattern not found.\n";
}

// Example 2: Extracting matches
$pattern = "/(\d+)/";
$string = "There are 123 apples";
preg_match($pattern, $string, $a);
echo "First number found: " . $a[0] . "\n";

// Example 3: Replacing text
$pattern = "/apples/";
$replacement = "oranges";
$string = "I like apples";
$new_string = preg_replace($pattern, $replacement, $string);
echo "New string: " . $new_string . "\n";
//example 4: splitting a string
$pattern = "/,/";
$string = "apple,banana,cherry";
$fruits = preg_split($pattern, $string);
foreach ($fruits as $fruit) {
    echo "Fruit: " . $fruit . "\n";
}   
//validating an email address
$email = "test@example.com";
$pattern = "/^[a-zA-Z0-9._%+]+@[a-zA-Z0-9]+\.[a-zA-Z]{2,}$/";
if (preg_match($pattern, $email)) {
    echo "Valid email address.\n";
} else {
    echo "Invalid email address.\n";
}

?>
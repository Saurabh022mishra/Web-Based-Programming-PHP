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
$string = "There are 123 apples 444";
preg_match($pattern, $string, $matches);
echo "First number found: " . $matches[0] . "\n";

// Example 3: Replacing text
$pattern = "/apples/";
$replacement = "oranges";
$string = "I like apples";
$new_string = preg_replace($pattern, $replacement, $string);
echo "New string: " . $new_string . "\n";
?>
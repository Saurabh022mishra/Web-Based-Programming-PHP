<?php
// Conditional Statements in PHP
// 1. If statement
$age = 20;
if ($age >= 18) {
    echo "You are an adult.\n";
}
// 2. If-Else statement
$score = 85;
if ($score >= 90) {
    echo "Grade: A\n";
} else {
    echo "Grade: B\n";
}
// 3. If-Elseif-Else statement
$marks = 75;
if ($marks >= 90) {
    echo "Grade: A\n";
} elseif ($marks >= 80) {
    echo "Grade: B\n";  
} else {
    echo "Grade: C\n";
}
// 4. Switch statement
$day = "Monday";
switch ($day) {
    case "Monday":
        echo "Today is Monday.\n";
        break;
    case "Tuesday":
        echo "Today is Tuesday.\n";
        break;
    case "Wednesday":
        echo "Today is Wednesday.\n";
        break;
    default:
        echo "Today is not Monday, Tuesday, or Wednesday.\n";
        break;  
}
?>
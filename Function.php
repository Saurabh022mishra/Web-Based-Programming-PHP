//Write a program to show the application of user defined functions
<?php
function greet($name) {
    return "Hello, $name!";
}
echo "Enter your name: ";
$name = trim(fgets(STDIN));
$message = greet($name);
echo $message . "\n";
?>
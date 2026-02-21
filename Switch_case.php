//Write a program to create a calculator program and show the usage of switch-case.
<?php
echo "Menu:\n";
echo "1. Addition\n";
echo "2. Subtraction\n";
echo "3. Multiplication\n";
echo "Enter your choice: ";
$choice = trim(fgets(STDIN));

echo "Enter first number: ";
$num1 = trim(fgets(STDIN));
echo "Enter second number: ";
$num2 = trim(fgets(STDIN));

switch ($choice) {
    case 1:
        $result = $num1 + $num2;
        echo "Result: " . $result . "\n";
        break;
    case 2:
        $result = $num1 - $num2;
        echo "Result: " . $result . "\n";
        break;
    case 3:
        $result = $num1 * $num2;
        echo "Result: " . $result . "\n";
        break;
    default:
        echo "Invalid choice\n";
}
?>
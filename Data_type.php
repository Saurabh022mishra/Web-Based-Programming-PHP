<?php
// Data types in PHP
// 1. String
$name = "John Doe";
// 2. Integer
$age = 30;
// 3. Float (or Double)
$height = 5.9;
// 4. Boolean
$is_student = true;
// 5. Array
$fruits = array("Apple", "Banana", "Cherry");
// 6. Object
class Car {
    public $make;
    public $model;
    public function __construct($make, $model) {
        $this->make = $make;
        $this->model = $model;
    }
}
$myCar = new Car("Toyota", 2011);
// 7. NULL
$empty_value = NULL;
// Displaying the data types
echo "Name: " . $name . " (Type: " . gettype($name) . ")\n";
echo "Age: " . $age . " (Type: " . gettype($age) . ")\n";
echo "Height: " . $height . " (Type: " . gettype($height) . ")\n";
echo "Is Student: " . ($is_student ? "Yes" : "No") . " (Type: " . gettype($is_student) . ")\n";
echo "Fruits: " . implode(", ", $fruits) . " (Type: " . gettype($fruits) . ")\n";
echo "Car: " . $myCar->make . " " . $myCar->model . " (Type: " . gettype($myCar) . ")\n";
echo "Empty Value: " . $empty_value . " (Type: " . gettype($empty_value) . ")\n";
printf(("Name: %s (Type: %s)\n"), $name, gettype($name));

?>
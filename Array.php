<?php
//indexed array
$num=[7,6,8,4,9,2,3,5,1];
$fruits = array("apple", "banana", "cherry");
echo "First fruit: " . $fruits[0] . "\n"; // Output: apple  
//associative array
$person = array("name" => "John", "age" => 30, "city" => "New York");
echo "Name: " . $person["name"] . "\n"; // Output: John
//multidimensional array
$matrix = array(
    array(1, 2, 3),
    array(4, 5, 6),
    array(7, 8, 9));
echo "Element at (1,2): " . $matrix[1][2] . "\n"; // Output: 6
//array functions
$numbers = array(1, 2, 3, 4, 5);
$sum = array_sum($numbers);
echo "Sum of numbers: " . $sum . "\n"; // Output: 15
// adding elements to an array
$fruits[] = "orange"; // adds "orange" to the end of the $fruits array
print_r($fruits); // Output: Array ( [0] => apple [1] => banana [2] => cherry [3] => orange )
array_push($fruits, "grape"); // adds "grape" to the end of the $fruits array
print_r($fruits); // Output: Array ( [0] => apple [1] => banana [2] => cherry [3] => orange [4] => grape )
// removing elements from an array
array_pop($fruits); // removes the last element ("grape") from the $fruits array
print_r($fruits); // Output: Array ( [0] => apple [1] => banana [2] => cherry [3] => orange )
array_shift($fruits); // removes the first element ("apple") from the $fruits array
print_r($fruits); // Output: Array ( [0] => banana [1] => cherry [2] => orange )    
/*sort($num); // sorts the $num array in ascending order
print_r($num); // Output: Array ( [0] => 1 [1] => 2 [2] => 3 [3] => 4 [4] => 5 [5] => 6 [6] => 7 [7] => 8 [8] => 9 )
rsort($num); // sorts the $num array in descending order
print_r($num); // Output: Array ( [0] => 9 [1] => 8 [2] => 7 [3] => 6 [4] => 5 [5] => 4 [6] => 3 [7] => 2 [8] => 1 )
echo "Is banana in the fruits array? " . (in_array("banana", $fruits) ? "Yes" : "No") . "\n"; // Output: Yes
*/
?>
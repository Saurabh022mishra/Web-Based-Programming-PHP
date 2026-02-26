<?php

$name = $_POST['name'];
$password = $_POST['password'];
$gender = $_POST['gender'];
$city = $_POST['city'];
$message = $_POST['message'];

echo "Name: $name <br>";
echo "Password: $password <br>";
echo "Gender: $gender <br>";
echo "City: $city <br>";
echo "Message: $message <br>";

echo "Hobbies: <br>";
if (!empty($_POST['hobby'])) {
    foreach ($_POST['hobby'] as $h) {
        echo $h . "<br>";
    }
}

?>
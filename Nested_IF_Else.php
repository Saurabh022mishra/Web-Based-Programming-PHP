<?php
$age = 20;
$gender = "male";

if ($age >= 18) {
    if ($gender == "male") {
        echo "You are an adult male.";
    } else {
        echo "You are an adult female.";
    }
} else {
    if ($gender == "male") {
        echo "You are a young male.";
    } else {
        echo "You are a young female.";
    }
}
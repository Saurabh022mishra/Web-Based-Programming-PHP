<?php
// Write to a file
file_put_contents("data.txt", "First line\nSecond line\nThird line");

// Read from the file
$content = file_get_contents("data.txt");
echo ($content); 
?>

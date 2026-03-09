<?php
// Open file for writing
$file = fopen("example.txt", "w");

if ($file) {
    // Write content to the file
    fwrite($file, "Hello, world!");

    // Close the file after writing
    fclose($file);
    echo "File written successfully.";
} else {
    echo "Failed to open the file.";
}
?>

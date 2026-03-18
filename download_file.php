<?php
$file = 'my_directory/example.txt';

if (file_exists($file)) {
    header('Content-Type: text/plain');
    header('Content-Disposition: attachment; 
    filename="' . basename($file) . '"');
    header('Content-Length: ' . filesize($file));
    readfile($file);
    exit;
} else {
    echo "File not found.";
}
?>

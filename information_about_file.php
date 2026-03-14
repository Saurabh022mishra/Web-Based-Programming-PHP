<?php
$file = "example.txt";

if (file_exists($file)) {
    echo "File size: " . filesize($file) . " bytes \n";
    echo "Last modified: " . date("F d Y H:i:s.", filemtime($file)) ;
} else {
    echo "File does not exist.";
}
?>

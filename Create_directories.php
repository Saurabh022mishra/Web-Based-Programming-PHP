<?php
// Create a directory
if (!file_exists('my_directory')) {
    mkdir('my_directory', 0777, true);
    echo "Directory created.";
}

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["file"])) {

    $file = $_FILES["file"];

    $target_path = "my_directory/" . basename($file["name"]);

    if (move_uploaded_file($file["tmp_name"], $target_path)) {

        echo "File uploaded successfully!";
    } else {

        echo "File upload failed.";
    }
}

?>

<form action="" method="POST" enctype="multipart/form-data">

    Select a file to upload: <input type="file" name="file">

    <input type="submit" value="Upload File">

</form>
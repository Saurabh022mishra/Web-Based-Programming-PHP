<?php
if(isset($_POST['submit'])) {
    $name = $_POST['student_name'];

    // Create Cookie (valid for 1 hour)
    setcookie("student", $name, time() + 3600);

    // Redirect to same page to read cookie
    header("Location: cookies.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Cookie Example</title>
</head>
<body>

<h2>Student Cookie Example</h2>

<?php
if(isset($_COOKIE['student'])) {
    echo "<h3>Welcome " . $_COOKIE['student'] . "</h3>";
    echo "<a href='deleting_cookies.php'>Delete Cookie</a>";
} else {
?>

<form method="post">
    Enter Student Name:
    <input type="text" name="student_name" required>
    <input type="submit" name="submit" value="Submit">
</form>

<?php } ?>

</body>
</html>
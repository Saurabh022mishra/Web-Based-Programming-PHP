<?php
setcookie("student", "", time() - 3600);
header("Location: cookies.php");
exit();
?>
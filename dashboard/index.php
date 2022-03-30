<?php
session_start();
$_SESSION['username'] = $username;
$picture = $_SESSION['picture'];
$fullname = $_SESSION['fullname'];
$user = $_SESSION['user'];
if ($fullname == "" || $picture == "" || $user == "") {
    header("location: ../");
}
else {
    header("location: dashboard.php");
}
?>
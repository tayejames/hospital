<?php
$con = mysqli_connect("localhost","root","","hospital");
if (!$con) {
	echo("<script>alert('DATABASE ERROR: Database not connected!')</script>");
	exit();
}
?>
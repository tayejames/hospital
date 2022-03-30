<?php
include '../dbconnect.php';
$dept = $_POST["dept"];
$staff = $con->query("SELECT * FROM staffs WHERE dept = $dept");
echo "<option value=\"\" selected disabled>Select Doctor</option>";
if ($staff->num_rows > 0) {
    while ($row = $staff->fetch_assoc()) {
        $fnam = $row['fnam'];
        $lnam = $row['lnam'];
        $cid = $row['uid'];
        $name = "Dr. " . $fnam . " ". $lnam;
        echo ("<option value=\"$cid\">$name</option>");
    }
}
?>
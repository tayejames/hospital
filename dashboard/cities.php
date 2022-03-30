<?php
include '../dbconnect.php';
$state_id = $_POST["state_id"];
$state = $con->query("SELECT * FROM cities WHERE state_id = $state_id");
echo "<option value=\"\" selected disabled>Select City</option>";
if ($state->num_rows > 0) {
    while ($row = $state->fetch_assoc()) {
        $name = $row['name'];
        $cid = $row['id'];
        echo ("<option value=\"$cid\">$name</option>");
    }
}
?>
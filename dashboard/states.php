<?php
include '../dbconnect.php';
$country_id = $_POST["country_id"];
$state = $con->query("SELECT * FROM states WHERE country_id = $country_id");
echo "<option value=\"\" selected disabled>Select State</option>";
if ($state->num_rows > 0) {
    while ($row = $state->fetch_assoc()) {
        $name = $row['name'];
        $cid = $row['id'];
        echo ("<option value=\"$cid\">$name</option>");
    }
}
?>
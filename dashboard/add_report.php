<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>
        <div class="page-wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <h4 class="page-title">Write Report</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <form method="POST">
<?php
$apt = $_GET['xxyzz'];
$uid = $_SESSION['uid'];
include '../dbconnect.php';
$patient = $con->query("SELECT * FROM appointments WHERE apt = '$apt'");
if ($patient) {
    $row = $patient->fetch_assoc();
    $ap = $row['apt'];
    $patient_id = $row['uid'];
    $staff = $row['staff'];
    $datee = $row['datee'];
    $descript = $row['descript'];
    $flnam1 = flnam($uid);
    echo "                  <div class=\"row\">
                                <div class=\"col-md-6\">
                                    <div class=\"form-group\">
                                        <label>Fullname: $flnam1</label>
                                        
                                    </div>
                                </div>
                                <div class=\"col-md-6\">
                                    <div class=\"form-group\">
                                        <label>Patient ID: <a target=\"_blank\" href=\"profile.php?xyyz=$uid\">$patient_id</a></label>
                                    </div>
                                </div>
                            </div>";
}

$sql = $con->query("SELECT * FROM reports WHERE uid = '$uid' ORDER BY id DESC LIMIT 1");
if ($sql->num_rows > 0) {
    echo "                  <div class=\"col-md-12\">
                                <div class=\"table-responsive\">
                                    <label>Last Checkup</label>
                                    <table class=\"table table-striped custom-table\">
                                        <thead>
                                            <tr>
                                                <th>Appointment ID</th>
                                                <th>Complain</th>
                                                <th>Report</th>
                                                <th>Appointment Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>";
    while ($row = $sql->fetch_assoc()) {
        $ap = $row['apt'];
        $date = $row['datee'];
        $complain = $row['complaint'];
        $report = $row['report'];
        $flnam = flnam($uid);
        echo"                               <tr>
                                                <td>$ap</td>
                                                <td>$complain</td>
                                                <td>$report</td>
                                                <td>$date</td>
                                            </tr>";
    }
    echo"                               </tbody>
                                    </table>
                                </div>
                            </div>";
}


function flnam($flnam) {
    include '../dbconnect.php';
    $sqli = $con->query("SELECT * FROM patients WHERE uid = '$flnam'");
    if ($sqli) {
        $row = $sqli->fetch_assoc();
        $fnam = $row['fnam'];
        $lnam = $row['lnam'];
        $flnam = $fnam . " " . $lnam;
        return $flnam;
    }
}
?>
                            <input class="form-control" name="apt" type="text" value="<?php echo($apt); ?>" hidden readonly="">
                            <input class="form-control" name="uid" type="text" value="<?php echo($patient_id); ?>" hidden readonly="">
                            <input class="form-control" name="staff" type="text" value="<?php echo($user); ?>" hidden readonly="">
                            
                            
                                            
                            <div class="form-group">
                                <label>Customer Complain</label>
                                <textarea cols="30" rows="4" name="complain" class="form-control"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Report/Prescription</label>
                                <textarea cols="30" rows="4" name="report" class="form-control"></textarea>
                            </div>
                            <div class="m-t-20 text-center">
                                <button name="submit" class="btn btn-primary submit-btn">Save Report</button>
                            </div>
                        </form>
<?php
if (isset($_POST['submit'])) {
    $apt = $_POST['apt'];
    $uid = $_POST['uid'];
    $complain = $_POST['complain'];
    $report = $_POST['report'];
    $date = date("Y-m-d");
    include '../dbconnect.php';
    $sql = $con->query("INSERT INTO reports (apt, uid, staff, complaint, report, datee) VALUES ('$apt', '$uid', '$user', '$complain', '$report', '$date')");
    if ($sql) {
        $update = $con->query("UPDATE appointments SET status = 'Inactive' WHERE apt = '$apt'");
        if ($update) {
            echo("<script>alert('Success!'); window.location.href = 'dashboard.php'</script>");
        }
    }
    else {
        echo("<script>alert('Fail!')</script>");
    }
}
?>
                    </div>
                </div>
            </div>
<?php include 'notification_box.php'; ?>
        </div>
    </div>
    <div class="sidebar-overlay" data-reff=""></div>
    <script src="assets/js/jquery-3.2.1.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.slimscroll.js"></script>
    <script src="assets/js/select2.min.js"></script>
    <script src="assets/js/app.js"></script>
</body>


<!-- add-department24:07-->
</html>

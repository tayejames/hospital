<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>
        <div class="page-wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-sm-4 col-3">
                        <h4 class="page-title">Patients</h4>
                    </div>
                </div>
                <div class="row filter-row">
                	<form method="POST">
	                    <div class="col-sm-12 col-md-12">
	                        <div class="form-group form-focus">
	                            <label class="focus-label">Employee ID</label>
	                            <input type="text" name="eid" class="form-control floating">
	                        	<button name="submit" class="btn btn-success"> Search </button>
	                        </div>
	                    </div>
                	</form>
                </div>
				<div class="row">
					<div class="col-md-12">
						<div class="table-responsive">
<?php
if (isset($_POST['submit'])) {
	$eid = $_POST['eid'];
	include '../dbconnect.php';
	$sqli = $con->query("SELECT * FROM patients WHERE uid = '$eid'");
	if ($sqli->num_rows > 0) {
		$row = $sqli->fetch_assoc();
		$uid = $row['uid'];
		$fnam = $row['fnam'];
        $lnam = $row['lnam'];
        $address = $row['address'];
        $email = $row['email'];
        $dob = strtotime($row['dob']);
        $pno = $row['pno'];
        $img = $row['img'];
        $flnam = $fnam . " " . $lnam;
        $photo = 'img/' . $img;
        $date = strtotime(date("Y-m-d"));
        $abs = abs($date - $dob);
        $age = round($abs / 31536000);
        $status = $row['status'];
        if ($status == "Pending") {
        	$action = "<td class=\"text-right\">
											<div class=\"dropdown dropdown-action\">
												<a href=\"#\" class=\"action-icon dropdown-toggle\" data-toggle=\"dropdown\" aria-expanded=\"false\"><i class=\"fa fa-ellipsis-v\"></i></a>
												<div class=\"dropdown-menu dropdown-menu-right\">
													<a class=\"dropdown-item\" href=\"#\" data-toggle=\"modal\" data-target=\"#delete_patient\"><i class=\"fa fa-pencil m-r-5\"></i> Approve</a>
												</div>
											</div>
										</td>";
        }
        else {
        	$action = "";
        }
		echo "					<table class=\"table table-border table-striped custom-table datatable mb-0\">
								<thead>
									<tr>
										<th>Patient ID</th>
										<th>Name</th>
										<th>Age</th>
										<th>Address</th>
										<th>Phone</th>
										<th>Email</th>
										<th class=\"text-right\">Action</th>
									</tr>
								</thead>
								<tbody>
								<tr>
										<td><a target='_blank' href='profile.php?xyyz=$uid'>$uid</a></td>
										<td><img width=\"28\" height=\"28\" src=\"$photo\" class=\"rounded-circle m-r-5\" alt=\"\"> $flnam</td>
										<td>$age</td>
										<td>$address</td>
										<td>$pno</td>
										<td>$email</td>
										$action
									</tr>
								</tbody>
							</table>";

	}
}
else {

?>
<?php
$sn = 0;
include '../dbconnect.php';
$sql = $con->query("SELECT * FROM patients");
if ($sql->num_rows > 0) {
	echo "					<table class=\"table table-border table-striped custom-table datatable mb-0\">
								<thead>
									<tr>
										<th>SN</th>
										<th>Patient ID</th>
										<th>Name</th>
										<th>Age</th>
										<th>Address</th>
										<th>Phone</th>
										<th>Email</th>
										<th class=\"text-right\">Action</th>
									</tr>
								</thead>
								<tbody>";
	while ($row = $sql->fetch_assoc()) {
		$uid = $row['uid'];
		$fnam = $row['fnam'];
        $lnam = $row['lnam'];
        $address = $row['address'];
        $email = $row['email'];
        $dob = strtotime($row['dob']);
        $pno = $row['pno'];
        $img = $row['img'];
        $flnam = $fnam . " " . $lnam;
        $photo = 'img/' . $img;
        $date = strtotime(date("Y-m-d"));
        $abs = abs($date - $dob);
        $age = round($abs / 31536000);
        $status = $row['status'];
        $sn += 1;
        if ($status == "Pending") {
        	$action = "<td class=\"text-right\">
											<div class=\"dropdown dropdown-action\">
												<a href=\"#\" class=\"action-icon dropdown-toggle\" data-toggle=\"dropdown\" aria-expanded=\"false\"><i class=\"fa fa-ellipsis-v\"></i></a>
												<div class=\"dropdown-menu dropdown-menu-right\">
													<a class=\"dropdown-item\" href=\"#\" data-toggle=\"modal\" data-target=\"#delete_patient\"><i class=\"fa fa-pencil m-r-5\"></i> Approve</a>
												</div>
											</div>
										</td>";
        }
        /*elseif ($status == "Register") {
        	$action = "";
        }*/
        else {
        	$action = "";
        }
        echo "						<tr>
										<td>$sn</td>
										<td><a target='_blank' href='profile.php?xyyz=$uid'>$uid</a></td>
										<td><img width=\"28\" height=\"28\" src=\"$photo\" class=\"rounded-circle m-r-5\" alt=\"\"> $flnam</td>
										<td>$age</td>
										<td>$address</td>
										<td>$pno</td>
										<td>$email</td>
										$action
									</tr>";
	}
	echo "						</tbody>
							</table>";
}
?>
<?php
}
?>
						</div>
					</div>

                </div>
            </div>
<?php include 'notification_box.php'; ?>
        </div>
		<div id="delete_patient" class="modal fade delete-modal" role="dialog">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-body text-center">
						<img src="assets/img/sent.png" alt="" width="50" height="46">
						<h3>Are you sure want to Approve this Patient?<?php echo($uid); ?></h3>
                        <form method="POST">
                            <div class="m-t-20"> <a href="#" class="btn btn-white" data-dismiss="modal">Close</a>
                                <input type="text" name="uid" value="<?php echo($uid); ?>" hidden readonly>
                                <button type="submit" name="delete" class="btn btn-info">Approve</button>
                            </div>
                        </form>
<?php
if (isset($_POST['delete'])) {
    $uid = $_POST['uid'];
    include '../dbconnect.php';
    $sql = $con->query("UPDATE patients SET status = 'Approve' WHERE uid = '$uid'");
    if ($sql) {
        echo("<script>alert('Success!'); window.location.href = 'dashboard.php'</script>");
    }
}
?>
					</div>
				</div>
			</div>
			
		</div>
    </div>
    <div class="sidebar-overlay" data-reff=""></div>
    <script src="assets/js/jquery-3.2.1.min.js"></script>
	<script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.slimscroll.js"></script>
    <script src="assets/js/select2.min.js"></script>
    <script src="assets/js/jquery.dataTables.min.js"></script>
    <script src="assets/js/dataTables.bootstrap4.min.js"></script>
    <script src="assets/js/moment.min.js"></script>
    <script src="assets/js/bootstrap-datetimepicker.min.js"></script>
    <script src="assets/js/app.js"></script>
</body>


<!-- patients23:19-->
</html>
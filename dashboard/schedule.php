<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>
        <div class="page-wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-sm-4 col-3">
                        <h4 class="page-title">Schedule</h4>
                    </div>
                    <div class="col-sm-8 col-9 text-right m-b-20">
                        <a href="add_schedule.php" class="btn btn btn-primary btn-rounded float-right"><i class="fa fa-plus"></i> Add Schedule</a>
                    </div>
                </div>
				<div class="row">
					<div class="col-md-12">
						<div class="table-responsive">
<?php
$sn = 0;
include '../dbconnect.php';
$sql = $con->query("SELECT * FROM schedules");
if ($sql->num_rows > 0) {
	echo "					<table class=\"table table-border table-striped custom-table mb-0\">
								<thead>
									<tr>
										<th>S/N</th>
										<th>Doctor Name</th>
										<th>Department</th>
										<th>Available Week</th>
										<th>Available Time</th>
										<th>Status</th>
										<th class=\"text-right\">Action</th>
									</tr>
								</thead>
								<tbody>";
	while ($row = $sql->fetch_assoc()){
		$dept = $row['dept'];
		$staff = $row['staff'];
		$days = $row['days'];
		$duty = $row['duty'];
		$dept = dept($dept);
		$status = $row['status'];
		$photo = photo($staff);
		$name = name($staff);
		$on = $duty[0] . $duty[1] . $duty[2] . $duty[3] . $duty[4] . $duty[5] . $duty[6];
    	$off = $duty[8] . $duty[9] . $duty[10] . $duty[11] . $duty[12] . $duty[13] . $duty[14];
    	$duty = $on . " - " . $off;
		$sn += 1;
		if ($status == "Active") {
            $badge = "custom-badge status-green";
        }
        else {
            $badge = "custom-badge status-red";
        }
		echo "						<tr>
										<td>$sn</td>
										<td><img width=\"28\" height=\"28\" src=\"$photo\" class=\"rounded-circle m-r-5\" alt=\"\">Dr. $name</td>
										<td>$dept</td>
										<td>$days</td>
										<td>$duty</td>
										<td><span class=\"$badge\">$status</span></td>
										<td class=\"text-right\">
											<div class=\"dropdown dropdown-action\">
												<a href=\"#\" class=\"action-icon dropdown-toggle\" data-toggle=\"dropdown\" aria-expanded=\"false\"><i class=\"fa fa-ellipsis-v\"></i></a>
												<div class=\"dropdown-menu dropdown-menu-right\">
													<a class=\"dropdown-item\" href=\"edit_schedule.php?xxyz=$staff\"><i class=\"fa fa-pencil m-r-5\"></i> Edit</a>
													<a class=\"dropdown-item\" href=\"#\" data-toggle=\"modal\" data-target=\"#delete_schedule\"><i class=\"fa fa-trash-o m-r-5\"></i> Delete</a>
												</div>
											</div>
										</td>
									</tr>";
	}
	echo "						</tbody>
							</table>";
}
else {
    echo("No data");
}


function dept($dept) {
	include '../dbconnect.php';
	$dept = $con->query("SELECT name FROM departments WHERE id = $dept");
	if ($dept->num_rows) {
		$row = $dept->fetch_assoc();
		$name = $row['name'];
		return $name;
	}
}

function photo($photo) {
	include '../dbconnect.php';
	$search = $con->query("SELECT img FROM staffs WHERE uid = '$photo'");
	if ($search) {
		$row = $search->fetch_assoc();
		$img = $row['img'];
		$photo = 'img/' . $img;
		return $photo;
	}
}

function name($name) {
	include '../dbconnect.php';
	$search = $con->query("SELECT fnam, lnam FROM staffs WHERE uid = '$name'");
	if ($search) {
		$row = $search->fetch_assoc();
		$fnam = $row['fnam'];
		$lnam = $row['lnam'];
		$flnam = $fnam . ' ' . $lnam;
		return $flnam;
	}
}
?>
						</div>
                </div>
                </div>
            </div>
<?php include 'notification_box.php'; ?>
        </div>
		<div id="delete_schedule" class="modal fade delete-modal" role="dialog">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-body text-center">
						<img src="assets/img/sent.png" alt="" width="50" height="46">
						<h3>Are you sure want to delete this Schedule?</h3>
						<form method="POST">
                            <div class="m-t-20"> <a href="#" class="btn btn-white" data-dismiss="modal">Close</a>
                                <input type="text" name="staff" value="<?php echo($staff); ?>" hidden readonly>
                                <button type="submit" name="delete" class="btn btn-danger">Delete</button>
                            </div>
                        </form>
<?php
if (isset($_POST['delete'])) {
    $staff = $_POST['staff'];
    include '../dbconnect.php';
    $sql = $con->query("DELETE FROM schedules WHERE staff = '$staff'");
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
    </div>
    <div class="sidebar-overlay" data-reff=""></div>
    <script src="assets/js/jquery-3.2.1.min.js"></script>
	<script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.slimscroll.js"></script>
    <script src="assets/js/select2.min.js"></script>
    <script src="assets/js/moment.min.js"></script>
    <script src="assets/js/bootstrap-datetimepicker.min.js"></script>
    <script src="assets/js/app.js"></script>
</body>


<!-- schedule23:21-->
</html>
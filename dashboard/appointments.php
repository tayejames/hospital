<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>
        <div class="page-wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-sm-4 col-3">
                        <h4 class="page-title">Appointments</h4>
                    </div>
                    <?php if ($username == 8): ?>
	                    <div class="col-sm-8 col-9 text-right m-b-20">
	                        <a href="add_appointment.php" class="btn btn btn-primary btn-rounded float-right"><i class="fa fa-plus"></i> Add Appointment</a>
	                    </div>
                    <?php endif ?>
                </div>
				<div class="row">
					<div class="col-md-12">
						<div class="table-responsive">
<?php
$sn = 0;
include '../dbconnect.php';
if ($username == "admin") {
	$sql = $con->query("SELECT * FROM appointments WHERE status = 'Active'");
	if ($sql->num_rows > 0) {
		echo "					<table class=\"table table-striped custom-table\">
									<thead>
										<tr>
											<th>S/N</th>
											<th>Appointment ID</th>
											<th>Patient Name</th>
											<th>Doctor Name</th>
											<th>Description</th>
											<th>Appointment Date</th>
											<th>Appointment Time</th>
											<th>Status</th>
										</tr>
									</thead>
									<tbody>";
		while ($row = $sql->fetch_assoc()) {
			$apt = $row['apt'];
			$uid = $row['uid'];
			$staff = $row['staff'];
			$atime = $row['atime'];
			$datee = $row['datee'];
			$timee = $row['timee'];
			$descript = $row['descript'];
			$status = $row['status'];
			$pat = patient($uid);
			$stff = staff($staff);
			$ttime = 20;
			$ime = $atime[3] . $atime[4];
			$me = $ttime + $ime;
			$apttme = $atime . " - " . $atime[0] . $atime[1] . $atime[2] . $me;
			$sn += 1;
			if ($status == "Active") {
	            $badge = "custom-badge status-green";
	        }
	        else {
	            $badge = "custom-badge status-red";
	        }
			echo "						<tr>
											<td>$sn</td>
											<td>$apt</td>
											<td><img width=\"28\" height=\"28\" src=\"assets/img/user.jpg\" class=\"rounded-circle m-r-5\" alt=\"\"> $pat</td>
											<td>$stff</td>
											<td>$descript</td>
											<td>$datee</td>
											<td>$apttme</td>
											<td><span class=\"$badge\">$status</span></td>
										</tr>";
		}
	}
	echo "							</tbody>
								</table>";
}
elseif ($username == 8) {
	$sql = $con->query("SELECT * FROM appointments WHERE uid = '$user'");
	if ($sql->num_rows > 0) {
		echo "					<table class=\"table table-striped custom-table\">
									<thead>
										<tr>
											<th>S/N</th>
											<th>Appointment ID</th>
											<th>Doctor Name</th>
											<th>Description</th>
											<th>Appointment Date</th>
											<th>Appointment Time</th>
											<th>Status</th>
										</tr>
									</thead>
									<tbody>";
		while ($row = $sql->fetch_assoc()) {
			$apt = $row['apt'];
			$staff = $row['staff'];
			$datee = $row['datee'];
			$timee = $row['timee'];
			$descript = $row['descript'];
			$status = $row['status'];
			$stff = staff($staff);
			$sn += 1;
			if ($status == "Active") {
	            $badge = "custom-badge status-green";
	        }
	        else {
	            $badge = "custom-badge status-red";
	        }
			echo "						<tr>
											<td>$sn</td>
											<td>$apt</td>
											<td>$stff</td>
											<td>$descript</td>
											<td>$datee</td>
											<td>$timee</td>
											<td><span class=\"$badge\">$status</span></td>
										</tr>";
		}
	}
	echo "							</tbody>
								</table>";
}
else {
	$sql = $con->query("SELECT * FROM appointments WHERE staff = '$user'");
	if ($sql->num_rows > 0) {
		echo "					<table class=\"table table-striped custom-table\">
									<thead>
										<tr>
											<th>S/N</th>
											<th>Appointment ID</th>
											<th>Patient Name</th>
											<th>Description</th>
											<th>Appointment Date</th>
											<th>Appointment Time</th>
											<th>Status</th>
										</tr>
									</thead>
									<tbody>";
		while ($row = $sql->fetch_assoc()) {
			$apt = $row['apt'];
			$uid = $row['uid'];
			$datee = $row['datee'];
			$timee = $row['timee'];
			$descript = $row['descript'];
			$status = $row['status'];
			$pat = patient($uid);
			$_SESSION['uid'] = $uid;
			$sn += 1;
			if ($status == "Active") {
	            $badge = "custom-badge status-green";
	            $action = "<td class=\"text-right\">
												<div class=\"dropdown dropdown-action\">
													<a href=\"#\" class=\"action-icon dropdown-toggle\" data-toggle=\"dropdown\" aria-expanded=\"false\"><i class=\"fa fa-ellipsis-v\"></i></a>
													<div class=\"dropdown-menu dropdown-menu-right\">
														<a class=\"dropdown-item\" href=\"add_report.php?xxyzz=$apt\"><i class=\"fa fa-pencil m-r-5\"></i> Write report</a>
													</div>
												</div>
											</td>";
	        }
	        else {
	            $badge = "custom-badge status-red";
	            $action = "";
	        }
			echo "						<tr>
											<td>$sn</td>
											<td>$apt</td>
											<td><img width=\"28\" height=\"28\" src=\"assets/img/user.jpg\" class=\"rounded-circle m-r-5\" alt=\"\"> $pat</td>
											<td>$descript</td>
											<td>$datee</td>
											<td>$timee</td>
											<td><span class=\"$badge\">$status</span></td>
											$action
										</tr>";
		}

	}
	echo "							</tbody>
								</table>";
}

function staff($stff) {
	include '../dbconnect.php';
	$sq = $con->query("SELECT fnam, lnam FROM staffs WHERE uid = '$stff'");
	if ($sq->num_rows > 0) {
		$row = $sq->fetch_assoc();
		$fnam = $row['fnam'];
		$lnam = $row['lnam'];
		$flnam = $fnam . " " . $lnam;
		return $flnam;
	}
}


function patient($pat) {
	include '../dbconnect.php';
	$sq = $con->query("SELECT fnam, lnam FROM patients WHERE uid = '$pat'");
	if ($sq->num_rows > 0) {
		$row = $sq->fetch_assoc();
		$fnam = $row['fnam'];
		$lnam = $row['lnam'];
		$flnam = $fnam . " " . $lnam;
		return $flnam;
	}
}
?>
						</div>
					</div>
                </div>
            </div>
<?php include 'notification_box.php'; ?>
			<div id="delete_appointment" class="modal fade delete-modal" role="dialog">
				<div class="modal-dialog modal-dialog-centered">
					<div class="modal-content">
						<div class="modal-body text-center">
							<img src="assets/img/sent.png" alt="" width="50" height="46">
							<h3>Are you sure want to delete this Appointment?</h3>
							<div class="m-t-20"> <a href="#" class="btn btn-white" data-dismiss="modal">Close</a>
								<button type="submit" class="btn btn-danger">Delete</button>
							</div>
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
    <script src="assets/js/app.js"></script>
	<script>
            $(function () {
                $('#datetimepicker3').datetimepicker({
                    format: 'LT'
                });
				$('#datetimepicker4').datetimepicker({
                    format: 'LT'
                });
            });
     </script>
</body>


<!-- appointments23:20-->
</html>
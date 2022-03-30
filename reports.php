<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>
        <div class="page-wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-sm-4 col-3">
                        <h4 class="page-title">Medical Report</h4>
                    </div>
                    <?php if ($username != "PATIE" || $username != "admin"): ?>
	                    <div class="col-sm-8 col-9 text-right m-b-20">
	                        <a href="add_report.php" class="btn btn btn-primary btn-rounded float-right"><i class="fa fa-plus"></i> Add Report</a>
	                    </div>
                    <?php endif ?>
                </div>
				<div class="row">
					<div class="col-md-12">
						<div class="table-responsive">
<?php
$sn = 0;
include '../dbconnect.php';
$sql = $con->query("SELECT * FROM reports");
if ($sql->num_rows > 0) {
	if ($username == "admin") {
		echo "					<table class=\"table table-striped custom-table\">
									<thead>
										<tr>
											<th>S/N</th>
											<th>Appointment ID</th>
											<th>Patient Name</th>
											<th>Doctor Name</th>
											<th>Medical Report</th>
											<th>Date</th>
										</tr>
									</thead>
									<tbody>";
		while ($row = $sql->fetch_assoc()) {
			$apt = $row['apt'];
			$uid = $row['uid'];
			$staff = $row['staff'];
			$datee = $row['datee'];
			$reports = $row['reports'];
			$pat = patient($uid);
			$stff = staff($staff);
			$sn += 1;
			echo "						<tr>
											<td>$sn</td>
											<td>$apt</td>
											<td><img width=\"28\" height=\"28\" src=\"assets/img/user.jpg\" class=\"rounded-circle m-r-5\" alt=\"\"> $pat</td>
											<td>$stff</td>
											<td>$reports</td>
											<td>$datee</td>
										</tr>";
		}
	}
	elseif ($username == "PATIE") {
		echo "					<table class=\"table table-striped custom-table\">
									<thead>
										<tr>
											<th>S/N</th>
											<th>Appointment ID</th>
											<th>Doctor Name</th>
											<th>Medical Report</th>
											<th>Date</th>
										</tr>
									</thead>
									<tbody>";
		while ($row = $sql->fetch_assoc()) {
			$apt = $row['apt'];
			$staff = $row['staff'];
			$datee = $row['datee'];
			$reports = $row['reports'];
			$stff = staff($staff);
			$sn += 1;
			echo "						<tr>
											<td>$sn</td>
											<td>$apt</td>
											<td>$stff</td>
											<td>$reports</td>
											<td>$datee</td>
										</tr>";
		}
	}
	else {
		echo "					<table class=\"table table-striped custom-table\">
									<thead>
										<tr>
											<th>S/N</th>
											<th>Appointment ID</th>
											<th>Patient Name</th>
											<th>Medical Report</th>
											<th>Date</th>
										</tr>
									</thead>
									<tbody>";
		while ($row = $sql->fetch_assoc()) {
			$apt = $row['apt'];
			$uid = $row['uid'];
			$datee = $row['datee'];
			$reports = $row['reports'];
			$pat = patient($uid);
			$sn += 1;
			echo "						<tr>
											<td>$sn</td>
											<td>$apt</td>
											<td><img width=\"28\" height=\"28\" src=\"assets/img/user.jpg\" class=\"rounded-circle m-r-5\" alt=\"\"> $pat</td>
											<td>$reports</td>
											<td>$datee</td>
										</tr>";
		}
	}

	echo "						</tbody>
							</table>";
}


function staff($stff) {
	include '../dbconnect.php';
	$sq = $con->query("SELECT fnam, lnam FROM staffs");
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
	$sq = $con->query("SELECT fnam, lnam FROM patients");
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
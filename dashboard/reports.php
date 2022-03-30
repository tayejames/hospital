<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>
        <div class="page-wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-sm-4 col-3">
                        <h4 class="page-title">Medical Report</h4>
                    </div>
                </div>
				<div class="row">
					<div class="col-md-12">
						<div class="table-responsive">
<?php
$sn = 0;
include '../dbconnect.php';

	if ($username == "admin") {
		$sql = $con->query("SELECT * FROM reports");
			if ($sql->num_rows > 0) {

				echo "					<table class=\"table table-striped custom-table\">
											<thead>
												<tr>
													<th>S/N</th>
													<th>Appointment ID</th>
													<th>Patient Complain</th>
													<th>Medical Report</th>
													<th>Date</th>
												</tr>
											</thead>
											<tbody>";
				while ($row = $sql->fetch_assoc()) {
					$apt = $row['apt'];
					$datee = $row['datee'];
					$complain = $row['complaint'];
					$reports = $row['report'];
					$sn += 1;
					echo "						<tr>
													<td>$sn</td>
													<td>$apt</td>
													<td>$complain</td>
													<td>$reports</td>
													<td>$datee</td>
												</tr>";
				}
				echo "						</tbody>
							</table>";
			}
	}
	elseif ($username == 8) {
		$sql = $con->query("SELECT * FROM reports WHERE uid = '$user'");
			if ($sql->num_rows > 0) {

				echo "					<table class=\"table table-striped custom-table\">
											<thead>
												<tr>
													<th>S/N</th>
													<th>Appointment ID</th>
													<th>Complain</th>
													<th>Medical Report</th>
													<th>Date</th>
												</tr>
											</thead>
											<tbody>";
				while ($row = $sql->fetch_assoc()) {
					$apt = $row['apt'];
					$datee = $row['datee'];
					$complain = $row['complaint'];
					$reports = $row['report'];
					$sn += 1;
					echo "						<tr>
													<td>$sn</td>
													<td>$apt</td>
													<td>$complain</td>
													<td>$reports</td>
													<td>$datee</td>
												</tr>";
				}
				echo "						</tbody>
							</table>";
			}
	}
	else {
		$sql = $con->query("SELECT * FROM reports WHERE staff = '$user'");
			if ($sql->num_rows > 0) {

				echo "					<table class=\"table table-striped custom-table\">
											<thead>
												<tr>
													<th>S/N</th>
													<th>Appointment ID</th>
													<th>Patient Complain</th>
													<th>Medical Report</th>
													<th>Date</th>
												</tr>
											</thead>
											<tbody>";
				while ($row = $sql->fetch_assoc()) {
					$apt = $row['apt'];
					$datee = $row['datee'];
					$complain = $row['complaint'];
					$reports = $row['report'];
					$sn += 1;
					echo "						<tr>
													<td>$sn</td>
													<td>$apt</td>
													<td>$complain</td>
													<td>$reports</td>
													<td>$datee</td>
												</tr>";
				}
				echo "						</tbody>
							</table>";
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
<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>
        <div class="page-wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <h4 class="page-title">Add Schedule</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <form method="POST">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
										<label>Department</label>
                                                <select name="dept" id="dept" class="form-control">
                                                    <option selected disabled>Select</option>
<?php
include '../dbconnect.php';
$dep = $con->query("SELECT * FROM departments");
if ($dep->num_rows > 0) {
    while ($row = $dep->fetch_assoc()) {
        $name = $row['name'];
        $dept = $row['id'];
        echo ("<option value=\"$dept\">$name</option>");
    }
}
?>
                                                    
                                                </select>
									</div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
										<label>Doctor Name</label>
										<select id="name" name="staff" class="form-control">
											<option selected disabled>Select Department First</option>
										</select>
									</div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Start Date</label>
                                        <input type="date" name="start" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>End Date</label>
                                        <input type="date" name="stop" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Start Time</label>
                                        <div class="time-icon">
                                            <input type="text" name="on" class="form-control" id="datetimepicker3">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>End Time</label>
                                        <div class="time-icon">
                                            <input type="text" name="off" class="form-control" id="datetimepicker4">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="form-group">
                                <label class="display-block">Schedule Status</label>
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="radio" name="status" id="product_active" value="Active" checked>
									<label class="form-check-label" for="product_active">
									Active
									</label>
								</div>
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="radio" name="status" id="product_inactive" value="Inactive">
									<label class="form-check-label" for="product_inactive">
									Inactive
									</label>
								</div>
                            </div> -->
                            <div class="m-t-20 text-center">
                                <button name="submit" class="btn btn-primary submit-btn">Create Schedule</button>
                            </div>
                        </form>
<?php
if (isset($_POST['submit'])) {
	$dept = $_POST['dept'];
    $staff = $_POST['staff'];
    $start = $_POST['start'];
	$stop = $_POST['stop'];
	$on = $_POST['on'];
    $off = $_POST['off'];
    $duty = $on . '-' . $off;
    $status = "Active";
    $date = date("Y-m-d");
    $wk1 = date("W", strtotime($start));
    $wk2 = date("W", strtotime($stop));
	$weeks = $wk1 . " - " . $wk2;
	// echo "<script>alert('$days')</script>";
	include '../dbconnect.php';
	$sql = $con->query("SELECT * FROM schedules WHERE staff = '$staff' AND dept = '$dept' AND days = '$weeks'");
	if ($sql->num_rows > 0) {
		echo("<script>alert('Schedule Already Appointed for Staff!')</script>");
	}
	else {
		$query = $con->query("INSERT INTO schedules (dept, staff, days, duty, status, datee) VALUES ('$dept', '$staff', '$weeks', '$duty', '$status', '$date')");
		if ($query) {
			echo("<script>alert('Success!'); window.location.href = 'dashboard.php'</script>");
		}
		else {
			echo("<script>alert('Failed!');</script>");
		}
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
    <script src="jquery.min.js"></script>
    <script type="text/javascript">
    $(document).ready(function() {  
      $('#dept').on('change', function() {
        var dept = this.value;
        $.ajax({
            url: "staffs.php",
            type: "POST",
            data: {
                dept: dept
            },
            cache: false,
            success: function(result){
                $("#name").html(result);
            }
        });
      });
    });
  </script>
    <script src="assets/js/jquery-3.2.1.min.js"></script>
	<script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.slimscroll.js"></script>
    <script src="assets/js/select2.min.js"></script>
	<script src="assets/js/moment.min.js"></script>
	<script src="assets/js/bootstrap-datetimepicker.min.js"></script>
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


<!-- add-schedule24:07-->
</html>

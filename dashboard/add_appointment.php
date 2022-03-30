<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>
        <div class="page-wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <h4 class="page-title">Add Appointment</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <form method="POST">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
										<label>Appointment ID</label>
										<?php $apt = 'APT-' . rand(111111,999999); ?>
										<input class="form-control" name="apt" type="text" value="<?php echo($apt); ?>" readonly="">
									</div>
                                </div>
                                <div class="col-md-6">
									<div class="form-group">
										<label>Patient ID</label>
										<input class="form-control" name="uid" type="text" value="<?php echo($user); ?>" readonly="">
									</div>
                                </div>
                            </div>
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
                                        <label>Doctor</label>
                                        <select id="staff" name="staff" class="form-control">
											<option selected disabled>Select Department First</option>
										</select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Date</label>
                                        <div class="form-group">
                                            <input type="date" name="date" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Duty Time</label>
                                        <select name="time" class="form-control">
											<option selected disabled>Select</option>
											<option value="7:00 AM-7:00 PM">7:00 AM - 7:00 PM</option>
											<option value="7:00 PM-7:00 AM">7:00 PM - 7:00 AM</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Time</label>
                                        <div class="">
                                            <input type="time" name="atime" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Message</label>
                                <textarea cols="30" name="descript" rows="4" class="form-control"></textarea>
                            </div>
                            <div class="m-t-20 text-center">
                                <button name="submit" class="btn btn-primary submit-btn">Create Appointment</button>
                            </div>
                        </form>
<?php
if (isset($_POST['submit'])) {
	$apt = $_POST['apt'];
	$uid = $_POST['uid'];
	$dept = $_POST['dept'];
	$staff = $_POST['staff'];
	$date = $_POST['date'];
    $atime = $_POST['atime'];
	$time = $_POST['time'];
	$descript = $_POST['descript'];
    $week = date("W", strtotime($date));
    $limit = limit($staff);
    $meeting = strtotime($atime);
    $checks = times($staff, $date, $time);
    $check = strtotime($checks);
    $int = $check - $meeting;
    $t = round(abs($int)/60, 2);
	// echo '<br>' . $t = date('H:i:s', $int);
    $duty = duty($staff, $time);
	$available = available($staff, $time);
    $start = $duty[0] . $duty[1];
    $stop = $duty[5] . $duty[6];
    // exit();
	include '../dbconnect.php';
	if ($week >= $start && $week <= $stop) {
		if ($limit <= 5) {
            $sql = $con->query("SELECT * FROM appointments WHERE uid = '$uid' AND staff = '$staff' AND datee = '$date'");
            if ($sql->num_rows > 0) {
                echo("<script>alert('Appointment already booked for doctor and date')</script>");
            }
            else {
    			if ($t < 20) {
    				echo("<script>alert('Appointment already booked for doctor at that $checks! pls book for next 20mins')</script>");
    			}
    			else {
    				$query = $con->query("INSERT INTO appointments (apt, uid, staff, datee, timee, atime, descript, status) VALUES ('$apt', '$uid', '$staff', '$date', '$time', '$atime', '$descript', 'Active')");
    				if ($query) {
    					echo("<script>alert('Appointment booked!'); window.location.href = 'dashboard.php'</script>");
    				}	
    			}
            }
		}
		else {
			echo("<script>alert('Doctor too tight for the Appointment, pls book for next day or choose another doctor')</script>");
		}
	}
	else {
		echo("<script>alert('Doctor not on duty for appointed time')</script>");
	}
}


function limit($limit) {
	$lim = 0;
	include '../dbconnect.php';
	$sql = $con->query("SELECT * FROM appointments WHERE staff = '$limit'");
	if ($sql->num_rows > 0) {
		while ($row = $sql->fetch_assoc()) {
			$lim += 1;
		}
		return $lim;
	}
}

function times($staff, $date, $time) {
    include '../dbconnect.php';
    $sql = $con->query("SELECT * FROM appointments WHERE staff = '$staff' AND datee = '$date' AND timee = '$time' ORDER BY id DESC");
    if ($sql->num_rows > 0) {
        $row = $sql->fetch_assoc();
        $aptime = $row['atime'];
        return $aptime;
    }
}

function duty($duty, $time) {
	include '../dbconnect.php';
	$sql = $con->query("SELECT * FROM schedules WHERE staff = '$duty' AND duty = '$time'");
	if ($sql->num_rows > 0) {
		$row = $sql->fetch_assoc();
		$week = $row['days'];
		return $week;
	}
}


function available($available, $time) {
    $ret = 0;
    include '../dbconnect.php';
    $sql = $con->query("SELECT * FROM schedules WHERE staff = '$available' AND duty = '$time'");
    if ($sql->num_rows > 0) {
        $row = $sql->fetch_assoc();
        $duty = $row['duty'];
        $ret = 1;
        return $ret;
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
                $("#staff").html(result);
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
            });
     </script>
</body>


<!-- add-appointment24:07-->
</html>

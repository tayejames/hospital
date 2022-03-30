<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>
        <div class="page-wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <h4 class="page-title">Edit Schedule</h4>
                    </div>
                </div>
<?php
$staff = $_GET['xxyz'];
include '../dbconnect.php';
$sch = $con->query("SELECT * FROM schedules WHERE staff = '$staff'");
if ($sch->num_rows > 0) {
    $row = $sch->fetch_assoc();
    $dept = $row['dept'];
    $staff = $row['staff'];
    $duty = $row['duty'];
    $on = $duty[0] . $duty[1] . $duty[2] . $duty[3] . $duty[4] . $duty[5] . $duty[6];
    $off = $duty[8] . $duty[9] . $duty[10] . $duty[11] . $duty[12] . $duty[13] . $duty[14];
    $dpt = dept($dept);
    $name = name($dept);
}


function dept($dpt) {
    include '../dbconnect.php';
    $dep = $con->query("SELECT * FROM departments WHERE id = $dpt");
    if ($dep->num_rows > 0) {
        $row = $dep->fetch_assoc();
        $name = $row['name'];
        return $name;
    }
}

function name($name) {
    include '../dbconnect.php';
    $search = $con->query("SELECT fnam, lnam FROM staffs WHERE dept = $name");
    if ($search) {
        $row = $search->fetch_assoc();
        $fnam = $row['fnam'];
        $lnam = $row['lnam'];
        $flnam = $fnam . ' ' . $lnam;
        return $flnam;
    }
}
?>
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <form method="POST">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Fullname</label>
                                                <input class="form-control text-center" name="" value="<?php echo('Dr. ' . $name); ?>" type="text" readonly>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>User ID</label>
                                                <input class="form-control text-center" name="staf" value="<?php echo($staff); ?>" type="text" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Start Date</label>
                                        <input type="date" name="start" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                               <label>End Date</label>
                                        <input type="date" name="stop" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Start Time</label>
                                        <div class="time-icon">
                                            <input type="text" name="on" value="<?php echo($on); ?>" class="form-control" id="datetimepicker3">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>End Time</label>
                                        <div class="time-icon">
                                            <input type="text" name="off" value="<?php echo($off); ?>" class="form-control" id="datetimepicker4">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="m-t-20 text-center">
                                <button name="submit" class="btn btn-primary submit-btn">Save</button>
                            </div>
                        </form>
<?php
if (isset($_POST['submit'])) {
	$start = $_POST['start'];
    $stop = $_POST['stop'];
	$dept = $_POST['dept'];
	$staff = $_POST['staf'];
	$on = $_POST['on'];
    $off = $_POST['off'];
    $duty = $on . '-' . $off;
    $date = date("d/m/Y");
    $wk1 = date("W", strtotime($start));
    $wk2 = date("W", strtotime($stop));
    $weeks = $wk1 . " - " . $wk2;
	$days = $day1 . ", " . $day2 . ", " . $day3 . ", " . $day4 . ", " . $day5 . ", " . $day6 . ", " . $day7;
	// echo "<script>alert('$days')</script>";
	include '../dbconnect.php';
	$sql = $con->query("UPDATE schedules SET days = '$weeks', duty = '$duty' WHERE staff = '$staf'");
	if ($sql->num_rows > 0) {
		echo("<script>alert('Success!')</script>");
	}
	else {
		echo("<script>alert('Failed!');</script>");
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

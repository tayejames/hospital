<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>
        <div class="page-wrapper">
            <div class="content">
                <div class="row">
                	<?php if ($username == "admin"): ?>
	                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
	                        <div class="dash-widget">
								<span class="dash-widget-bg1"><i class="fa fa-stethoscope" aria-hidden="true"></i></span>
								<div class="dash-widget-info text-right">
	<?php
	$num1 = 0;
	include '../dbconnect.php';
	$doc = $con->query("SELECT * FROM staffs");
	if ($doc->num_rows > 0) {
		while ($row = $doc->fetch_assoc()) {
			$num1 += 1;
		}
	}
	?>
									<h3><?php echo($num1); ?></h3>
									<span class="widget-title1">Doctors <i class="fa fa-check" aria-hidden="true"></i></span>
								</div>
	                        </div>
	                    </div>
	                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
	                        <div class="dash-widget">
	                            <span class="dash-widget-bg2"><i class="fa fa-user-o"></i></span>
	                            <div class="dash-widget-info text-right">
	<?php
	$num2 = 0;
	include '../dbconnect.php';
	$pat = $con->query("SELECT * FROM patients");
	if ($pat->num_rows > 0) {
		while ($row = $pat->fetch_assoc()) {
			$num2 += 1;
		}
	}
	?>
	                                <h3><?php echo($num2); ?></h3>
	                                <span class="widget-title2">Patients <i class="fa fa-check" aria-hidden="true"></i></span>
	                            </div>
	                        </div>
	                    </div>
	                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
	                        <div class="dash-widget">
	                            <span class="dash-widget-bg4"><i class="fa fa-heartbeat" aria-hidden="true"></i></span>
	                            <div class="dash-widget-info text-right">
	<?php
	$num3 = 0;
	include '../dbconnect.php';
	$apt = $con->query("SELECT * FROM appointments");
	if ($apt->num_rows > 0) {
		while ($row = $apt->fetch_assoc()) {
			$num3 += 1;
		}
	}
	?>
	                                <h3><?php echo($num3); ?></h3>
	                                <span class="widget-title4">Appointment <i class="fa fa-check" aria-hidden="true"></i></span>
	                            </div>
	                        </div>
	                    </div>
	                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
	                        <div class="dash-widget">
	                            <span class="dash-widget-bg3"><i class="fa fa-user-md" aria-hidden="true"></i></span>
	                            <div class="dash-widget-info text-right">
	<?php
	$num4 = 0;
	include '../dbconnect.php';
	$rep = $con->query("SELECT * FROM reports");
	if ($rep->num_rows > 0) {
		while ($row = $rep->fetch_assoc()) {
			$num4 += 1;
		}
	}
	?>
	                                <h3><?php echo($num4); ?></h3>
	                                <span class="widget-title3">Attend <i class="fa fa-check" aria-hidden="true"></i></span>
	                            </div>
	                        </div>
	                    </div>
	                    <!--  -->
					<?php elseif ($username == 8): ?>
	             		<!--  -->
	                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
	                        <div class="dash-widget">
	                            <span class="dash-widget-bg4"><i class="fa fa-heartbeat" aria-hidden="true"></i></span>
	                            <div class="dash-widget-info text-right">
	<?php
	$num3 = 0;
	include '../dbconnect.php';
	$apt = $con->query("SELECT * FROM appointments WHERE uid = '$user'");
	if ($apt->num_rows > 0) {
		while ($row = $apt->fetch_assoc()) {
			$num3 += 1;
		}
	}
	?>
	                                <h3><?php echo($num3); ?></h3>
	                                <span class="widget-title4">Appointment <i class="fa fa-check" aria-hidden="true"></i></span>
	                            </div>
	                        </div>
	                    </div>
	                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
	                        <div class="dash-widget">
	                            <span class="dash-widget-bg3"><i class="fa fa-user-md" aria-hidden="true"></i></span>
	                            <div class="dash-widget-info text-right">
	<?php
	$num4 = 0;
	include '../dbconnect.php';
	$rep = $con->query("SELECT * FROM reports WHERE uid = '$user'");
	if ($rep->num_rows > 0) {
		while ($row = $rep->fetch_assoc()) {
			$num4 += 1;
		}
	}
	?>
	                                <h3><?php echo($num4); ?></h3>
	                                <span class="widget-title3">Attend <i class="fa fa-check" aria-hidden="true"></i></span>
	                            </div>
	                        </div>
	                    </div>
	                    <!--  -->
	            	<?php else: ?>
	            		<!--  -->
	                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
	                        <div class="dash-widget">
	                            <span class="dash-widget-bg4"><i class="fa fa-heartbeat" aria-hidden="true"></i></span>
	                            <div class="dash-widget-info text-right">
	<?php
	$num3 = 0;
	include '../dbconnect.php';
	$apt = $con->query("SELECT * FROM appointments WHERE staff = '$user'");
	if ($apt->num_rows > 0) {
		while ($row = $apt->fetch_assoc()) {
			$num3 += 1;
		}
	}
	?>
	                                <h3><?php echo($num3); ?></h3>
	                                <span class="widget-title4">Appointment <i class="fa fa-check" aria-hidden="true"></i></span>
	                            </div>
	                        </div>
	                    </div>
	                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
	                        <div class="dash-widget">
	                            <span class="dash-widget-bg3"><i class="fa fa-user-md" aria-hidden="true"></i></span>
	                            <div class="dash-widget-info text-right">
	<?php
	$num4 = 0;
	include '../dbconnect.php';
	$rep = $con->query("SELECT * FROM reports WHERE staff = '$user'");
	if ($rep->num_rows > 0) {
		while ($row = $rep->fetch_assoc()) {
			$num4 += 1;
		}
	}
	?>
	                                <h3><?php echo($num4); ?></h3>
	                                <span class="widget-title3">Attend <i class="fa fa-check" aria-hidden="true"></i></span>
	                            </div>
	                        </div>
	                    </div>
                	<?php endif ?>
                </div>


<?php include 'notification_box.php'; ?>
        </div>
    </div>
    <div class="sidebar-overlay" data-reff=""></div>
    <script src="assets/js/jquery-3.2.1.min.js"></script>
	<script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.slimscroll.js"></script>
    <script src="assets/js/Chart.bundle.js"></script>
    <script src="assets/js/chart.js"></script>
    <script src="assets/js/app.js"></script>

</body>



</html>
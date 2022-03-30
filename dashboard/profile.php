<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>
        <div class="page-wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-sm-7 col-6">
                        <h4 class="page-title">Profile</h4>
                    </div>
                </div>
<?php
$uid = $_GET['xyyz'];
include '../dbconnect.php';
$sql = $con->query("SELECT * FROM patients WHERE uid = '$uid'");
if ($sql->num_rows > 0) {
	$row = $sql->fetch_assoc();
	$uid = $row['uid'];
	$fnam = $row['fnam'];
	$lnam = $row['lnam'];
	$email = $row['email'];
	$pno = $row['pno'];
	$dob = $row['dob'];
	$address = $row['address'];
	$gender = $row['gender'];
	$email = $row['email'];
	$img = $row['img'];
	$photo = 'img/' . $img;
	$flnam = $fnam . " " . $lnam;
?>
                <div class="card-box profile-header">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="profile-view">
                                <div class="profile-img-wrap">
                                    <div class="profile-img">
                                        <a href="#"><img class="avatar" src="<?php echo($photo); ?>" alt=""></a>
                                    </div>
                                </div>
                                <div class="profile-basic">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="profile-info-left">
                                                <h3 class="user-name m-t-0 mb-0"><?php echo($flnam); ?></h3>
                                                <div class="staff-id">Patient ID : <?php echo($uid); ?></div>
                                                <!-- <div class="staff-msg"><a href="chat.html" class="btn btn-primary">Send Message</a></div> -->
                                            </div>
                                        </div>
                                        <div class="col-md-7">
                                            <ul class="personal-info">
                                                <li>
                                                    <span class="title">Phone:</span>
                                                    <span class="text"><a href="#"><?php echo($pno); ?></a></span>
                                                </li>
                                                <li>
                                                    <span class="title">Email:</span>
                                                    <span class="text"><a href="#"><?php echo($email); ?></a></span>
                                                </li>
                                                <li>
                                                    <span class="title">Birthday:</span>
                                                    <span class="text"><?php echo($dob); ?></span>
                                                </li>
                                                <li>
                                                    <span class="title">Address:</span>
                                                    <span class="text"><?php echo($address); ?></span>
                                                </li>
                                                <li>
                                                    <span class="title">Gender:</span>
                                                    <span class="text"><?php echo($gender); ?></span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>                        
                        </div>
                    </div>
                </div>
				<div class="profile-tabs">
					<ul class="nav nav-tabs nav-tabs-bottom">
						<li class="nav-item"><a class="nav-link active" href="#about-cont" data-toggle="tab">Medical Record</a></li>
					</ul>

					<div class="tab-content">
						<div class="tab-pane show active" id="about-cont">
				<div class="row">
					<div class="col-md-12">
						<div class="table-responsive">
<?php
$sn = 0;
$uid = $_GET['xyyz'];
include '../dbconnect.php';
$sql = $con->query("SELECT * FROM reports WHERE uid = '$uid'");
if ($sql->num_rows > 0) {
	echo "					<table class=\"table table-striped custom-table\">
								<thead>
									<tr>
										<th>S/N</th>
										<th>Appointment ID</th>
										<th>Complain</th>
										<th>Report</th>
										<th>Date</th>
									</tr>
								</thead>
								<tbody>";
	while ($row = $sql->fetch_assoc()) {
		$apt = $row['apt'];
		$uid = $row['uid'];
		$datee = $row['datee'];
		$descript = $row['complaint'];
		$report = $row['report'];
		$sn += 1;
		echo "						<tr>
										<td>$sn</td>
										<td>$apt</td>
										<td>$descript</td>
										<td>$report</td>
										<td>$datee</td>
									</tr>";
	}
	echo "							</tbody>
							</table>";
}
else {
    echo("No record");
}
?>
						</div>
					</div>
                </div>
						</div>
            <?php } ?>
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
    <script src="assets/js/app.js"></script>
</body>


<!-- profile23:03-->
</html>
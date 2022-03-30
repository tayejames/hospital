<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>
        <div class="page-wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-sm-4 col-3">
                        <h4 class="page-title">Doctors</h4>
                    </div>
                    <div class="col-sm-8 col-9 text-right m-b-20">
                        <a href="add_doctor.php" class="btn btn-primary btn-rounded float-right"><i class="fa fa-plus"></i> Add Doctor</a>
                    </div>
                </div>
				<div class="row doctor-grid">
<?php
include '../dbconnect.php';
$sql = $con->query("SELECT * FROM staffs");
if ($sql->num_rows > 0) {
    while ($row = $sql->fetch_assoc()) {
        $uid = $row['uid'];
        $dep = $row['dept'];
        $fnam = $row['fnam'];
        $lnam = $row['lnam'];
        $img = $row['img'];
        $dept = dept($dep);
        $flnam = $fnam . " " . $lnam;
        $photo = 'img/' . $img;
        echo "      <div class=\"col-md-4 col-sm-4  col-lg-3\">
                        <div class=\"profile-widget\">
                            <div class=\"doctor-img\">
                                <a class=\"avatar\" href=\"#\"><img alt=\"\" src=\"$photo\"></a>
                            </div>
                            <div class=\"dropdown profile-action\">
                                <a href=\"#\" class=\"action-icon dropdown-toggle\" data-toggle=\"dropdown\" aria-expanded=\"false\"><i class=\"fa fa-ellipsis-v\"></i></a>
                                <div class=\"dropdown-menu dropdown-menu-right\">
                                    <a class=\"dropdown-item\" href=\"edit_doctor.php?xyzz=$uid\"><i class=\"fa fa-pencil m-r-5\"></i> View</a>
                                    <a class=\"dropdown-item\" href=\"#\" data-toggle=\"modal\" data-target=\"#delete_doctor\"><i class=\"fa fa-trash-o m-r-5\"></i> Delete</a>
                                </div>
                            </div>
                            <h4 class=\"doctor-name text-ellipsis\"><a href=\"#\">$flnam</a></h4>
                            <div class=\"doc-prof\">$dept</div>
                            <div class=\"user-country\">
                                 $uid
                            </div>
                        </div>
                    </div>";
    }
}
else {
    echo("No data");
}

function dept($dept) {
    include '../dbconnect.php';
    $dep = $con->query("SELECT * FROM departments WHERE id = $dept");
    if ($dep->num_rows > 0) {
        $row = $dep->fetch_assoc();
        $name = $row['name'];
        return $name;
    }
}
?>
            </div>
<?php include 'notification_box.php'; ?>
        </div>
		<div id="delete_doctor" class="modal fade delete-modal" role="dialog">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-body text-center">
						<img src="assets/img/sent.png" alt="" width="50" height="46">
						<h3>Are you sure want to delete this Doctor?</h3>
                        <form method="POST">
    						<div class="m-t-20"> <a href="#" class="btn btn-white" data-dismiss="modal">Close</a>
                                <input type="text" name="dept" value="<?php echo($uid); ?>" hidden readonly>
    							<button type="submit" name="delete" class="btn btn-danger">Delete</button>
    						</div>
                        </form>
<?php
if (isset($_POST['delete'])) {
    $uid = $_POST['dept'];
    include '../dbconnect.php';
    $sql = $con->query("DELETE FROM staffs WHERE uid = '$uid'");
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
    <script src="assets/js/moment.min.js"></script>
    <script src="assets/js/bootstrap-datetimepicker.min.js"></script>
    <script src="assets/js/app.js"></script>
</body>


<!-- doctors23:17-->
</html>
<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>
        <div class="page-wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <h4 class="page-title">Add Department</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <form method="POST">
							<div class="form-group">
								<label>Department Name</label>
								<input class="form-control" name="name" required type="text">
							</div>
							<div class="form-group">
								<label>Department Shortcode</label>
								<input class="form-control" name="code" required type="text">
							</div>
							<div class="form-group">
                                <label>Description</label>
                                <textarea cols="30" rows="4" name="descript" class="form-control"></textarea>
                            </div>
                            <div class="m-t-20 text-center">
                                <button name="submit" class="btn btn-primary submit-btn">Create Department</button>
                            </div>
                        </form>
<?php
if (isset($_POST['submit'])) {
	$name = $_POST['name'];
	$descript = $_POST['descript'];
	$code = strtoupper($_POST['code']);
	$status = "Active";
	$date = date("Y-m-d");
	include '../dbconnect.php';
	$sql = $con->query("SELECT name FROM departments WHERE name = '$name' OR code = '$code'");
	if ($sql->num_rows > 0) {
		echo("<script>alert('Department Already Exist!')</script>");
	}
	else {
		$query = $con->query("INSERT INTO departments (name, code, descript, status, datee) VALUES ('$name', '$code', '$descript', '$status', '$date')");
		if ($query) {
			echo("<script>alert('Success!'); window.location.href = 'dashboard.php'</script>");
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
    <script src="assets/js/jquery-3.2.1.min.js"></script>
	<script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.slimscroll.js"></script>
    <script src="assets/js/select2.min.js"></script>
    <script src="assets/js/app.js"></script>
</body>


<!-- add-department24:07-->
</html>

<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>
        <div class="page-wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-sm-5 col-5">
                        <h4 class="page-title">Departments</h4>
                    </div>
                    <div class="col-sm-7 col-7 text-right m-b-30">
                        <a href="add_department.php" class="btn btn-primary btn-rounded"><i class="fa fa-plus"></i> Add Department</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
<?php
$sn = 0;
include '../dbconnect.php';
$sql = $con->query("SELECT * FROM departments");
if ($sql->num_rows) {
    echo "              <table class=\"table table-striped custom-table mb-0 datatable\">
                                <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Department Name</th>
                                        <th>Department Code</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th class=\"text-right\">Action</th>
                                    </tr>
                                </thead>
                                <tbody>";
    while ($row = $sql->fetch_assoc()) {
        $name = $row['name'];
        $dept = $row['id'];
        $code = $row['code'];
        $status = $row['status'];
        $date = $row['datee'];
        $sn += 1;
        if ($status == "Active") {
            $badge = "custom-badge status-green";
        }
        else {
            $badge = "custom-badge status-red";
        }
        echo "                  
                                    <tr>
                                        <td>$sn</td>
                                        <td>$name</td>
                                        <td>$code</td>
                                        <td>$date</td>
                                        <td><span class=\"$badge\">$status</span></td>
                                        <td class=\"text-right\">
                                            <div class=\"dropdown dropdown-action\">
                                                <a href=\"#\" class=\"action-icon dropdown-toggle\" data-toggle=\"dropdown\" aria-expanded=\"false\"><i class=\"fa fa-ellipsis-v\"></i></a>
                                                <div class=\"dropdown-menu dropdown-menu-right\">
                                                    <a class=\"dropdown-item\" href=\"edit_department.php?xyz=$dept\"><i class=\"fa fa-pencil m-r-5\"></i> Edit</a>
                                                    <a class=\"dropdown-item\" href=\"#\" data-toggle=\"modal\" data-target=\"#delete_department\"><i class=\"fa fa-trash-o m-r-5\"></i> Delete</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>";
    }
    echo "                      </tbody>
                            </table>";
}
else {
    echo("No data");
}

?>
                        </div>
                    </div>
                </div>
            </div>
<?php include 'notification_box.php'; ?>
        </div>
		<div id="delete_department" class="modal fade delete-modal" role="dialog">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-body text-center">
						<img src="assets/img/sent.png" alt="" width="50" height="46">
						<h3>Are you sure want to delete this Department?</h3>
                        <form method="POST">
                            <div class="m-t-20"> <a href="#" class="btn btn-white" data-dismiss="modal">Close</a>
                                <input type="text" name="dept" value="<?php echo($dept); ?>" hidden readonly>
                                <button type="submit" name="delete" class="btn btn-danger">Delete</button>
                            </div>
                        </form>
<?php
if (isset($_POST['delete'])) {
    $dept = $_POST['dept'];
    include '../dbconnect.php';
    $sql = $con->query("DELETE FROM departments WHERE id = '$dept'");
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
    <script src="assets/js/jquery.dataTables.min.js"></script>
    <script src="assets/js/dataTables.bootstrap4.min.js"></script>
    <script src="assets/js/jquery.slimscroll.js"></script>
    <script src="assets/js/app.js"></script>
</body>


<!-- departments23:21-->
</html>
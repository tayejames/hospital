<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="dashboard/assets/img/favicon.ico">
    <title>General Hospital</title>
    <link rel="stylesheet" type="text/css" href="dashboard/assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="dashboard/assets/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="dashboard/assets/css/select2.min.css">
    <link rel="stylesheet" type="text/css" href="dashboard/assets/css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" type="text/css" href="dashboard/assets/css/style.css">
</head>

<body>
    <div class="main-wrapper">
        <div class="page-wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <h4 class="page-title">Register</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <form method="POST" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>First Name <span class="text-danger">*</span></label>
                                        <input class="form-control" name="fnam" type="text">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Last Name</label>
                                        <input class="form-control" name="lnam" type="text">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Email <span class="text-danger">*</span></label>
                                        <input class="form-control" name="email" type="email">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input class="form-control" name="pass" type="password">
                                    </div>
                                </div>
								<div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Date of Birth</label>
                                        <div class="form-group">
                                            <input type="date" name="dob" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
									<div class="form-group gender-select">
										<label class="gen-label">Gender:</label>
										<div class="form-check-inline">
											<label class="form-check-label">
												<input type="radio" name="gender" value="Male" class="form-check-input">Male
											</label>
										</div>
										<div class="form-check-inline">
											<label class="form-check-label">
												<input type="radio" name="gender" value="Female" class="form-check-input">Female
											</label>
										</div>
									</div>
                                </div>
								<div class="col-sm-12">
									<div class="row">
										<div class="col-sm-12">
											<div class="form-group">
												<label>Address</label>
												<input type="text" name="address" class="form-control ">
											</div>
										</div>
										<div class="col-sm-6 col-md-6 col-lg-3">
                                            <div class="form-group">
                                                <label>Country</label>
                                                <select name="country" id="country" class="form-control select">
                                                    <option selected disabled>Select</option>
<?php
include 'dbconnect.php';
$country = $con->query("SELECT * FROM countries");
if ($country->num_rows > 0) {
    while ($row = $country->fetch_assoc()) {
        $name = $row['name'];
        $cid = $row['id'];
        echo ("<option value=\"$cid\">$name</option>");
    }
}
?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-6 col-lg-3">
                                            <div class="form-group">
                                                <label>State/Province</label>
                                                <select name="state" id="state" class="form-control select">
                                                    <option selected disabled>Select Country First</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-6 col-lg-3">
                                            <div class="form-group">
                                                <label>City</label>
                                                <select name="city" id="city" class="form-control select">
                                                    <option selected disabled>Select State First</option>
                                                </select>
                                            </div>
                                        </div>
										<div class="col-sm-6 col-md-6 col-lg-3">
											<div class="form-group">
												<label>Postal Code</label>
												<input name="pcode" type="text" class="form-control">
											</div>
										</div>
									</div>
								</div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Phone </label>
                                        <input class="form-control" name="pno" type="text">
                                    </div>
                                </div>
                                <div class="col-sm-6">
									<div class="form-group">
										<label>Avatar</label>
										<div class="profile-upload">
											<div class="upload-img">
												<img alt="" src="dashboard/assets/img/user.jpg">
											</div>
											<div class="upload-input">
												<input type="file" name="img" class="form-control">
											</div>
										</div>
									</div>
                                </div>
                            </div>
                            <div class="m-t-20 text-center">
                                <button name="submit" class="btn btn-primary submit-btn">Register</button>
                                <br>OR<br>    
                                <a href="../Hospital/">Back to Home</a>
                            </div>
                        </form>
<?php
if (isset($_POST['submit'])) {
    $fnam = $_POST['fnam'];
    $lnam = $_POST['lnam'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $country = $_POST['country'];
    $state = $_POST['state'];
    $city = $_POST['city'];
    $pcode = $_POST['pcode'];
    $pno = $_POST['pno'];
    $status = "Register";
    $uid = strtoupper($fnam[0]) . strtoupper($lnam[0]) . rand(111111,999999);
    
    $date = date("Y-m-d");
    include 'dbconnect.php';
    $location = $uid . '.jpg';
    $destination = 'dashboard/img/' . $location;
    $sql = $con->query("SELECT * FROM patients WHERE uid = '$uid'");
    if ($sql->num_rows) {
        echo("<script>alert('Account Already Exists!')</script>");
    }
    else {
        $query = $con->query("INSERT INTO patients (uid, fnam, lnam, email, pass, dob, gender, pno, address, country, state, city, pcode, img, datee, status) VALUES ('$uid', '$fnam', '$lnam', '$email', '$pass', '$dob', '$gender', '$pno', '$address', '$country', '$state', '$city', '$pcode', '$location', '$date', '$status')");
        if ($query) {
            move_uploaded_file($_FILES['img']['tmp_name'], $destination);
            echo("<script>window.location.href = 'pay.php?pat=$uid'</script>");
        }
        else {
            echo("<script>alert('Registration Failed!');</script>");
        }
    }
}
?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="sidebar-overlay" data-reff=""></div>
    <script src="dashboard/jquery.min.js"></script>
    <script type="text/javascript">
    $(document).ready(function() {  
      $('#country').on('change', function() {
        var country_id = this.value;
        $.ajax({
            url: "dashboard/states.php",
            type: "POST",
            data: {
                country_id: country_id
            },
            cache: false,
            success: function(result){
                $("#state").html(result);
            }
        });
      });

      $('#state').on('change', function() {
        var state_id = this.value;
        $.ajax({
            url: "dashboard/cities.php",
            type: "POST",
            data: {
                state_id: state_id
            },
            cache: false,
            success: function(result){
                $("#city").html(result);
            }
        });
      });
    });
  </script>
    <script src="dashboard/assets/js/jquery-3.2.1.min.js"></script>
	<script src="dashboard/assets/js/popper.min.js"></script>
    <script src="dashboard/assets/js/bootstrap.min.js"></script>
    <script src="dashboard/assets/js/jquery.slimscroll.js"></script>
    <script src="dashboard/assets/js/select2.min.js"></script>
	<script src="dashboard/assets/js/moment.min.js"></script>
	<script src="dashboard/assets/js/bootstrap-datetimepicker.min.js"></script>
    <script src="dashboard/assets/js/app.js"></script>
</body>


<!-- add-patient24:07-->
</html>

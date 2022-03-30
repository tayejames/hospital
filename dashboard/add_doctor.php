<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>
        <div class="page-wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <h4 class="page-title">Add Doctor</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <form method="POST" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Department</label>
                                                <select name="dept" class="form-control select">
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
                                    </div>
                                </div>
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
include '../dbconnect.php';
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
                                                <input type="text" name="pcode" class="form-control">
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
                                                <img alt="" src="assets/img/user.jpg">
                                            </div>
                                            <div class="upload-input">
                                                <input type="file" name="img" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Short Biography</label>
                                <textarea class="form-control" name="bio" rows="3" cols="30"></textarea>
                            </div>
                            <div class="m-t-20 text-center">
                                <button name="submit" class="btn btn-primary submit-btn">Create Doctor</button>
                            </div>
                        </form>
<?php
if (isset($_POST['submit'])) {
    $dep = $_POST['dept'];
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
    $bio = $_POST['bio'];
    $status = "Active";
    $date = date("Y-m-d");

    $dept = dept($dep);
    $rand = rand(111111,999999);
    $uid = $dept . '-' . $rand;
    $location = $uid . '.jpg';
    $destination = 'img/' . $location;
    $duty;
    include '../dbconnect.php';
    $sql = $con->query("SELECT * FROM staffs WHERE email = '$email' OR pno = '$pno' OR uid = '$uid'");
    if ($sql->num_rows) {
        echo("<script>alert('Account Already Exists!')</script>");
    }
    else {
        $query = $con->query("INSERT INTO staffs (uid, dept, fnam, lnam, email, pass, dob, gender, pno, address, country, state, city, pcode, bio, status, img, datee) VALUES ('$uid', '$dep', '$fnam', '$lnam', '$email', '$pass', '$dob', '$gender', '$pno', '$address', '$country', '$state', '$city', '$pcode', '$bio', '$status', '$location', '$date')");
        if ($query) {
            move_uploaded_file($_FILES['img']['tmp_name'], $destination);
            echo("<script>alert('Registration Successful!'); window.location.href = 'dashboard.php'</script>");
        }
        else {
            echo("<script>alert('Registration Failed!');</script>");
        }
    }
}


function dept($dept) {
    include '../dbconnect.php';
    $dep = $con->query("SELECT * FROM departments WHERE id = $dept");
    if ($dep->num_rows > 0) {
        $row = $dep->fetch_assoc();
        $code = $row['code'];
        return $code;
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
      $('#country').on('change', function() {
        var country_id = this.value;
        $.ajax({
            url: "states.php",
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
            url: "cities.php",
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
    <script src="assets/js/jquery-3.2.1.min.js"></script>
	<script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.slimscroll.js"></script>
    <script src="assets/js/select2.min.js"></script>
	<script src="assets/js/moment.min.js"></script>
	<script src="assets/js/bootstrap-datetimepicker.min.js"></script>
    <script src="assets/js/app.js"></script>
</body>


<!-- add-doctor24:06-->
</html>

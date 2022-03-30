<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>
        <div class="page-wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <h4 class="page-title">Edit Doctor</h4>
                    </div>
                </div>
<?php
$uid = $_GET['xyzz'];
include '../dbconnect.php';
$sql = $con->query("SELECT * FROM staffs WHERE uid = '$uid'");
if ($sql->num_rows > 0) {
    $row = $sql->fetch_assoc();
    $dep = $row['dept'];
    $fnam = $row['fnam'];
    $lnam = $row['lnam'];
    $email = $row['email'];
    $pass = $row['pass'];
    $dob = $row['dob'];
    $gender = $row['gender'];
    $address = $row['address'];
    $cntry = $row['country'];
    $states = $row['state'];
    $cit = $row['city'];
    $pcode = $row['pcode'];
    $pno = $row['pno'];
    $bio = $row['bio'];
    $status = $row['status'];
    $dpt = dpt($dep);
    $country = country($cntry);
    $state = state($states);
    $city = city($cit);
    // $on = $duty[0] . $duty[1] . $duty[2] . $duty[3] . $duty[4];
    // $off = $duty[6] . $duty[7] . $duty[8] . $duty[9] . $duty[10];
}

function dpt($dpt) {
    include '../dbconnect.php';
    $dep = $con->query("SELECT * FROM departments WHERE id = $dpt");
    if ($dep->num_rows > 0) {
        $row = $dep->fetch_assoc();
        $name = $row['name'];
        return $name;
    }
}

function country($country) {
    include '../dbconnect.php';
    $cnty = $con->query("SELECT * FROM countries WHERE id = $country");
    if ($cnty->num_rows > 0) {
        $row = $cnty->fetch_assoc();
        $name = $row['name'];
        return $name;
    }
}

function state($state) {
    include '../dbconnect.php';
    $ste = $con->query("SELECT * FROM states WHERE id = $state");
    if ($ste->num_rows > 0) {
        $row = $ste->fetch_assoc();
        $name = $row['name'];
        return $name;
    }
}

function city($city) {
    include '../dbconnect.php';
    $cty = $con->query("SELECT * FROM cities WHERE id = $city");
    if ($cty->num_rows > 0) {
        $row = $cty->fetch_assoc();
        $name = $row['name'];
        return $name;
    }
}
?>
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <form method="POST" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>User ID</label>
                                                <input class="form-control text-center" name="fnam" value="<?php echo($uid); ?>" type="text" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Department</label>
                                                <select name="dept" class="form-control select" required>
                                                    <option selected disabled value="<?php echo($dep); ?>"><?php echo($dpt); ?></option>
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
                                        <input class="form-control" name="fnam" value="<?php echo($fnam); ?>" type="text">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Last Name</label>
                                        <input class="form-control" name="lnam" value="<?php echo($lnam); ?>" type="text">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Email <span class="text-danger">*</span></label>
                                        <input class="form-control" name="email" value="<?php echo($email); ?>" type="email">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input class="form-control" name="pass" readonly value="<?php echo($pass); ?>" type="password">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Date of Birth</label>
                                        <div class="form-group">
                                            <input type="date" name="dob" value="<?php echo($dob); ?>" class="form-control">
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
                                                <input type="text" name="address" value="<?php echo($address); ?>" class="form-control ">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-6 col-lg-3">
                                            <div class="form-group">
                                                <label>Country</label>
                                                <select name="country" id="country" class="form-control select">
                                                    <option selected disabled value="<?php echo($cntry); ?>"><?php echo($country); ?></option>
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
                                                    <option selected disabled value="<?php echo($states); ?>"><?php echo($state); ?></option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-6 col-lg-3">
                                            <div class="form-group">
                                                <label>City</label>
                                                <select name="city" id="city" class="form-control select">
                                                    <option selected disabled value="<?php echo($cit); ?>"><?php echo($city); ?></option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-6 col-lg-3">
                                            <div class="form-group">
                                                <label>Postal Code</label>
                                                <input type="text" name="pcode" value="<?php echo($pcode); ?>" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Phone </label>
                                        <input class="form-control" name="pno" value="<?php echo($pno); ?>" type="text">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Short Biography</label>
                                <textarea class="form-control" name="bio" rows="3" cols="30"><?php echo($bio); ?></textarea>
                            </div>
                            <div class="m-t-20 text-center">
                                <button name="submit" class="btn btn-primary submit-btn">Save</button>
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
    $date = date("d/m/Y");

    $dept = dept($dep);
    $rand = rand(111111,999999);
    $uid = $dept . '-' . $rand;
    $location = $uid . '.jpg';
    $destination = 'img/' . $location;
    $duty;
    include '../dbconnect.php';
    $sql = $con->query("UPDATE staffs SET dept = '$dept', fnam = '$fnam', lnam = '$lnam', pno = '$pno', address = '$address', country = '$country', state = '$state', city = '$city', pcode = '$pcode', duty = '$duty' WHERE uid = '$uid'");
    if ($sql) {
        echo("<script>alert('Success!')</script>");
    }
    else {
        echo("<script>alert('Failed!');</script>");
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

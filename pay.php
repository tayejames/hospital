<!DOCTYPE html>
<html lang="en">


<!-- login23:11-->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="dashboard/assets/img/favicon.ico">
    <title>General Hospital</title>
    <link rel="stylesheet" type="text/css" href="dashboard/assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="dashboard/assets/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="dashboard/assets/css/style.css">
    <!--[if lt IE 9]>
		<script src="dashboard/assets/js/html5shiv.min.js"></script>
		<script src="dashboard/assets/js/respond.min.js"></script>
	<![endif]-->
</head>

<body>
    <div class="main-wrapper account-wrapper">
        <div class="account-page">
			<div class="account-center">
				<div class="account-box">
                    <form action="" method="post" class="form-signin">
						<div class="account-logo">
                            <a><img src="dashboard/assets/img/logo-dark.png" alt=""></a>
                        </div>
                        <?php
                        $uid = $_GET['pat'];
                        ?>
                        <div class="form-group">
                            <label>Dear Customer, Your card balance is <strike>N</strike>500</label>
                        </div>
                        <div class="form-group">
                            <label>Patient ID</label>
                            <input type="text" name="uid" value="<?php echo $uid; ?>" readonly autofocus="" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Card Number</label>
                            <input type="text" name="cnum" autofocus="" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Expiry Date</label>
                            <input type="text" name="exp" autofocus="" placeholder="mm/yy" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>CVV</label>
                            <input type="text" name="cvv" autofocus="" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Pin</label>
                            <input type="password" name="pass" autofocus="" class="form-control">
                        </div>
                        <div class="form-group text-center">
                            <button type="submit" name="pay" class="btn btn-primary account-btn">Pay</button>
                        </div>
                    </form>
<?php
if (isset($_POST['pay'])) {
    $uid = $_POST['uid'];
    $amount = '500';
    $date = date("Y-m-d");
    include 'dbconnect.php';
    $sql = $con->query("INSERT INTO payments (uid, amt, datee) VALUES ('$uid', '$amount', '$date')");
    if ($sql) {
        $query = $con->query("UPDATE patients SET status = 'Pending' WHERE uid = '$uid'");
        if ($query) {
            echo("<script>alert('Registration Successful!'); window.location.href = '../hospital'</script>");
        }
        else {
            echo("<script>alert('Fail to register!');</script>");
        }
    }
    else {
        echo("<script>alert('Unable to pay! Please try again');</script>");
    }
}
?>
                </div>
			</div>
        </div>
    </div>
    <script src="dashboard/assets/js/jquery-3.2.1.min.js"></script>
	<script src="dashboard/assets/js/popper.min.js"></script>
    <script src="dashboard/assets/js/bootstrap.min.js"></script>
    <script src="dashboard/assets/js/app.js"></script>
</body>


<!-- login23:12-->
</html>
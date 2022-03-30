<!DOCTYPE html>
<html lang="en">


<!-- login23:11-->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
    <title>General Hospital</title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <style type="text/css">
        body {
            background: url(../admin.jpeg);
            background-color: rgba(0, 0, 0, 0.5);
            background-repeat: no-repeat;
            background-size: cover;
            background-blend-mode: darken;
        }
    </style>
</head>

<body>
    <div class="main-wrapper account-wrapper">
        <div class="account-page">
			<div class="account-center">
				<div class="account-box">
                    <form action="" method="post" class="form-signin">
						<div class="account-logo">
                            <a><img src="assets/img/logo-dark.png" alt=""></a>
                        </div>
                        <div class="form-group">
                            <label>User ID</label>
                            <input type="text" name="user_id" autofocus="" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="pass" autofocus="" class="form-control">
                        </div>
                        <div class="form-group text-center">
                            <button type="submit" name="login" class="btn btn-primary account-btn">Login</button>
                        </div>
                        <div class="form-group text-center">
                            <h2>OR</h2>
                            <a href="../">Back to Home!</a>
                        </div>
                    </form>
<?php
if (isset($_POST['login'])) {
        $user_id = $_POST['user_id'];
        $pass = $_POST['pass'];
        include '../dbconnect.php';
        session_start();
        $username = $user_id[0] . $user_id[1] . $user_id[2] . $user_id[3] . $user_id[4];
        if ($username == "admin" && $pass == "admin") {
            $img = 'assets/img/logo.png';
            $fullname = "Admin";
            $user = $user_id;
            $_SESSION['username'] = $username;
            $_SESSION['picture'] = $img;
            $_SESSION['fullname'] = $fullname;
            $_SESSION['user'] = $user;
            header("location: dashboard.php");
        }
        else {
            echo("<script>alert('Invalid User ID!');</script>");
        }
    }
?>
                </div>
			</div>
        </div>
    </div>
    <script src="assets/js/jquery-3.2.1.min.js"></script>
	<script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/app.js"></script>
</body>


<!-- login23:12-->
</html>
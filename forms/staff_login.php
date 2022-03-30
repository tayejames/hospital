<!DOCTYPE html>
<html lang="en">


<!-- login23:11-->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="../dashboard/assets/img/favicon.ico">
    <title>General Hospital</title>
    <link rel="stylesheet" type="text/css" href="../dashboard/assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../dashboard/assets/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="../dashboard/assets/css/style.css">
    <style type="text/css">
        body {
            background: url(../staff.jpeg);
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
                            <a><img src="../dashboard/assets/img/logo-dark.png" alt=""></a>
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
        $sql = $con->query("SELECT * FROM staffs WHERE email = '$user_id' AND pass = '$pass'");
        if ($sql->num_rows > 0) {
            $row = $sql->fetch_assoc();
            $fnam = $row['fnam'];
            $lnam = $row['lnam'];
            $user = $row['uid'];
            $img = 'img/' . $row['img'];
            $username = $user[0] . $user[1] . $user[2] . $user[3] . $user[4];
            $fullname = $fnam . " " . $lnam;
            $_SESSION['username'] = $username;
            $_SESSION['picture'] = $img;
            $_SESSION['fullname'] = $fullname;
            $_SESSION['user'] = $user;
            header("location: ../dashboard/dashboard.php");
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
    <script src="../dashboard/assets/js/jquery-3.2.1.min.js"></script>
	<script src="../dashboard/assets/js/popper.min.js"></script>
    <script src="../dashboard/assets/js/bootstrap.min.js"></script>
    <script src="../dashboard/assets/js/app.js"></script>
</body>


<!-- login23:12-->
</html>
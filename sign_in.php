<?php
session_start();
if (isset($_POST['signin'])) {

    $conn = mysqli_connect("localhost", "root", "", "travel");
    if ($conn->connect_errno > 0) {
        die("Unable to connect: " . $conn->connect_error);
    }

    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];
//fetch user info
    $sql_user = "SELECT * from users where user_email='" . $user_email . "' and user_password='" . $user_password . "' ";
    $results_user = mysqli_query($conn, $sql_user);
    $row_user = mysqli_fetch_row($results_user);

    $user_firstName = $row_user[1];
    $user_lastName = $row_user[2];
    $phn_num = $row_user[7];

    if (mysqli_num_rows($results_user) >= 1) {

        $_SESSION['user_firstName'] = $user_firstName;
        $_SESSION['user_lastName'] = $user_lastName;
        $_SESSION['user_email'] = $user_email;
        $_SESSION['user_password'] = $user_password;
        $_SESSION['phn_num'] = $phn_num;
        header('Location: http://localhost/project_dbms/home.php');
    } else {
        echo 'Does not match User Email And Password';
    }
}
?>
<html>
<head>
    <meta charset="UTF-8">
    <title>User SignUp FOrm</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
          integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/sign_in.css">
</head>
<body>
<div class="container">
    <div class="omb_login">
        <h3 class="omb_authTitle">Login or <a href="http://localhost/project_dbms/sign_up.php"
                                              style="font-size: 25px;">Sign up</a></h3>
        <div class="row omb_row-sm-offset-3 omb_socialButtons">
            <div class="col-xs-4 col-sm-2">
                <a href="https://www.facebook.com/" class="btn btn-lg btn-block omb_btn-facebook">
                    <i class="fa fa-facebook visible-xs"></i>
                    <span class="hidden-xs">Facebook</span>
                </a>
            </div>
            <div class="col-xs-4 col-sm-2">
                <a href="https://twitter.com/" class="btn btn-lg btn-block omb_btn-twitter">
                    <i class="fa fa-twitter visible-xs"></i>
                    <span class="hidden-xs">Twitter</span>
                </a>
            </div>
            <div class="col-xs-4 col-sm-2">
                <a href="https://www.google.com/" class="btn btn-lg btn-block omb_btn-google">
                    <i class="fa fa-google-plus visible-xs"></i>
                    <span class="hidden-xs">Google+</span>
                </a>
            </div>
        </div>
        <div class="row omb_row-sm-offset-3 omb_loginOr">
            <div class="col-xs-12 col-sm-6">
                <hr class="omb_hrOr">
                <span class="omb_spanOr">or</span>
            </div>
        </div>
        <div class="row omb_row-sm-offset-3">
            <div class="col-xs-12 col-sm-6">
                <form class="omb_loginForm" action="" autocomplete="off" method="POST">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                        <input type="text" class="form-control" name="user_email" placeholder="email address">
                    </div>
                    <span class="help-block"></span>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                        <input type="password" class="form-control" name="user_password" placeholder="Password">
                    </div>
                    <br>
                    <button class="btn btn-lg btn-primary btn-block" type="submit" name="signin">Login</button>
                </form>
            </div>
        </div>
        <div class="row omb_row-sm-offset-3">
            <div class="col-xs-12 col-sm-3">
                <label class="checkbox">
                    <input type="checkbox" value="remember-me">Remember Me
                </label>
            </div>
            <div class="col-xs-12 col-sm-3">
                <p class="omb_forgotPwd">
                    <a href="#">Forgot password?</a>
                </p>
            </div>
        </div>
    </div>
</div>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</body>
</html>
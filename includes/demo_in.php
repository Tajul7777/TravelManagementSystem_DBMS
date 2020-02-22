
<?php
session_start();
if (isset($_POST['signin'])) {
//    require '../includes/connection.php';
    $conn = mysqli_connect("localhost", "root", "", "travel");

    if ($conn->connect_errno > 0) {
        die("Unable to connect: " . $conn->connect_error);
    }
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];

    $sql = "SELECT * from users where user_email='" . $user_email . "' and user_password='" . $user_password . "' ";
    $results = mysqli_query($conn, $sql);
    $row = mysqli_fetch_row($result_pack);
    $user_firstName= $row[1];
    $user_lastName= $row[2];
//    $user_email= $row[3];
//    $user_password= $row[4];
    $phn_num= $row[7];
    if (mysqli_num_rows($results) >= 1) {
        $_SESSION['user_firstName'] = $user_firstName;
        $_SESSION['user_lastName'] =  $user_lastName;
        $_SESSION['user_email'] =  $user_email;
        $_SESSION['user_password'] = $user_password;
        $_SESSION['phn_num'] = $phn_num;
        header('Location: http://localhost/dbms_project/html/includes/home.php');
    } else {
        echo 'Something wrong';
    }
}
?>;










<html>
    <head>
        <meta charset="UTF-8">
        <title>User SignUp FOrm</title>

        <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="../css/bootstrap-theme.css">
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
        <link type="text/css" href="../fonts/FontAwesome.otf">
        <link rel="stylesheet" type="text/css" href="../css/book.css">

    </head>
    <body>

        <div class="container">


            <div class="omb_login">
                <h3 class="omb_authTitle">Login or <a href="#">Sign up</a></h3>
                <div class="row omb_row-sm-offset-3 omb_socialButtons">
                    <div class="col-xs-4 col-sm-2">
                        <a href="#" class="btn btn-lg btn-block omb_btn-facebook">
                            <i class="fa fa-facebook visible-xs"></i>
                            <span class="hidden-xs">Facebook</span>
                        </a>
                    </div>
                    <div class="col-xs-4 col-sm-2">
                        <a href="#" class="btn btn-lg btn-block omb_btn-twitter">
                            <i class="fa fa-twitter visible-xs"></i>
                            <span class="hidden-xs">Twitter</span>
                        </a>
                    </div>	
                    <div class="col-xs-4 col-sm-2">
                        <a href="#" class="btn btn-lg btn-block omb_btn-google">
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
                                <input  type="password" class="form-control" name="user_password" placeholder="Password">
                            </div>
<!--                    <span class="help-block">Password error</span>-->
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

            <script type="text/javascript" src="../js/bootstrap.min.js"></script>

        </div>
    </body>
</html>
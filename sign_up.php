<?php
session_start();

if (isset($_POST['signup'])) {

    $conn = mysqli_connect("localhost", "root", "", "travel");
    if ($conn->connect_errno > 0) {
        die("Unable to connect: " . $conn->connect_error);
    }
    //featch user information from form
    $user_firstName = $_POST['user_firstName'];
    $user_lastName = $_POST['user_lastName'];
    $user_email = $_POST['user_email'];
    $phn_num = $_POST['phn_num'];
    $user_password = $_POST['user_password'];

    //insert new user info into the database table
    $query_user = "INSERT INTO users (user_firstName, user_lastName,user_email,user_password,phn_num)
              VALUES ('" . $_POST["user_firstName"] . "','" . $_POST["user_lastName"] . "','" . $_POST["user_email"] . "',"
        . "'" . $_POST["user_password"] . "','" . $_POST["phn_num"] . "')";
    $result_user = mysqli_query($conn, $query_user);

    //featch this new user info
    $sql_user = "SELECT * from users where user_email='" . $user_email . "' and user_password='" . $user_password . "' ";
    $results_user = mysqli_query($conn, $sql_user);

    if (mysqli_num_rows($results_user) >= 1) {

        $_SESSION['user_firstName'] = $user_firstName;
        $_SESSION['user_lastName'] = $user_lastName;
        $_SESSION['user_email'] = $user_email;
        $_SESSION['user_password'] = $user_password;
        $_SESSION['phn_num'] = $phn_num;
        header('Location: http://localhost/project_dbms/home.php');
    } else {
        echo 'Something wrong in Sign_up.php';
    }
}
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
<head>
    <meta charset="UTF-8">
    <title>User SignUp FOrm</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
          integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/sign_up.css">
    <script src="js/sign_up.js"></script>
</head>
<body>
<div class="container" style="background: skyblue;">
    <h1 class="well">Registration Form</h1>
    <div class="col-lg-12 well" style="background: skyblue;">
        <div class="row">
            <form method="POST" name="form1" style="background: skyblue;">
                <div class="col-sm-12">
                    <div class="row">
                        <div class="col-sm-6 form-group">
                            <label>First Name</label>
                            <input type="text" placeholder="Enter First Name Here.." class="form-control"
                                   name="user_firstName">
                        </div>
                        <div class="col-sm-6 form-group">
                            <label>Last Name</label>
                            <input type="text" placeholder="Enter Last Name Here.." class="form-control"
                                   name="user_lastName">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Address</label>
                        <textarea placeholder="Enter Address Here.." rows="3" class="form-control address"
                                  name="address"></textarea>
                    </div>
                    <div class="row">
                        <div class="col-sm-4 form-group">
                            <label>City</label>
                            <input type="text" placeholder="Enter City Name Here.." class="form-control city"
                                   name="city">
                        </div>
                        <div class="col-sm-4 form-group">
                            <label>State</label>
                            <input type="text" placeholder="Enter State Name Here.." class="form-control state"
                                   name="state">
                        </div>
                        <div class="col-sm-4 form-group">
                            <label>Zip</label>
                            <input type="text" placeholder="Enter Zip Code Here.." class="form-control zip" name="zip">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 form-group">
                            <label>Password</label>
                            <input type="password" placeholder="Enter at least a 6 digit password"
                                   class="form-control pass" name="user_password" id="user_password" autocomplete="off">
                        </div>
                        <div class="col-sm-6 form-group">
                            <label>Confirm Password</label>
                            <input type="password" placeholder="Reeneter your password" class="form-control con_pass"
                                   name="con_pass">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Phone Number</label>
                        <input type="text" placeholder="Enter Phone Number Here.." class="form-control phn_number"
                               name="phn_num">
                    </div>
                    <div class="form-group">
                        <label>Email Address</label>
                        <input type="text" placeholder="Enter Email Address Here.." class="form-control email"
                               id="user_email" name="user_email" onBlur="checkAvailability()" autocomplete="off">
                        <span id="user-availability-status" style="font-size:12px;"></span>
                    </div>
                    <button type="submit" name="signup" id="submit" class="btn btn-lg btn-info"
                            onClick="return checkform();">Submit
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</body>
</html>

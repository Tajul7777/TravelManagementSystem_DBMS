<?php
session_start();
if (isset($_POST['signup'])) {
//    require '../includes/connection.php';
    $conn = mysqli_connect("localhost", "root", "", "travel");

    if ($conn->connect_errno > 0) {
        die("Unable to connect: " . $conn->connect_error);
    }
    $user_firstName = $_POST['user_firstName'];
    $user_lastName = $_POST['user_lastName'];
    $user_email = $_POST['user_email'];
    $phn_num = $_POST['phn_num'];
    $user_password = $_POST['user_password'];
    $query = "INSERT INTO users (user_firstName, user_lastName,user_email,user_password,phn_num)
        VALUES ('" . $_POST["user_firstName"] . "','" . $_POST["user_lastName"] . "','" . $_POST["user_email"] . "','" . $_POST["user_password"] . "','" . $_POST["phn_num"] . "')";
    $result = mysqli_query($conn, $query);

    $sql = "SELECT * from users where user_email='".$user_email."' ";

    $results = mysqli_query($conn, $sql);
    if (mysqli_num_rows($results) >= 1) {
        $_SESSION['user_firstName'] = $user_firstName;
        $_SESSION['user_lastName'] = $user_lastName;
        $_SESSION['user_email'] = $user_email;
        $_SESSION['phn_num'] = $phn_num;
        header('Location: http://localhost/dbms_project/html/includes/home.php');
    } else {
        echo 'Something wrong';
    }
}
?>;
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

        <link  rel="stylesheet" type="text/css" href="../css/bootstrap-theme.css">
        <link  rel="stylesheet" type="text/css" href="../css/bootstrap.css">
        <style>
            @import "font-awesome.min.css";
            @import "font-awesome-ie7.min.css";
            /* Space out content a bit */
            body {
                padding-top: 20px;
                padding-bottom: 20px;
            }

            /* Everything but the jumbotron gets side spacing for mobile first views */
            .header,
            .marketing,
            .footer {
                padding-right: 15px;
                padding-left: 15px;
            }

            /* Custom page header */
            .header {
                border-bottom: 1px solid #e5e5e5;
            }
            /* Make the masthead heading the same height as the navigation */
            .header h3 {
                padding-bottom: 19px;
                margin-top: 0;
                margin-bottom: 0;
                line-height: 40px;
            }

            /* Custom page footer */
            .footer {
                padding-top: 19px;
                color: #777;
                border-top: 1px solid #e5e5e5;
            }

            /* Customize container */
            @media (min-width: 768px) {
                .container {
                    max-width: 730px;
                }
            }
            .container-narrow > hr {
                margin: 30px 0;
            }

            /* Main marketing message and sign up button */
            .jumbotron {
                text-align: center;
                border-bottom: 1px solid #e5e5e5;
            }
            .jumbotron .btn {
                padding: 14px 24px;
                font-size: 21px;
            }

            /* Supporting marketing content */
            .marketing {
                margin: 40px 0;
            }
            .marketing p + h4 {
                margin-top: 28px;
            }

            /* Responsive: Portrait tablets and up */
            @media screen and (min-width: 768px) {
                /* Remove the padding we set earlier */
                .header,
                .marketing,
                .footer {
                    padding-right: 0;
                    padding-left: 0;
                }
                /* Space out the masthead */
                .header {
                    margin-bottom: 30px;
                }
                /* Remove the bottom border on the jumbotron for visual effect */
                .jumbotron {
                    border-bottom: 0;
                }
            }
        </style>
        <script>
            function checkAvailability() {

                $("#loaderIcon").show();
                jQuery.ajax({
                    url: "iccludes/check_availability.php",
                    data: 'user_email=' + $("#user_email").val(),
                    type: "POST",
                    success: function (data) {
                        $("#user-availability-status").html(data);
                        $("#loaderIcon").hide();
                    },
                    error: function () {}
                });
            }
        </script>
    </head>
    <body>
        <div class="container">
            <h1 class="well">Registration Form</h1>
            <div class="col-lg-12 well">
                <div class="row">
                    <form method="POST"  name="form1">
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-sm-6 form-group">
                                    <label>First Name</label>
                                    <input type="text" placeholder="Enter First Name Here.." class="form-control" name="user_firstName">
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label>Last Name</label>
                                    <input type="text" placeholder="Enter Last Name Here.." class="form-control" name="user_lastName">
                                </div>
                            </div>					
                            <div class="form-group">
                                <label>Address</label>
                                <textarea placeholder="Enter Address Here.." rows="3" class="form-control address" name="address"></textarea>
                            </div>	
                            <div class="row">
                                <div class="col-sm-4 form-group">
                                    <label>City</label>
                                    <input type="text" placeholder="Enter City Name Here.." class="form-control city" name="city">
                                </div>	
                                <div class="col-sm-4 form-group">
                                    <label>State</label>
                                    <input type="text" placeholder="Enter State Name Here.." class="form-control state" name="state">
                                </div>	
                                <div class="col-sm-4 form-group">
                                    <label>Zip</label>
                                    <input type="text" placeholder="Enter Zip Code Here.." class="form-control zip" name="zip">
                                </div>		
                            </div>
                            <div class="row">
                                <div class="col-sm-6 form-group">
                                    <label>Password</label>
                                    <input type="password" placeholder="Enter at least a 6 digit password" class="form-control pass" name="user_password">
                                </div>		
                                <div class="col-sm-6 form-group">
                                    <label>Confirm Password</label>
                                    <input type="password" placeholder="Reeneter your password" class="form-control con_pass" name="con_pass">
                                </div>	
                            </div>						
                            <div class="form-group">
                                <label>Phone Number</label>
                                <input type="text" placeholder="Enter Phone Number Here.." class="form-control phn_number" name="phn_num">
                            </div>		
                            <div class="form-group">
                                <label>Email Address</label>
                                <input type="text" placeholder="Enter Email Address Here.." class="form-control email" id="user_email" name="user_email" onBlur="checkAvailability()" autocomplete="off">
                                <span id="user-availability-status" style="font-size:12px;"></span> 

                            </div>	

                            <button type="submit" name="signup" id="submit" class="btn btn-lg btn-info" onClick="return checkform();">Submit</button>					
                        </div>
                    </form> 
                </div>
            </div>
        </div>

        <script>
//            function required(){
//                var empt1=document.forms["form1"]["user_firstName"].value;
//                var empt2=document.forms["form1"]["user_lastName"].value;
////                var empt3=document.forms["form1"]["user_email"].value;
////                var re = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
////                var flag=re.value;
//                if(empt1 === "" || empt2 === ""){
//                     alert("Fill all the specific fields with valid information");
//                }
////                            else if(empt2=== ""){
////                                 alert("Fill all the specific fields with valid information");
////                            } else if(flag !==empt3){
////                    alert("Fill all the specific fields with valid information");
////                }
//             
//                
//            }
            function checkform() {
                if (document.form1.user_email.value === "") {
                    alert("please enter email");
                    return false;
                } else {
                    document.form1.submit();
                }
            }

        </script>
        <script src="../js/jquery-1.11.3.min.js"></script>

        <script src="../js/bootstrap.min.js"></script>
    </body>
</html>

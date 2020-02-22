<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "travel");

if ($conn->connect_errno > 0) {
    die("Unable to connect: " . $conn->connect_error);
}
$user_email = $_SESSION['user_email'];
$user_password = $_SESSION['user_password'];

$query_user = "SELECT * from users where user_email='" . $user_email . "' and user_password='" . $user_password . "' ";
$result_user = mysqli_query($conn, $query_user);
$row_user = mysqli_fetch_row($result_user);
$user_id = $row_user[0];
$user_firstName = $row_user[1];
$user_lastName = $row_user[2];
$phn_num = $row_user[7];

$pack_book_id = intval($_GET['pack_id']);

if (isset($_POST['book'])) {


    $fromDate = $_POST['fromDate'];
    $toDate = $_POST['toDate'];
    $no_passengers = $_POST['no_passengers'];
    $comments = $_POST['comments'];

    $query_bookdetails = "INSERT INTO `booking_details`(`user_id`, `pack_id`, `user_email`, `fromDate`, `toDate`, `comments`, `no_passengers`)"
        . " VALUES ('" . $user_id . "','" . $pack_book_id . "','" . $user_email . "','" . $_POST['fromDate'] . "','" . $_POST['toDate'] . "',"
        . "'" . $_POST['comments'] . "','" . $_POST['no_passengers'] . "')";
    $result_bookdetails = mysqli_query($conn, $query_bookdetails);

    $sql_bookdetails = "SELECT * from booking_details where user_id='" . $user_id . "' ";
    $results_bookdetails = mysqli_query($conn, $sql_bookdetails);

    $query_packinfo="SELECT pack_price
                     FROM packages
                     WHERE pack_id=".$pack_book_id;
    $result_packinfo=mysqli_query($conn, $query_packinfo);
    $row_packinfo=mysqli_fetch_row($result_packinfo);
    $book_price=$no_passengers*$row_packinfo[0];
    echo "$book_price";

    if (mysqli_num_rows($results_bookdetails) >= 1) {

        header("Location: http://localhost/project_dbms/packages.php");
    } else {
        echo 'Problem in Booking';
    }

}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title> Hotel Reservation Form </title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
          integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
    <link href="css/book.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="css/pack_details.css">
    <link href="css/stylesheet.css" rel='stylesheet' type='text/css'/>
    <link rel="stylesheet" href="css/camera.css">
    <link rel="stylesheet" href="css/owl.carousel.css">
    <link rel="stylesheet" href="css/packages.css">
    <script type="text/javascript" src="js/pack_details.js"></script>
    <script type="text/javascript" src="js/jquery.js"></script>
    <script src="js/jquery-migrate-1.2.1.js"></script>
    <script src="js/superfish.js"></script>
    <script src="js/jquery.ui.totop.js"></script>
    <script src="js/jquery.equalheights.js"></script>
    <script src="js/jquery.mobilemenu.js"></script>
    <script src="js/jquery.easing.1.3.js"></script>
    <script src="js/owl.carousel.js"></script>
    <script src="js/camera.js"></script>
    <script src="js/jquery.mobile.customized.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>

    <style>
        html, body {
            background: whitesmoke;
        }

        .errorWrap {
            padding: 10px;
            margin: 0 0 20px 0;
            background: #fff;
            border-left: 4px solid #dd3d36;
            -webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
            box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
        }

        .succWrap {
            padding: 10px;
            margin: 0 0 20px 0;
            background: #fff;
            border-left: 4px solid #5cb85c;
            -webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
            box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
        }
    </style>
    <script type="javascript">

    </script>

</head>
<body>
<header>
    <div class="container_12">
        <div class="grid_12">
            <div class="menu_block">
                <nav class="horizontal-nav full-width horizontalNav-notprocessed" style="list-style: none;">
                    <ul class="sf-menu" style="list-style: none;">
                        <li><a href="home.php">ABOUT</a></li>
                        <li class="current"><a href="packages.php">HOT TOURS</a></li>
                        <li><a href="index-2.html">SPECIAL OFFERS</a></li>
                        <li><a href="index-3.html">BLOG</a></li>
                        <li><a href="index-4.html">CONTACTS</a></li>
                    </ul>
                </nav>
                <div class="clear"></div>
            </div>
        </div>
        <div class="grid_12">
            <h1><b>
                    <a href="home.php">
                        <img src="a_pics/logo.png" alt="Bangladesh Tourism" class="img-responsive">
                    </a></b>
            </h1>
        </div>
    </div>
</header>
<br>
<div class="container col-sm-6 col-sm-offset-3"
     style="background-color: skyblue; margin-top: -80px; position: relative; border: 5px solid navy;">
    <br>

    <form method="post">
        <div class="form-group">
            <label class="inputLabel">From Date</label>
            <div class='input-group date' id='datetimepicker'>
                <input type='text' name="fromDate" class="form-control" id='datepicker' placeholder="dd-mm-yyyy"
                       onclick="date();"/>
                <span class="input-group-addon" id='datepicker'>
                        <span class="glyphicon glyphicon-calendar" id='datepicker'></span>
                    </span>
            </div>
        </div>
        <div class="form-group">
            <label class="inputLabel">To Date</label>
            <div class='input-group date' id='datepicker'>
                <input type='text' name="toDate" class="form-control" placeholder="dd-mm-yyyy" id="datepicker"/>
                <span class="input-group-addon" id="datepicker">
                        <span class="glyphicon glyphicon-calendar" id="datepicker"></span>
                    </span>
            </div>
        </div>
        <div class="form-group">
            <label class="inputLabel">Number Of Travelers</label>
            <input class="form-control numtravel" type="text" name="no_passengers" required="">
        </div>
        <div class="form-group">
            <label class="inputLabel">Comment</label>
            <input class="form-control special" type="text" name="comments" required="">
        </div>

        <div class="form-group col-sm-3" style="text-align: center;">
            <label class="inputLabel"></label>
            <input class="form-control special" type="submit" name="book"  id="submit">
        </div>
    </form>
</div>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery-1.11.3.min.js">
</body>
</html>
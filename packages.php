<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "travel");

if ($conn->connect_errno > 0) {
    die("Unable to connect: " . $conn->connect_error);
}
//fetch user info using session
$user_email = $_SESSION['user_email'];
$user_password = $_SESSION['user_password'];

//fetch user info using login info
$query_user = "SELECT * from users where user_email='" . $user_email . "' and user_password='" . $user_password . "' ";
$results_user = mysqli_query($conn, $query_user);
$row_pack = mysqli_fetch_row($results_user);

$user_firstName = $row_pack[1];
$user_lastName = $row_pack[2];
$phn_num = $row_pack[7];

if (mysqli_num_rows($results_user) >= 1) {
    $_SESSION['user_firstName'] = $user_firstName;
    $_SESSION['user_lastName'] = $user_lastName;
    $_SESSION['user_email'] = $user_email;
    $_SESSION['user_password'] = $user_password;
    $_SESSION['phn_num'] = $phn_num;
} else {
    echo 'Something wrong';
}
//fetch package infp
$sql_pack = "SELECT * FROM packages";
$result_pack = mysqli_query($conn, $sql_pack);
?>

<html>
<head>
    <title>Hot Tours</title>
    <meta charset="utf-8">
    <meta name="format-detection" content="telephone=no"/>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
          integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="icon" href="favicon.ico">
    <link rel="shortcut icon" href="favicon.ico"/>
    <link rel="stylesheet" href="css/packages.css">
    <link rel="stylesheet" type="text/css" href="css/pack_details.css">
    <script src="js/jquery.js"></script>
    <script src="js/jquery-migrate-1.2.1.js"></script>
    <script src="js/script.js"></script>
    <script src="js/superfish.js"></script>
    <script src="js/jquery.ui.totop.js"></script>
    <script src="js/jquery.equalheights.js"></script>
    <script src="js/jquery.mobilemenu.js"></script>
    <script src="js/jquery.easing.1.3.js"></script>
    <script src="js/packages.js"></script>
    <style>
        a {
            text-decoration: none !important;
        }

        html, body {

        }
    </style>
</head>
<body>
<!--==============================header=================================-->
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
            <h1>
                <a href=".home.php">
                    <img src="a_pics/logo.png" alt="Bangladesh Tourism" class="img-responsive">
                </a>
            </h1>
        </div>
    </div>
</header>
<!--==============================Content=================================-->

<div class="container">
    <div class="row">
        <div class="selectroom_top">
            <div class="content" style="background: #002141; ">
                <div class="container_12">
                    <div class="banners">
                        <?php while ($row_pack = mysqli_fetch_row($result_pack)) {
                            ?>
                            <div class="grid_4 col-sm-4">
                                <div class="banner" style="border: 2px solid #FFFFFF;">
                                    <img src="a_pics/<?php echo "$row_pack[7]"; ?>" alt="">
                                    <div class="label">
                                        <div class="title"><?php echo "$row_pack[1]"; ?></div>
                                        <div class="price">from<span><?php echo "$row_pack[4]"; ?></span></div>
                                        <a style="list-style: none;"
                                           href="pack_details.php?pack_id=<?php echo "$row_pack[0]"; ?>">LEARN MORE</a>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<!--==============================footer=================================-->
<footer style="border: 1px solid black;">
    <div class="container_12">
        <div class="grid_12">
            <div class="socials">
                <a href="#" class="fa fa-facebook"></a>
                <a href="#" class="fa fa-twitter"></a>
                <a href="#" class="fa fa-google-plus"></a>
            </div>
            <div class="copy">
                Bangladesh Tourism (c) 2017 | <a href="#">Privacy Policy</a> | All Right Reserved By Rp Foundation
            </div>
        </div>
    </div>
</footer>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous"></script>

</body>
</html>
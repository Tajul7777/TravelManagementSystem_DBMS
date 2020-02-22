<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "travel");
if ($conn->connect_errno > 0) {
    die("Unable to connect: " . $conn->connect_error);
}

//get user email and password using session
$user_email = $_SESSION['user_email'];
$user_password = $_SESSION['user_password'];

//pick user info using email and password
$sql_user = "SELECT * from users where user_email='" . $user_email . "' and user_password='" . $user_password . "' ";
$results_user = mysqli_query($conn, $sql_user);
$row_user = mysqli_fetch_row($results_user);

$user_firstName = $row_user[1];
$user_lastName = $row_user[2];
$phn_num = $row_user[7];

//pick last 3 package information
$query = "SELECT * FROM (
  SELECT * FROM packages ORDER BY pack_id DESC LIMIT 3
) as t ORDER BY pack_id";
$result = mysqli_query($conn, $query);

//pick last review information
$query2 = "SELECT * from (review NATURAL JOIN review_details) ORDER by review_id DESC LIMIT 1";
$result2 = mysqli_query($conn, $query2);

if (mysqli_num_rows($results_user) >= 1) {
    $_SESSION['user_firstName'] = $user_firstName;
    $_SESSION['user_lastName'] = $user_lastName;
    $_SESSION['user_email'] = $user_email;
    $_SESSION['user_password'] = $user_password;
    $_SESSION['phn_num'] = $phn_num;
} else {
    echo 'Something wrong in home.php';
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
    <title>Your Trip Our Plan</title>
    <meta charset="utf-8">
    <meta name="format-detection" content="telephone=no"/>
    <link href="https://fonts.googleapis.com/css?family=Fredericka+the+Great" rel="stylesheet">
    <link rel="icon" href="images/favicon.ico">
    <link type="text/css" rel="shortcut icon" href="images"/>
    <link type="text/css" rel="stylesheet" href="booking/css/booking.css">
    <link type="text/css" rel="stylesheet" href="css/camera.css">
    <link type="text/css" rel="stylesheet" href="css/owl.carousel.css">
    <link type="text/css" rel="stylesheet" href="css/packages.css">
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/jquery-migrate-1.2.1.js"></script>
    <script type="text/javascript" src="js/superfish.js"></script>
    <script type="text/javascript" src="js/jquery.ui.totop.js"></script>
    <script type="text/javascript" src="js/jquery.equalheights.js"></script>
    <script type="text/javascript" src="js/jquery.mobilemenu.js"></script>
    <script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
    <script type="text/javascript" src="js/owl.carousel.js"></script>
    <script type="text/javascript" src="js/camera.js"></script>
    <script type="text/javascript" src="js/jquery.mobile.customized.min.js"></script>
    <script type="text/javascript" src="booking/js/booking.js"></script>
    <script type="text/javascript" src="js/home.js"></script>
    <style>
        html, body {
            background: #002141;
        }
    </style>
</head>
<body class="page1" id="top" style="background:  #002141;">
<!--==============================header=================================-->
<header>
    <div class="container_12">
        <div class="grid_12">
            <div class="menu_block">
                <nav class="horizontal-nav full-width horizontalNav-notprocessed">
                    <ul class="sf-menu">
                        <li class="current"><a href="home.php">ABOUT</a></li>
                        <li><a href="packages.php">HOT TOURS</a></li>
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
                <a href="home.php">
                    <img src="a_pics/logo.png" alt="Bangladesh Travel" class="img-responsive">
                </a>
            </h1>
        </div>
    </div>
</header>
<div class="slider_wrapper">
    <div id="camera_wrap" class="">
        <div data-src="images/slide.jpg">
            <div class="caption fadeIn">
                <h2 style="color: tomato; font-family: 'Fredericka the Great', cursive;"><b>Long Tour</b></h2>
                <div class="price">
                    <b> From</b>
                    <span><b>Tk 10,000</b></span>
                </div>
                <a href="#">LEARN MORE</a>
            </div>
        </div>
        <div data-src="images/slide1.jpg">
            <div class="caption fadeIn">
                <h2 style="color: tomato;font-family: 'Fredericka the Great', cursive;"><b>Mid Tour</b></h2>
                <div class="price">
                    <b> From</b>
                    <span><b>Tk 5,000</b></span>
                </div>
                <a href="#">LEARN MORE</a>
            </div>
        </div>
        <div data-src="images/slide2.jpg">
            <div class="caption fadeIn">
                <h2 style="color: tomato;font-family: 'Fredericka the Great', cursive;"><b>Short Tour</b></h2>
                <div class="price">
                    <b> From</b>
                    <span><b>Tk 1,000</b></span>
                </div>
                <a href="#">LEARN MORE</a>
            </div>
        </div>
    </div>
</div>
<!--==============================Content=================================-->
<div class="content" style="background:  #002141;">
    <div class="container_12">
        <?php while ($row1 = mysqli_fetch_row($result)) {
            ?>
            <div class="grid_4">
                <div class="banner" style="border: 2px solid #FFFFFF;">
                    <img src="a_pics/<?php echo "$row1[7]"; ?>" alt="">
                    <div class="label">
                        <div class="title"><?php echo "$row1[3]"; ?></div>
                        <div class="price">FROM<span><?php echo "$row1[4]"; ?></span></div>
                        <a href="pack_details.php?pack_id=<?php echo "$row1[0]"; ?>">LEARN MORE</a>
                    </div>
                </div>
            </div>
        <?php } ?>

        <div class="clear"></div>
        <div class="grid_6">
            <h3 style="color: #FFFFFF;">Booking Form</h3>
            <form id="bookingForm" style="color: #FFFFFF">
                <div class="fl1">
                    <div class="tmInput">
                        <input name="Name" placeHolder="Name:" type="text"
                               data-constraints='@NotEmpty @Required @AlphaSpecial'>
                    </div>
                    <div class="tmInput">
                        <input name="Country" placeHolder="Country:" type="text" data-constraints="@NotEmpty @Required">
                    </div>
                </div>
                <div class="fl1">
                    <div class="tmInput">
                        <input name="Email" placeHolder="Email:" type="text"
                               data-constraints="@NotEmpty @Required @Email">
                    </div>
                    <div class="tmInput mr0">
                        <input name="Hotel" placeHolder="Hotel:" type="text" data-constraints="@NotEmpty @Required">
                    </div>
                </div>
                <div class="clear"></div>
                <strong>Check-in</strong>
                <br>
                <label class="tmDatepicker">
                    <input type="text" name="Check-in" placeHolder='10/05/2014'
                           data-constraints="@NotEmpty @Required @Date">
                </label>
                <div class="clear"></div>
                <strong>Check-out</strong>
                <br>
                <label class="tmDatepicker">
                    <input type="text" name="Check-out" placeHolder='20/05/2014'
                           data-constraints="@NotEmpty @Required @Date">
                </label>
                <div class="clear"></div>

                <div class="clear"></div>
                <div class="fl1 fl2">
                    <em>Adults</em>
                    <select name="Adults" class="tmSelect auto" data-class="tmSelect tmSelect2" data-constraints="">
                        <option>1</option>
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                    </select>
                    <div class="clear"></div>
                    <em>Rooms</em>
                    <select name="Rooms" class="tmSelect auto" data-class="tmSelect tmSelect2" data-constraints="">
                        <option>1</option>
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                    </select>
                </div>
                <div class="fl1 fl2">
                    <em>Children</em>
                    <select name="Children" class="tmSelect auto" data-class="tmSelect tmSelect2" data-constraints="">
                        <option>0</option>
                        <option>0</option>
                        <option>1</option>
                        <option>2</option>
                    </select>
                </div>
                <div class="fl1 fl2">
                    <em>Transport </em>
                    <select name="Children" class="tmSelect auto" data-class="tmSelect tmSelect2" data-constraints="">
                        <option>Yes</option>
                        <option>No</option>
                    </select>
                </div>
                <div class="clear"></div>
                <div class="tmTextarea">
                    <textarea name="Message" placeHolder="Message"
                              data-constraints='@NotEmpty @Required @Length(min=20,max=999999)'></textarea>
                </div>
                <a href="#" class="btn" data-type="submit">Submit</a>
            </form>
        </div>
        <div class="grid_5 prefix_1">
            <h3 style="color: #FFFFFF">Welcome</h3>
            <img src="a_pics/hello-bangladesh.jpg" alt="" class="img_inner fleft">
            <div class="extra_wrapper">
                <p>Lorem ipsum dolor sit ere amet, consectetur ipiscin.
                    In mollis erat mattis neque facilisis, sit ametiol
                </p>
            </div>
            <p>Proin pharetra luctus diam, a scelerisque eros convallis Proin pharetra luctus diam, a scelerisque eros
                convallis </p>
            <h4 style="color: #FFFFFF;">Clients’ Quotes</h4>
            <blockquote class="bq1">
                <img src="images/page1_img2.jpg" alt="" class="img_inner noresize fleft">
                <div class="extra_wrapper">
                    <p style="margin-left: 16px;"> Duis massa elit, auctor non pellentesque vel, aliquet sit amet erat.
                        Nullam eget dignissim nisi, aliquam feugiat nibh. </p>
                    <div class="alright">
                        <div class="col1">Miranda Brown</div>
                        <a href="#" class="btn">More</a>
                    </div>
                </div>
            </blockquote>
        </div>
        <div class="grid_12">
            <h3 class="head1">Latest News</h3>
        </div>
        <div class="grid_4">
            <div class="block1">
                <time datetime="2014-01-01">10<span>Jan</span></time>
                <div class="extra_wrapper">
                    <div class="text1 col1"><a href="#">Aliquam nibh</a></div>
                    Proin pharetra luctus diam, any scelerisque eros convallisumsan. Maecenas vehicula egestas
                </div>
            </div>
        </div>
        <div class="grid_4">
            <div class="block1">
                <time datetime="2014-01-01">21<span>Jan</span></time>
                <div class="extra_wrapper">
                    <div class="text1 col1"><a href="#">Etiam dui eros</a></div>
                    Any scelerisque eros vallisumsan. Maecenas vehicula egestas natis. Duis massa elit, auctor non
                </div>
            </div>
        </div>
        <div class="grid_4">
            <div class="block1">
                <time datetime="2014-01-01">15<span>Feb</span></time>
                <div class="extra_wrapper">
                    <div class="text1 col1"><a href="#">uamnibh Edeto</a></div>
                    Ros convallisumsan. Maecenas vehicula egestas venenatis. Duis massa elit, auctor non
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
                Bangladesh Travel (c) 2017 | <a href="#">Privacy Policy</a> | Developed & Designed By RP foundation
            </div>
        </div>
    </div>
</footer>
</body>
</html>

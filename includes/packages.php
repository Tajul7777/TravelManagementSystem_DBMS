 <?php
         session_start();
        include('includes/connection.php');
        $user_email = $_SESSION['user_email'];
        $user_password = $_SESSION['user_password'];

        $query = "SELECT * from users where user_email='" . $user_email . "' and user_password='" . $user_password . "' ";
        $results = mysqli_query($conn, $query);
        $row = mysqli_fetch_row($results);
        $user_firstName = $row[1];
        $user_lastName = $row[2];
//    $user_email= $row[3];
//    $user_password= $row[4];
        $phn_num = $row[7];
        if (mysqli_num_rows($results) >= 1) {
            $_SESSION['user_firstName'] = $user_firstName;
            $_SESSION['user_lastName'] = $user_lastName;
            $_SESSION['user_email'] = $user_email;
            $_SESSION['user_password'] = $user_password;
            $_SESSION['phn_num'] = $phn_num;
            
        } else {
            echo 'Something wrong';
        }
        $sql = "SELECT * FROM packages";
        $result = mysqli_query($conn, $sql);
        
       
        ?>


<html>
    <head>
        <title>Hot Tours</title>
        <meta charset="utf-8">
        <meta name="format-detection" content="telephone=no" />
        <link rel="icon" href="images/favicon.ico">
        <link rel="shortcut icon" href="images/favicon.ico" />
        <link rel="stylesheet" href="css/style.css">
        <script src="js/jquery.js"></script>
        <script src="js/jquery-migrate-1.2.1.js"></script>
        <script src="js/script.js"></script>
        <script src="js/superfish.js"></script>
        <script src="js/jquery.ui.totop.js"></script>
        <script src="js/jquery.equalheights.js"></script>
        <script src="js/jquery.mobilemenu.js"></script>
        <script src="js/jquery.easing.1.3.js"></script>
        <script>
            $(document).ready(function () {
                $().UItoTop({easingType: 'easeOutQuart'});
            });
        </script>
        <!--[if lt IE 8]>
        <div style=' clear: both; text-align:center; position: relative;'>
                <a href="http://windows.microsoft.com/en-US/internet-explorer/products/ie/home?ocid=ie6_countdown_bannercode">
                        <img src="http://storage.ie6countdown.com/assets/100/images/banners/warning_bar_0000_us.jpg" border="0" height="42" width="820" alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today." />
                </a>
        </div>
        <![endif]-->
        <!--[if lt IE 9]>
        <script src="js/html5shiv.js"></script>
        <link rel="stylesheet" media="screen" href="css/ie.css">
        <![endif]-->
    </head>
    <body>
       <!--==============================header=================================-->
        <header>
            <div class="container_12">
                <div class="grid_12">
                    <div class="menu_block">
                        <nav class="horizontal-nav full-width horizontalNav-notprocessed">
                            <ul class="sf-menu">
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
                        <a href="home.php">
                            <img src="images/logo.png" alt="Your Happy Family">
                        </a>
                    </h1>
                </div>
            </div>
        </header>
        <!--==============================Content=================================-->

       


        <div class="content">
            <div class="container_12">

                <div class="banners">
<?php while ($row = mysqli_fetch_row($result)) {
    ?>
                        <div class="grid_4">
                            <div class="banner">
                                <img src="../a_pics/<?php echo "$row[7]"; ?>" alt="">
                                <div class="label">
                                    <div class="title"><?php echo "$row[1]"; ?></div>
                                    <div class="price">from<span><?php echo "$row[4]"; ?></span></div>
                                    <a href="pack_details.php?pack_id=<?php echo "$row[0]"; ?>">LEARN MORE</a>
                                </div>

                            </div>
                        </div><?php } ?>
                </div>
            </div>
        </div>  
  <!--==============================footer=================================-->
        <footer>
            <div class="container_12">
                <div class="grid_12">
                    <div class="socials">
                        <a href="#" class="fa fa-facebook"></a>
                        <a href="#" class="fa fa-twitter"></a>
                        <a href="#" class="fa fa-google-plus"></a>
                    </div>
                    <div class="copy">
                        Your Trip (c) 2014 | <a href="#">Privacy Policy</a> | Website Template Designed by TemplateMonster.com
                    </div>
                </div>
            </div>
        </footer>

    </body>
</html>
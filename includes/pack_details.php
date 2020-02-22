<?php
session_start();
include('includes/connection.php');
$user_email = $_SESSION['user_email'];
$user_password = $_SESSION['user_password'];
$query1 = "SELECT * from users where user_email='" . $user_email . "' and user_password='" . $user_password . "' ";
$result1 = mysqli_query($conn, $query1);
$row1 = mysqli_fetch_row($result1);
$user_id = $row1[0];
$user_firstName = $row1[1];
$user_lastName = $row1[2];
//    $user_email= $row1[3];
//    $user_password= $row1[4];
$phn_num = $row1[7];
$pack_book_id = intval($_GET['pack_id']);
if (isset($_POST['book'])) {
    $fromDate = $_POST['fromDate'];
    $toDate = $_POST['toDate'];
    $numtravel = $_POST['numtravel'];
    $comments = $_POST['comments'];

    $query2 = "INSERT INTO `booking_details`(`user_id`, `pack_id`, `user_email`, `fromDate`, `toDate`, `comments`, `no_passengers`)"
            . " VALUES ('$user_id','$pack_book_id','$user_email','" . $_POST['fromDate'] . "','" . $_POST['toDate'] . "','" . $_POST['comments'] . "','" . $_POST['numtravel'] . "')";
    $result2 = mysqli_query($conn, $query2);

    $query3 = "SELECT * from booking_details where user_id='" . $user_id . "' ";

    $result3 = mysqli_query($conn, $query3);
    if (mysqli_num_rows($result3) >= 1) {
        echo 'Successful';
    } else {
        echo 'Try Again';    
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
        <title>Your Trip Our Plan</title>
        <link  rel="stylesheet" type="text/css" href="../css/bootstrap-theme.css">
        <link  rel="stylesheet" type="text/css" href="../css/bootstrap.css">
        <link href="../css/stylesheet.css" rel='stylesheet' type='text/css' />
        <link href='//fonts.googleapis.com/css?family=Open+Sans:400,700,600' rel='stylesheet' type='text/css'>
        <link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300' rel='stylesheet' type='text/css'>
        <link href='//fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
        <link href="../css/font-awesome.css" rel="stylesheet">
        <script>
            $(function () {
                $("#datepicker,#datepicker1").datepicker();
            });
        </script>
        <style>
            .errorWrap {
                padding: 10px;
                margin: 0 0 20px 0;
                background: #fff;
                border-left: 4px solid #dd3d36;
                -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
                box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
            }
            .succWrap{
                padding: 10px;
                margin: 0 0 20px 0;
                background: #fff;
                border-left: 4px solid #5cb85c;
                -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
                box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
            }
        </style>				

    </head>
    <body>
        <?php
        $conn = mysqli_connect("localhost", "root", "", "travel");
        if ($conn->connect_errno > 0) {
            die("Unable to connect: " . $conn->connect_error);
        }

        $pack_id = intval($_GET['pack_id']);
        $query4= "SELECT * FROM packages where pack_id=" . $pack_id;
        $result4 = mysqli_query($conn, $query4);
        $row = mysqli_fetch_row($result4);

        $query5 = "SELECT stayplan.daynum, stayplan.placename, stayplan.sightseeing, stayplan.hotels, stayplan.meals, stayplan.transport
                            FROM (packages NATURAL JOIN pack_plan) NATURAL JOIN (stayplan)
                            WHERE pack_id=" . $pack_id;
        $result5 = mysqli_query($conn, $query5);
        ?>

        <!--     Header Part  Start  -->
        <div class="selectroom">
            <div class="container">	
                <div class="selectroom_top">
                    <div class="col-md-4 selectroom_left wow fadeInLeft animated" data-wow-delay=".5s">
                        <img src="../a_pics/<?php echo "$row[7]"; ?>" alt="">
                    </div>
                    <div class="col-md-8 selectroom_right wow fadeInRight animated" data-wow-delay=".5s">
                        <h2></h2>
                        <p class="dow"><?php echo "$row[0]"; ?></p>
                        <p class="fa fa-angle-double-down"> <b>Package Type :</b> <?php echo "$row[2]"; ?></p><br>
                        <p class="fa fa-location-arrow"> <b>Package Location :</b> <?php echo "$row[3]"; ?></p><br>
                        <p class="fa fa-square-o"> <b>Features :</b> Air Conditioning , Balcony / Terrace / Customizable Tour / Satellite </p><br>
                        <p class="fa fa-dashboard"> <b>Pay & Hold :</b>Pay Tk 1,00 per person now and hold the 
                            package at this price, payment as per policy can be made in the next 24/48 hrs. Holding of seats are
                            subject to availability and in case of non availability of selected seats you can choose from a wide
                            range of departures. To avail this option, click "Book Now".</p>
                        <p class="fa fa-calculator"> <b>Strat From :</b> <?php echo "$row[4]"; ?></p>
                        <div class="clearfix"></div>
                        <br>
                        <div class="col-sm-4">
                            <p> <b>Inclusions:</b></p>
                            <ul style="list-style: none;">
                                <li><a class="fa fa-plane fa-2x"></a></li>
                                <li style="margin-left: 2px;"><a class="fa fa-bed fa-2x"></a></li>
                                <li style="margin-left: 10px;"><a class="fa fa-car fa-2x"></a></li>
                                <li style="margin-left: 10px;"><a class="fa fa-cutlery fa-2x"></a></li>
                            </ul>
                        </div>
                        <div class="col-sm-4 col-sm-offset-2">
                            <p> <b>Stay Plan : </b></p>
                            <p>Srimangal 1 Night</p>
                            <p>Moulvibazar 2 Night</p>
                            <p>jaflong & Radargul 1 Night</p>
                            <p>Bachnakandi 1 Night</p>
                            </ul>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <!-- Header Part End -->
        <!--     Package Details Start  -->
        <div class="selectroom">
            <div class="container">
                <div class="row">	
                    <div class="selectroom_top">
                        <h3>Package Details</h3>
                        <p style="padding-top: 1%">&quot;
                            <?php echo "$row[6]"; ?> </p>	
                    </div>
                </div>
            </div>
        </div>   
        <!--     Package Details End  -->

        <!-- Inclusion Table Start  -->
        <div class="selectroom">
            <div class="container">
                <div class="row">	
                    <div class="selectroom_top">
                        <h3> InClusion Table</h3><br><br>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Day</th>
                                    <th>Place Name</th>
                                    <th>Sight Seeing</th>
                                    <th>Hotels</th>
                                    <th>Meals</th>
                                    <th>Transport</th>
                                </tr>
                            </thead>
                            <?php while ($rows = mysqli_fetch_row($result5)) {
                                ?>
                                <tbody>
                                    <tr>
                                        <th scope="row"><?php echo "$rows[0]"; ?></th>
                                        <td><?php echo "$rows[1]"; ?></td>
                                        <td><?php echo "$rows[2]"; ?></td>
                                        <th scope="row"><?php echo "$rows[3]"; ?></th>
                                        <td><?php echo "$rows[4]"; ?></td>
                                        <td><?php echo "$rows[5]"; ?></td>
                                    </tr>
                                </tbody>
                            <?php } ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- Inclusion Table End  -->

        <!--     Booking  Start  -->

        <!--     Booking Button   -->
        <div class="selectroom">
            <div class="container">
                <div class="row">	
                    <div class="selectroom_top">
                        <ul style="list-style: none;">
                            <li align="center">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo" name="submit">Book</button>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>  <!--     Booking Button End   -->

        <!--     Booking   Modal Strat -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="exampleModalLabel">New message</h4>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">

                                <label for="" class="inputLabel">From </label>
                                <input class="date form-control" id="datepicker" type="text" placeholder="dd-mm-yyyy"  name="fromDate" required="">

                            </div>
                            <div class="form-group">

                                <label for="" class="inputLabel">To </label>
                                <input class="date form-control" id="datepicker1" type="text" placeholder="dd-mm-yyyy"  name="toDate" required="">

                            </div>
                            <div class="form-group">
                                <label class="inputLabel">Number Of Travelers</label>
                                <input class="form-control numtravel" type="text" name="numtravel" required="">
                            </div>
                            <div class="form-group">
                                <label class="inputLabel">Comment</label>
                                <input class="form-control special" type="text" name="comments" required="">
                            </div>

                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" name="book" >Send message</button>
                    </div>
                </div>
            </div>
        </div><!--     Booking   Modal End -->

        <!--     Booking  Script Start  -->
        <script>
            $('#exampleModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget); // Button that triggered the modal
                var recipient = button.data('whatever'); // Extract info from data-* attributes
                // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
                // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
                var modal = $(this)
                modal.find('.modal-title').text('New message to ' + recipient)
                modal.find('.modal-body input').val(recipient)
            });</script>
        <!--     Booking  Script Start  -->

        <!--     Booking  End  -->
        <script src="js/jquery-1.11.3.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>

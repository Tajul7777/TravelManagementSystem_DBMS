<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "travel");

if ($conn->connect_errno > 0) {
    die("Unable to connect: " . $conn->connect_error);
}
$user_email = $_SESSION['user_email'];
$user_password = $_SESSION['user_password'];

$query1 = "SELECT * from users where user_email='" . $user_email . "' and user_password='" . $user_password . "' ";
$result1 = mysqli_query($conn, $query1);
$row1 = mysqli_fetch_row($result1);
$user_id = $row1[0];
$user_firstName = $row1[1];
$user_lastName = $row1[2];
$phn_num = $row1[7];

$pack_book_id = intval($_GET['pack_id']);


if (isset($_POST['book'])) {

    
    $fromDate = $_POST['fromDate'];
    $toDate = $_POST['toDate'];
    $no_passengers = $_POST['no_passengers'];
    $comments = $_POST['comments'];

    $query2 = "INSERT INTO `booking_details`(`user_id`, `pack_id`, `user_email`, `fromDate`, `toDate`, `comments`, `no_passengers`)"
            . " VALUES ('" . $user_id . "','" . $pack_book_id . "','" . $user_email . "','" . $_POST['fromDate'] . "','" . $_POST['toDate'] . "',"
            . "'" . $_POST['comments'] . "','" . $_POST['no_passengers'] . "')";
    $result2 = mysqli_query($conn, $query2);

    $query3 = "SELECT * from booking_details where user_id='" . $user_id . "' ";
    $result3 = mysqli_query($conn, $query3);

    if (mysqli_num_rows($result3) >= 1) {
        echo 'Successfully Booked';
    } else {
        echo 'Problem in Booking';
    }
}

?>
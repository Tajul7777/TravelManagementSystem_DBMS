<?php
$conn = mysqli_connect("localhost", "root", "", "travel");

if ($conn->connect_errno > 0) {
    die("Unable to connect: " . $conn->connect_error);
}
?>;
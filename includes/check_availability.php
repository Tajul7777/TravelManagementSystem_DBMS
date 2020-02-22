<?php
require_once("includes/connection.php");
// code admin email availablity
if (!empty($_POST["user_email"])) {
    $user_email = $_POST["user_email"];
    if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {

        echo "error : You did not enter a valid email.";
    } else {
        $sql = "SELECT user_email FROM users WHERE user_email=" . $user_email;
        $query = $conn->prepare($sql);
        $query->bindParam(':user_email', $user_email, PDO::PARAM_STR);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_OBJ);
        $cnt = 1;
        if ($query->rowCount() > 0) {
            echo "<span style='color:red'> Email already exists .</span>";
            echo "<script>$('#submit').prop('disabled',true);</script>";
        } else {

            echo "<span style='color:green'> Email available for Registration .</span>";
            echo "<script>$('#submit').prop('disabled',false);</script>";
        }
    }
}
?>;
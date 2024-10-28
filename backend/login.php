<?php
/* A PHP code that is used to login a user. */
require_once "./db.php";
session_start();
if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM `pharm_user` WHERE `email`='$email' AND `password`='$password'";
    $result = $conn->query($sql);

    /* Checking if the user is an admin or not. */
    if ($result->num_rows > 0) {
        $_SESSION['user'] = $email;
        $sql = "SELECT `status` FROM `pharm_user` WHERE `email`='$email'";
        $res = $conn->query($sql);
        if ($res) {
            while ($stat = mysqli_fetch_assoc($res)) {
                $state = $stat['status'];
                header("Location: ../report.php");
                // if ($state == 1) {
                //     header("Location: ../report.php");
                // } else {
                //     header("Location: ../index.php?msg=Access Denied");
                // }
            }
        } else {
            echo "error";
        }
    } else {
        header("Location: ../index.php?msg=Email or Password is incorrect");
    }
} else {
    echo 'not set';
}

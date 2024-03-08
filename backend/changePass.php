<?php
require './db.php';
function updatePass($conn, $pass, $email){
    $upd = $conn->query("UPDATE `pharm_user` SET `password` = '$pass' WHERE `email` = '$email'");
    if($upd){
        header("Location: ../password.php?msg=Your Password Is Changed&status=200");
    }
}
if(isset($_POST['submit'])){
    $pass = $_POST['current'];
    $newPass = $_POST['newPass'];
    $confPass = $_POST['confPass'];
    $email = $_POST['email'];

    $sql=$conn->query("SELECT * FROM `pharm_user` WHERE `email` = '$email'");
    while($row = $sql->fetch_assoc()){
        $id = $row['id'];
        $currentPass = $row['password'];
    }

    if($newPass != $confPass){
        header("Location: ../password.php?msg=Passwords Doesn't Match&status=401");
    }elseif($pass != $currentPass){
        header("Location: ../password.php?msg=Your Current Password Is Incorrect&status=401");
    }else{
        updatePass($conn, $newPass, $email);
    }

    
}


?>
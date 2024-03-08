<?php
require "db.php";
$id = $_GET['id'];
$delete = $conn->query("DELETE FROM `paymentmethod` WHERE `id` = '$id'");
if($delete){
    header("Location: ../payments.php?msg=Deleted&status=200");
}

?>
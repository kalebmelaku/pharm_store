<?php
require './db.php';
$id = $_GET['id'];

$sql = $conn->query("UPDATE `medicines` SET `approved` = 1 WHERE `med_id` = '$id'");

if ($sql) {
    header("Location: ../approve.php?msg=Approved&status=200");
} else {
    header("Location: ../approve.php?msg=Error Approving&status=401");
}

?>
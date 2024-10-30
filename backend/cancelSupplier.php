<?php
require './db.php';

$id = $_GET['id'];
$sql = $conn->query("DELETE FROM `suppliers` WHERE `id` = '$id'");
if ($sql) {
    header("Location: ../suppliers.php?msg=Supplier Removed&status=200");
}
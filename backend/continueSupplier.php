<?php
require './db.php';

$id = $_GET['id'];
$sql = $conn->query("SELECT * FROM `suppliers` WHERE `id` = '$id'");
while ($row = $sql->fetch_assoc()){
    $quantity = $row['quantity'];
    $invoice_number = $row['invoice_no'];
    header("Location: ../addSupplier.php?step=2&invoice_number=$invoice_number&quantity=$quantity");
}


?>
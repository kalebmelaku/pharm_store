<?php
require './db.php';
if (isset($_POST['payInvoice'])) {
    echo $invoiceInput = $_POST['invoiceNumber'];
    $invoiceName = $_POST['name'];
    $invoiceTotal = $_POST['price'];
    $paymentMethod = $_POST['paymentMethod'];
    $referenceNo = $_POST['referenceNo'];

    $insert = $conn->query("INSERT INTO `suppliers_payment`(`name`, `invoice_no`, `total_amount`, `payment_method`, `reference_no`) VALUES (
            '$invoiceName','$invoiceInput','$invoiceTotal','$paymentMethod','$referenceNo')");

    if ($insert) {
        $update = $conn->query("UPDATE `suppliers` SET `status`= 1 WHERE `invoice_no` = '$invoiceInput'");
        if (!$update) {
            echo 'update error: ' . $conn->error;
        } else {
            header("Location: ../suppliers.php?msg=Payment Done&status=200");
        }
    } else {
        echo 'insert error: ' . $conn->error;
    }
}else if(isset($_POST['payInvoice'])){
    echo 'hello!';
}

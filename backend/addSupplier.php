<?php
require 'db.php';


if (isset($_POST['nextForm'])) {
    $name = $_POST['name'];
    $invoice_number = $_POST['invoice_number'];
    $quantity = $_POST['quantity'];

    $insert_supplier = $conn->query("INSERT INTO `suppliers`( `name`, `invoice_no`, `quantity`) VALUES ('$name', '$invoice_number', '$quantity')");
    if ($insert_supplier) {
        header("Location: ../addSupplier.php?step=2&invoice_number=$invoice_number&quantity=$quantity");
    } else {
        echo $conn->error;
    }
} else if (isset($_POST['submit'])) {
    $invoice_number = $_POST['invoice_number'];
    $list = $_POST['list'];
    for ($i = 1; $i <= $list; $i++) {
        $name = $_POST["name$i"];
        $type = $_POST["type$i"];
        $price = $_POST["price$i"];
        $date = $_POST["date$i"];
        $quantity = $_POST["quantity$i"];

        $insert_temp = $conn->query("INSERT INTO `temp_meds`(`name`, `type`, `price`, `quantity`, `exdate`, `invoice_no`) VALUES ('$name', '$type', '$price', '$quantity', '$date', '$invoice_number')");
        if ($insert_temp) {
            header("Location: ../addSupplier.php?step=3&invoice_number=$invoice_number");
        } else {
        }
    }
} else {
    echo $invoice_number = @$_GET['invoice'];

   // get all from temp
    $getAll = $conn->query("SELECT * FROM `temp_meds` WHERE `invoice_no` = '$invoice_number'");
    $getTotal = $conn->query("SELECT SUM(price) AS `total` FROM `temp_meds` WHERE `invoice_no` = '$invoice_number'");
    $rs = $getTotal->fetch_assoc();
    $totalInvoice = $rs['total'];
    $total = 0;
    while ($row = $getAll->fetch_assoc()) {
        $name = $row['name'];
        $type = $row['type'];
        $price = $row['price'];
        $quantity = $row['quantity'];
        $exdate = $row['exdate'];
        $total += $price * $quantity;
        //update invoice table
        $update = $conn->query("UPDATE `suppliers` SET `total_amount` = '$total' WHERE `invoice_no` = '$invoice_number'");
        if ($update) {
            //insert to pharm_store
            $insert_meds = $conn->query("INSERT INTO `pharm_store`(`name`, `type`, `amount`, `purchase_price`, `exdate`, `invoice_no`) VALUES (
                '$name', '$type', '$quantity', '$price', '$exdate', '$invoice_number'
            )");

            if($insert_meds){
                header("Location: ../suppliers.php?status=200&msg=Medicine Successfully Added");
            }
        }
    }
}

<?php
require './db.php';
$med_id = $_POST['med_id'];
if (isset($_POST['updateBtn'])) {
    $name = $_POST['name'];
    $type = $_POST['type'];
    $amount = $_POST['amount'];
    $price = $_POST['purchasePrice'];
    $expDate = $_POST['expDate'];
    $now = date('Y-m-d');
    $update = $conn->query("UPDATE `pharm_store` SET `name`='$name',`type`='$type',`amount`='$amount',`purchase_price`='$price',`date`= '$now',`exdate`='$expDate' WHERE `id` = '$med_id'");
    if (!$update) {
        header("Location: ../updateMedicine.php?msg=Unable to Update Item&status=401&id=$med_id");
    } else {
        header("Location: ../updateMedicine.php?msg=Item Updated&status=200&id=$med_id");
    }
} else if (isset($_POST['deleteBtn'])) {
    $search = $conn->query("SELECT `amount` FROM `medicines` WHERE `med_id` = '$med_id'");
    $rs = $search->fetch_assoc();
    if ($rs['amount'] > 0) {
        header("Location: ../updateMedicine.php?msg=Unable to Delete Item Exist in Pharmacy&status=401&id=$med_id");
    } else {
        echo 'unavailable';
        $delete = $conn->query("DELETE FROM `pharm_store` WHERE `id` = '$med_id' ");
        if ($delete) {
            $conn->query("DELETE FROM `medicines` WHERE `med_id` = '$med_id' ");
            header("Location: ../home.php?msg=Deleted&status=200");
        } else {
            header("Location: ../home.php?msg=Error Deleting&status=401");
        }
    }
}

<?php
require './db.php';
$med_id = $_POST['med_id'];
if (isset($_POST['updateBtn'])) {
    $name = $_POST['name'];
    $type = $_POST['type'];
    $price = $_POST['purchasePrice'];
    $expDate = $_POST['expDate'];
    $now = date('Y-m-d');
    // echo $price;
    $update = $conn->query("UPDATE `medicines` SET `name`='$name',`type`='$type',`sell_price`='$price',`exdate`='$expDate' WHERE `med_id` = '$med_id'");
    if (!$update) {
        header("Location: ../updatePharmacy.php?msg=Unable to Update Item&status=401&id=$med_id");
    } else {
        header("Location: ../updatePharmacy.php?msg=Item Updated&status=200&id=$med_id");
    }
} else if (isset($_POST['deleteBtn'])) {              
    $search = $conn->query("SELECT `amount` FROM `medicines` WHERE `med_id` = '$med_id'");
    $rs = $search->fetch_assoc();
    if ($rs['amount'] > 0) {
        header("Location: ../updatePharmacy.php?msg=Unable to Delete Item Exist in Pharmacy&status=401&id=$med_id");
    } else {
        // $delete = $conn->query("DELETE FROM `pharm_store` WHERE `id` = '$med_id' ");
        $delete = $conn->query("DELETE FROM `medicines` WHERE `med_id` = '$med_id' ");
        if ($delete) {
            header("Location: ../pharmacy.php?msg=Deleted&status=200");
        } else {
            header("Location: ../pharmacy.php?msg=Error Deleting&status=401");
        }
    }
}

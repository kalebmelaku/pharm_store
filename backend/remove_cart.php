<?php
require "db.php";
$id = $_GET['rn'];
$phone_user = $_GET['user'];
$sel = "SELECT * FROM `cart` WHERE `id`='$id' AND `user_id`='$phone_user'";
$pro = $conn->query($sel);
while ($row = $pro->fetch_assoc()) {
    $quant_cart = $row['quant'];
    $med = "SELECT * FROM `meds` WHERE `id`='$id'";
    $medd = $conn->query($med);
    while ($rows = $medd->fetch_assoc()) {
        $quant_med = $rows['amount'];
        $new = $quant_cart + $quant_med;
        $upd = "UPDATE `meds` SET `amount` = '$new' WHERE `id` = '$id'";
        $resl = $conn->query($upd);
        if ($resl) {
            $sql = "DELETE FROM `cart` WHERE `id` = '$id' AND `user_id` = '$phone_user'";
            $res = $conn->query($sql);
            if ($res) {
                header("Location: ../Pharmacy/index.php?msg=Deleted");
            } else {
                header("Location: ../Pharmacy/index.php?err=Failed to Delete");
            }
        }else{
            echo mysqli_error($conn);
        }
    }
}
// $sql = "DELETE FROM `cart` WHERE `id` = '$id'";
// $res = $conn->query($sql);
// if($res){
//     header("Location: ../Users/Pharmacy/index.php?msg=Deleted");
// }else{
//     header("Location: ./Users/Pharmacy/index.php?err=Failed to Delete");
// }

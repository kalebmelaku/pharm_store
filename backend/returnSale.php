<?php
require 'db.php';
$postData = file_get_contents('php://input');

if (!empty($postData)) {
    $data = json_decode($postData, true);
    if ($data !== null) {
        // Access the data
        $med_id = $data['med_id'];
        $sale = $data['sale'];
        $amount = $data['amount'];
        $today = date('Y-m-d');
        $sql = $conn->query("SELECT * FROM `pharmacy_sale` WHERE `id` = '$med_id' AND `payment` = '$sale' AND `date` = '$today'");
        $row = $sql->fetch_assoc();
        $old_amount = $row['quan'];
        $price = $row['price'];
        if ($amount > $old_amount) {
            header("Location: ../return.php?msg=Amount is larger than sold number&status=401");
        } else {
            $sold = $old_amount - $amount;
            $new_price = $sold * $price;
            $sql_upd = $conn->query("UPDATE `pharmacy_sale` SET `quan`='$sold',`sub_price`='$new_price' WHERE `id` = '$med_id' AND `payment` = '$sale' AND `date` = '$today'");
            if($sql_upd){
                $sel_med = $conn->query("SELECT * FROM `medicines` WHERE `med_id` = '$med_id'");
                $rows = $sel_med->fetch_assoc();
                echo $org_amount = $rows['amount'];
                echo $new_amount = $org_amount + $amount;
                $upd = $conn->query("UPDATE `medicines` SET `amount` = '$new_amount' WHERE `med_id`='$med_id'");
                if($upd){
                    header("Location: ../return.php?msg=Returned&status=200");
                }else{
                    echo $conn->error;
                }
            }
        }
        // echo json_encode();
        // header("Location: ../return.php?msg=Got it&status=200");
    }
}

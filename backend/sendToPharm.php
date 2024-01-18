<?php
require './db.php';
if (isset($_POST['send'])) {
    $medid = $_POST['med_id'];
    $amount = $_POST['amount'];
    $sellPrice = $_POST['price'];

    $fetchMed = $conn->query("SELECT * FROM `pharm_store` WHERE `id` = '$medid'");
    while ($row = $fetchMed->fetch_assoc()) {
        $name = $row['name'];
        $type = $row['type'];
        $org_amount = $row['amount'];
        $price = $row['price'];
        $exp_date = $row['exdate'];

        //check amount
        if ($amount > $org_amount || $org_amount == 0) {
            header("Location: ../sendMedicine.php?msg=Not Enough Amount&id=$medid&status=401");
        } else {
            //new amount from org_amount
            $new_amount = $org_amount - $amount;
            $conn->query("UPDATE `pharm_store` SET `amount`='$new_amount' WHERE `id` = '$medid' ");

            //search if it exists and update the amount
            $search = $conn->query("SELECT `amount` FROM `meds` WHERE `med_id` = '$medid' ");
            $rows = $search->fetch_assoc();
            if ($search->num_rows > 0) {
                $new_meds_amount = $rows['amount'] + $amount;
                $update = $conn->query("UPDATE `meds` SET `amount` = '$new_meds_amount', `price` = '$sellPrice' WHERE `med_id` = '$medid' ");
                if ($update) {
                    header("Location: ../sendMedicine.php?msg=Medicine Sent to Pharmacy&id=$medid&status=200");
                }else{
                    echo $conn->error;
                }
            } else {

                $insert = $conn->query("INSERT INTO `meds`(`med_id`,`name`, `type`, `amount`, `price`, `exdate`) VALUES ('$medid','$name','$type','$amount','$sellPrice','$exp_date')");
                if ($insert) {
                    header("Location: ../sendMedicine.php?msg=Medicine Sent to Pharmacy&id=$medid&status=200");
                } else {
                    echo $conn->error;
                }
            }
        }
    }
}

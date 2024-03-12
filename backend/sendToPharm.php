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
        $price = $row['purchase_price'];
        $exp_date = $row['exdate'];

        //check amount
        if ($amount > $org_amount || $org_amount == 0) {
            header("Location: ../sendMedicine.php?msg=Not Enough Amount&id=$medid&status=401");
        } else {
            //new amount from org_amount
            $new_amount = $org_amount - $amount;
            $conn->query("UPDATE `pharm_store` SET `amount`='$new_amount' WHERE `id` = '$medid' ");

            //search if it exists and update the amount
            $search = $conn->query("SELECT `amount` FROM `medicines` WHERE `med_id` = '$medid' ");
            $rows = $search->fetch_assoc();
            if ($search->num_rows > 0) {
                $new_meds_amount = $rows['amount'] + $amount;
                $update = $conn->query("UPDATE `medicines` SET `amount` = '$new_meds_amount', `sell_price` = '$sellPrice' WHERE `med_id` = '$medid' ");
                if ($update) {
                    header("Location: ../sendMedicine.php?msg=Medicine Sent to Pharmacy&id=$medid&status=200");
                } else {
                    echo $conn->error;
                }
            } else {

                $insert = $conn->query("INSERT INTO `medicines`(`med_id`,`name`, `type`, `amount`, `sell_price`, `purchase_price`, `exdate`) VALUES ('$medid','$name','$type','$amount','$sellPrice', '$price', '$exp_date')");
                if ($insert) {
                    $conn->query("UPDATE `pharm_store` SET `sell_price`='$sellPrice' WHERE `id` = '$medid' ");
                    header("Location: ../sendMedicine.php?msg=Medicine Sent to Pharmacy&id=$medid&status=200");
                } else {
                    echo $conn->error;
                }
            }
        }
    }
}

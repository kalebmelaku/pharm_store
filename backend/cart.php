<?php
require './db.php';

if (isset($_POST['submit'])) {
    $id = $_POST['name'];
    $type = $_POST['book'];
    $quant = $_POST['quant'];
    $med_id = $_POST['med_id'];
    $pat_id = $_POST['pat_id'];
    $user_id = $_POST['user_id'];

    $sql = $conn->query("SELECT * FROM `meds` WHERE `id` = '$id'");
    if(mysqli_num_rows($sql) > 0){
        while($row = $sql->fetch_assoc()){
            $pd_id = $row['id'];
            $pd_name = $row['name'];
            $pd_price = $row['price'];
            $amount = $row['amount'];
            $t_price = $pd_price * $quant;
            $sql2 = $conn->query("SELECT * FROM `cart` WHERE `id` = '$pd_id' AND `user_id` = '$user_id'");
            if($sql2){
                //if the medicine is registered with same pharmacy user
                $row = $sql2->fetch_array();
                if($amount >= $quant){
                    $nw_amount = $amount - $quant;
                    $update = "UPDATE `meds` SET `amount` = '$nw_amount' WHERE `id` = '$id'";
                    if($row[0] > 1){
                        $query = "UPDATE `cart` SET `quant`='$quant',`sub_price`='$t_price' WHERE `id`='$pd_id' AND `user_id` = '$user_id'";
                        $rs2 = mysqli_query($conn, $query);
                        if (!$rs2) {
                            echo "Not Updated".$conn->error;
                        } else {
                            $conn->query($update);
                            header("Location:../Pharmacy/index.php?msg=Updated");
                        }
                    }else{
                        $query = "INSERT INTO `cart` (`id`, `name`, `type`, `price`,`quant`, `sub_price`, `pat_id`, `user_id`) values 
                        ('$pd_id', '$pd_name', '$type', '$pd_price', '$quant', '$t_price', '$pat_id', '$user_id')";
                        $rs2 = mysqli_query($conn, $query);
                        if (!$rs2) {
                            // header("Location:./Pharmacy/admission.php?msg=Nothing Added");
                            echo 'Error adding new '.$conn->error;
                        } else {
                            $conn->query($update);
                            header("Location:../Pharmacy/index.php");
                        }
                    }
                }else{
                    
                    header("Location:../Pharmacy/index.php?msg=Not enough amount");
                }
            }else{
                //if the medicine is registered with different pharmacy user
            }
        }
    }else{
        echo "medicine not found";
    }


}

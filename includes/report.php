<?php
require './backend/db.php';

//sell profit
$selectSale = $conn->query("SELECT * FROM `cash_payment_pharm` WHERE MONTH(`date`) = '$month_num' AND YEAR(`date`) = $year");
$total_revenue = 0;
$total_cost = 0;
if ($selectSale->num_rows > 0) {
    while ($row = $selectSale->fetch_assoc()) {
        $med_id = $row['rn'];
        $quantity = $row['quan'];
        $total_sold_price = $row['sub_price']; //total sold of each

        $total_revenue += $total_sold_price;

        //select purchase price for each medicine
        $selectPurchasePrice = $conn->query("SELECT `purchase_price` FROM `meds` WHERE `med_id` = '$med_id'");
        $rs = $selectPurchasePrice->fetch_assoc();
        $purchasePrice = $rs['purchase_price'];

        $total_cost += ($quantity * $purchasePrice);
    }
    $profit = $total_revenue - $total_cost;
    
} else {
    $profit = 0;
    echo $conn->error;
}

//total unpaid suppliers
$selectSuppliers = $conn->query("SELECT SUM(`total_amount`) AS 'total_unpaid' FROM `suppliers` WHERE `status` = 0");
$result = $selectSuppliers->fetch_assoc();
$total_unpaid = $result['total_unpaid'];


$month = array(
    "01" => 'January',
    "02" => 'February',
    "03" => 'March',
    "04" => 'April',
    "05" => 'May',
    "06" => 'June',
    "07" => 'July',
    "08" => 'August',
    "09" => 'September',
    "10" => 'October',
    "11" => 'November',
    "12" => 'December'
);

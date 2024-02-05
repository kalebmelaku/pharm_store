<?php
require_once '../backend/db.php';
if (isset($_GET['year'])) {
    $year = $_GET['year'];
    $selectMonth = $conn->query("SELECT MONTHNAME(date) AS month, SUM(sub_price) AS amount FROM `cash_payment_pharm` WHERE YEAR(date) = '$year' GROUP BY month ORDER BY `date` ASC");
    $data = [];
    if ($selectMonth->num_rows > 0) {
        while ($row = $selectMonth->fetch_assoc()) {
            $data[] = $row;
        }
        echo json_encode($data);
    }
} else {
    $year = explode("-", date('Y-m-d'))[0];
    $selectMonth = $conn->query("SELECT DISTINCT MONTHNAME(date) AS month, SUM(sub_price) AS amount FROM `cash_payment_pharm` WHERE YEAR(date) = '$year'");
    $data = [];
    if ($selectMonth->num_rows > 0) {
        while ($row = $selectMonth->fetch_assoc()) {
            $data[] = $row;
        }
    }
    echo json_encode($data);
}

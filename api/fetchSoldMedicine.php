<?php
require '../backend/db.php';
$med_id = $_GET['med_id'];
$today = date('Y-m-d');
$sql = $conn->query("SELECT * FROM `pharmacy_sale` WHERE `id` = '$med_id' AND `date` = '$today'");
$data = [];
while ($row = $sql->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode($data);

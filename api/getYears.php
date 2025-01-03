<?php
require_once  "../backend/db.php";

$fetchYear = $conn->query("SELECT DISTINCT YEAR(date) AS year FROM `pharmacy_sale` ORDER BY `date` ASC");
$years = [];

if($fetchYear->num_rows > 0){
    while($row = $fetchYear->fetch_assoc()){
        $years[] = $row['year'];
    }
}
echo json_encode($years);
?>
<?php
require_once '../backend/db.php';
$year = $_GET['year'];
$result = $conn->query("SELECT
MONTHNAME(s.date) AS month,
m.name,
SUM(s.sub_price - (s.quan * m.purchase_price)) AS profit
FROM
`pharmacy_sale` s
INNER JOIN
`medicines` m on s.id = m.med_id
WHERE YEAR(s.date) = '$year' AND `payment` != 'Credit'
GROUP BY month ORDER BY `date` ASC
");

$data = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}
echo json_encode($data);

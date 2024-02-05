<?php
require_once '../backend/db.php';
$year = $_GET['year'];
$result = $conn->query("SELECT
MONTHNAME(date) AS month,
m.name,
(s.sub_price - (s.quan * m.purchase_price)) AS profit
FROM
`cash_payment_pharm` s
INNER JOIN
`meds` m on s.id = m.med_id
WHERE YEAR(s.date) = '$year'
GROUP BY month ORDER BY `date` ASC
");

$data = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}
echo json_encode($data);

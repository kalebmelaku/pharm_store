<?php
require './db.php';
$year = $_GET['year'];
$result = $conn->query("SELECT
    YEAR(s.date) AS year,
    m.name,
    SUM(s.quan * m.sell_price) AS cost_price,
    SUM(s.quan * m.purchase_price) AS purchase_price,
    SUM(s.sub_price - (s.quan * m.purchase_price)) AS profit
FROM
    `pharmacy_sale` s
INNER JOIN
    `medicines` m ON s.id = m.med_id
WHERE
    YEAR(s.date) = '$year' AND `payment` != 'Credit'
GROUP BY
    year, m.name
ORDER BY
    s.date ASC;

");
$row = $result->fetch_assoc();
$profit = $row['profit'];
$total_cost = $row['purchase_price'];
$total_revenue = $row['cost_price'];


// Set the name of the file to be downloaded
$filename = "data_export_" . date('Ymd') . ".csv";

// Set headers to force download the file as Excel-compatible CSV
header("Content-Disposition: attachment; filename=\"$filename\"");
header("Content-Type: text/csv; charset=utf-8");
header("Pragma: no-cache");
header("Expires: 0");


$output = fopen('php://output', 'w');
// Query to fetch data from the table

$sql = "SELECT 
    SUM(CASE WHEN suppliers.status = 0 THEN suppliers.total_amount ELSE 0 END) AS total_unpaid_amount,
    SUM(CASE WHEN suppliers.status = 1 THEN suppliers_payment.total_amount ELSE 0 END) AS total_paid_amount
FROM 
    suppliers
LEFT JOIN 
    suppliers_payment ON suppliers.invoice_no = suppliers_payment.invoice_no
WHERE 
    (suppliers.status = 0 AND YEAR(suppliers.date) = '$year') OR
    (suppliers.status = 1 AND YEAR(suppliers_payment.date) = '$year');
";


$result = $conn->query($sql);

// Check if the query returns any rows
if ($result->num_rows > 0) {
    // Fetch the field names (column headers)
    $fields = $result->fetch_fields();
    $headerRow = ['Total Unpaid Suppliers', 'Total Paid Suppliers', 'Total Expense', 'Total Net Sell'];
    fputcsv($output, $headerRow);
    while ($row = $result->fetch_assoc()) {
        $data = [
            $row['total_unpaid_amount'] . ' BIRR',
            $row['total_paid_amount'] . ' BIRR',
            $total_cost . ' BIRR',
            $profit . ' BIRR',
        ];
        fputcsv($output, $data); // Output the data row by row
    }
    $totalRow = array_fill(0, count($headerRow) - 1, ''); // Empty columns except the last
    fputcsv($output, $totalRow);
} else {
    echo "No records found!";
}

// Close the database connection
$conn->close();
fclose($output);

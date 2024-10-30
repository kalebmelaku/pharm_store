<?php
require './db.php';

$year = $_GET['year'];

// Fetch the aggregated totals for cost, revenue, and profit
$result1 = $conn->query("SELECT
    YEAR(s.date) AS year,
    SUM(s.quan * m.sell_price) AS cost_price,
    SUM(s.quan * m.purchase_price) AS purchase_price,
    SUM(s.sub_price - (s.quan * m.purchase_price)) AS profit
FROM
    `pharmacy_sale` s
INNER JOIN
    `medicines` m ON s.id = m.med_id
WHERE
    YEAR(s.date) = '$year' AND `payment` != 'Credit'
");
$row1 = $result1->fetch_assoc();
$profit = $row1['profit'];
$total_cost = $row1['purchase_price'];
$total_revenue = $row1['cost_price'];

// Set the name of the file to be downloaded
$filename = "data_export_" . date('Ymd') . ".csv";

// Set headers to force download the file as Excel-compatible CSV
header("Content-Disposition: attachment; filename=\"$filename\"");
header("Content-Type: text/csv; charset=utf-8");
header("Pragma: no-cache");
header("Expires: 0");

$output = fopen('php://output', 'w');

// Define the header row and write it
$headerRow = ['Total Unpaid Suppliers', 'Total Paid Suppliers', 'Total Expense', 'Total Sell', 'Total Net Sell'];
fputcsv($output, $headerRow);

// Query to fetch the unpaid and paid totals
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

$result2 = $conn->query($sql);

// Check if the query returns any rows
if ($result2->num_rows > 0) {
    while ($row2 = $result2->fetch_assoc()) {
        // Prepare the data row with formatted values
        $data = [
            number_format($row2['total_unpaid_amount'], 2, '.', ',') . ' BIRR',
            number_format($row2['total_paid_amount'], 2, '.', ',') . ' BIRR',
            number_format($total_cost, 2, '.', ',') . ' BIRR',
            number_format($total_revenue, 2, '.', ',') . ' BIRR',
            number_format($profit, 2, '.', ',') . ' BIRR'
        ];
        
        // Write the data row
        fputcsv($output, $data);
    }
} else {
    echo "No records found!";
}

// Close the database connection
$conn->close();
fclose($output);

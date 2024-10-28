<?php
require './db.php';
// Set the name of the file to be downloaded
$filename = "data_export_" . date('Ymd') . ".csv";

// Set headers to force download the file as Excel-compatible CSV
header("Content-Disposition: attachment; filename=\"$filename\"");
header("Content-Type: text/csv; charset=utf-8");
header("Pragma: no-cache");
header("Expires: 0");

$output = fopen('php://output', 'w');
// Query to fetch data from the table
if($_GET['page'] == 'inventory'){
    $sql = "SELECT name,type,amount,sell_price,purchase_price FROM `pharm_store` WHERE `amount` != 0";
}else{
    $sql = "SELECT name,type,amount,sell_price,purchase_price FROM `medicines` WHERE `amount` != 0";
}
$result = $conn->query($sql);

$totalSubTotal = 0;

// Check if the query returns any rows
if ($result->num_rows > 0) {
    // Fetch the field names (column headers)
    $fields = $result->fetch_fields();

    // Output the column names as the first row, plus the new sub_total column
    $headerRow = [];
    foreach ($fields as $field) {
        $headerRow[] = $field->name; // Get the column name
    }
    $headerRow[] = 'sub_total'; // Add sub_total as the new column

    // Write the column headers to the output as CSV
    fputcsv($output, $headerRow);

    // Output each row of the data
    while ($row = $result->fetch_assoc()) {
        // Calculate sub_total (amount * purchase_price)
        $subTotal = $row['amount'] * $row['purchase_price'];

        // Add sub_total to the row data
        $row['sub_total'] = $subTotal;

        // Accumulate sub_total to get the total
        $totalSubTotal += $subTotal;

        // Write the row data to the CSV file
        fputcsv($output, $row); // Output the data row by row
    }

    // Add a total row at the bottom
    $totalRow = array_fill(0, count($headerRow) - 1, ''); // Empty columns except the last
    $totalRow[] = $totalSubTotal; // Add total in the sub_total column

    // Output the total row
    fputcsv($output, $totalRow);
} else {
    echo "No records found!";
}

// Close the database connection
$conn->close();
fclose($output);

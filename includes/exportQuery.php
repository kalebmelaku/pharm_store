<?php

$totals = "SELECT
YEAR(s.date) AS year,
SUM(s.quan * m.sell_price) AS cost_price,
SUM(s.quan * m.purchase_price) AS purchase_price,
SUM(s.sub_price - (s.quan * m.purchase_price)) AS profit
FROM
    `pharmacy_sale` s
INNER JOIN
    `medicines` m ON s.id = m.med_id
WHERE
YEAR(s.date) = '$year' AND `payment` != 'Credit'";

$pay_status = "SELECT 
SUM(CASE WHEN suppliers.status = 0 THEN suppliers.total_amount ELSE 0 END) AS total_unpaid_amount,
SUM(CASE WHEN suppliers.status = 1 THEN suppliers_payment.total_amount ELSE 0 END) AS total_paid_amount
FROM 
    suppliers
LEFT JOIN 
    suppliers_payment ON suppliers.invoice_no = suppliers_payment.invoice_no
WHERE 
(suppliers.status = 0 AND YEAR(suppliers.date) = '$year') OR
(suppliers.status = 1 AND YEAR(suppliers_payment.date) = '$year');";


?>
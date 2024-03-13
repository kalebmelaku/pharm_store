<?php
require './backend/db.php';
require './backend/auth.php';
$id = $_GET['id'];
$payment = $_GET['payment'];
$pat_name = $_GET['pat_name'];
if (empty($id)) {
    header("Location: ./admission.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Invoice | Detail</title>
    <link rel="icon" href="favicon.ico">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css" rel="stylesheet" />
    <link href="./style/alert.css" rel="stylesheet">
    <link href="./style/style.css" rel="stylesheet">
</head>

<body x-data="{ page: 'suppliers', 'loaded': true, 'darkMode': true, 'stickyMenu': false, 'sidebarToggle': false, 'scrollTop': false }" x-init="darkMode = JSON.parse(localStorage.getItem('darkMode'));$watch('darkMode', value => localStorage.setItem('darkMode', JSON.stringify(value)))" :class="{'dark text-bodydark bg-boxdark-2': darkMode === true}">
    <div class="flex h-screen overflow-hidden">
        <?php
        $page = 'admission';
        include './includes/sidebar.php'; ?>
        <div class="relative flex flex-1 flex-col overflow-y-auto overflow-x-hidden">
            <?php include './includes/header.php'; ?>
            <main>
                <div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
                    <div class="flex items-center justify-center">
                        <div class="mx-auto max-w-screen-2xl xl:w-3/4 p-4 md:p-6 2xl:p-10">
                            <?php
                            $total = $conn->query("SELECT SUM(tot_amount) AS tot_amount FROM `admission_med` WHERE `patient_id` = '$id' AND `payment` = '$payment'");
                            $rs = $total->fetch_assoc();
                            if ($payment == 0) {
                            ?>
                                <div class="mt-4 flex items-end justify-between w-1/2 mx-auto dark:bg-boxdark px-4 py-8 rounded-lg mb-4">
                                    <h4 class="text-lg font-light text-black dark:text-white">
                                        <?php echo $pat_name; ?>
                                    </h4>
                                    <span class="text-lg dark:text-white font-bold">
                                        <?php echo $rs['tot_amount'] . " Birr"; ?>
                                    </span>
                                </div>
                            <?php
                            } else {
                            ?>
                                <div class="mt-4 flex items-end justify-between w-1/2 mx-auto dark:bg-boxdark px-4 py-8 rounded-lg mb-4">
                                    <h4 class="text-lg font-light text-black dark:text-white">
                                        <?php echo $pat_name; ?>
                                    </h4>
                                    <span class="text-lg dark:text-white font-bold">
                                        <?php echo $rs['tot_amount'] . " Birr"; ?>
                                    </span>
                                </div>
                            <?php
                            }
                            ?>
                            <table class="w-full border-collapse text-boxdark-2 dark:bg-danger dark:text-white">
                                <thead class="bg-primary text-white">
                                    <tr>
                                        <th class=" border-gray-300 hidden border p-3 font-bold uppercase lg:table-cell">
                                            Name
                                        </th>
                                        <th class=" border-gray-300 hidden border p-3 font-bold uppercase lg:table-cell">
                                            Type
                                        </th>
                                        <th class=" border-gray-300 hidden border p-3 font-bold uppercase lg:table-cell">
                                            Quantity
                                        </th>
                                        <th class=" border-gray-300 hidden border p-3 font-bold uppercase lg:table-cell">
                                            Total Price
                                        </th>
                                        <th class=" border-gray-300 hidden border p-3 font-bold uppercase lg:table-cell">
                                            Date
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="dark:bg-black dark:text-white " id="tbody">
                                    <?php
                                    $select = $conn->query("SELECT *,COUNT(amount) AS amount, SUM(tot_amount) AS tot_amount FROM `admission_med` WHERE `patient_id` = '$id' AND `payment` = '$payment' GROUP BY `date`");
                                    while ($row = $select->fetch_assoc()) {
                                        // $id = $row['id'];
                                        // $invoice_no = $row['invoice_no'];
                                        $name = $row['name'];
                                        $type = $row['type'];
                                        $amount = $row['amount'];
                                        // $amount = $row['quantity'];
                                        $total_amount = $row['tot_amount'];
                                        $reg_date = $row['date'];
                                        // $pageName = 'invoice_detail';
                                        // include './includes/table_row.php';
                                    ?>
                                        <tr class=" lg:flex-no-wrap mb-10 flex flex-row flex-wrap lg:mb-0 lg:table-row lg:flex-row">
                                            <td class="text-gray-800 dark:text-white relative w-full flex justify-between border border-b border-bodydark2 p-3 md:block lg:static lg:table-cell lg:w-auto">
                                                <span class=" px-2 py-1 text-center text-xs font-bold uppercase lg:hidden">Name</span>
                                                <p class="medicineName break-words ml-8 md:ml-0 md:text-left  capitalize">
                                                    <?php echo $name; ?>
                                                </p>
                                            </td>
                                            <td class="text-gray-800 dark:text-white relative md:text-center block w-full border border-b p-3 text-right lg:static lg:table-cell lg:w-auto">
                                                <span class="absolute top-[20%] left-0 px-2 py-1 text-xs font-bold uppercase lg:hidden">Type</span>
                                                <p class="break-words">
                                                    <?php echo $type; ?>
                                                </p>
                                            </td>
                                            <td class="text-gray-800 dark:text-white relative md:text-center block w-full border border-b p-3 text-right lg:static lg:table-cell lg:w-auto">
                                                <span class="absolute top-[20%] left-0 px-2 py-1 text-xs font-bold uppercase lg:hidden">Amount</span>
                                                <p class="break-words">
                                                    <?php echo $amount; ?>
                                                </p>
                                            </td>
                                            <td class="text-gray-800 dark:text-white relative md:text-center block w-full border border-b p-3 text-right lg:static lg:table-cell lg:w-auto">
                                                <span class="absolute top-[20%] left-0 px-2 py-1 text-xs font-bold uppercase lg:hidden">Price</span>
                                                <p class="break-words">
                                                    <?php echo $total_amount; ?>
                                                </p>
                                            </td>
                                            <td class="text-gray-800 dark:text-white relative md:text-center block w-full border border-b p-3 text-right lg:static lg:table-cell lg:w-auto">
                                                <span class="absolute top-[20%] left-0 px-2 py-1 text-xs font-bold uppercase lg:hidden">Type</span>
                                                <p class="break-words">
                                                    <?php echo $reg_date; ?>
                                                </p>
                                            </td>
                                        </tr>
                                    <?php
                                    }

                                    ?>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script defer src="bundle.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>

    <script src="./script/app.js"></script>

</body>

</html>
<?php
require './backend/db.php';
require './backend/auth.php';
$invoice_no = $_GET['id'];
if (empty($invoice_no)) {
    header("Location: ./suppliers.php");
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
        $page = 'suppliers';
        include './includes/sidebar.php'; ?>
        <div class="relative flex flex-1 flex-col overflow-y-auto overflow-x-hidden">
            <?php include './includes/header.php'; ?>
            <main>
                <div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
                    <div class="flex items-center justify-center">
                        <div class="mx-auto max-w-screen-2xl xl:w-3/4 p-4 md:p-6 2xl:p-10">
                            <!-- component -->

                            <!-- <div class="flex items-center justify-center">
                                <form class="mx-10 flex w-3/4 mb-8 rounded bg-white dark:bg-boxdark" action="./home.php" method="GET">
                                    <input class="text-gray-400 w-3/4 border-none rounded-md bg-transparent dark:bg-boxdark px-4 py-1 outline-none focus:outline-none" type="search" name="search" placeholder="Search..." />
                                    <button type="submit" class=" text-sm md:text-lg md:w-1/4 w-[30%]  cursor-pointer rounded-lg border border-primary bg-primary p-4 font-medium text-white transition hover:bg-opacity-90">
                                        Search
                                    </button>
                                </form>
                            </div> -->
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
                                            Purchase $
                                        </th>
                                        <th class=" border-gray-300 hidden border p-3 font-bold uppercase lg:table-cell">
                                            Reg Date
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="dark:bg-black dark:text-white " id="tbody">
                                    <?php
                                    $select = $conn->query("SELECT * FROM `temp_meds` WHERE `invoice_no` = '$invoice_no'");
                                    while ($row = $select->fetch_assoc()) {
                                        $id = $row['id'];
                                        $invoice_no = $row['invoice_no'];
                                        $name = $row['name'];
                                        $type = $row['type'];
                                        $amount = $row['quantity'];
                                        $purchase = $row['price'];
                                        $reg_date = $row['created_at'];
                                        $pageName = 'invoice_detail';
                                        include './includes/table_row.php';
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
<?php
require './backend/db.php';
require './backend/auth.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Pharmacy | Report</title>
    <link rel="icon" href="favicon.ico">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css" rel="stylesheet" />
    <link href="./style/alert.css" rel="stylesheet">
    <link href="./style/style.css" rel="stylesheet">
</head>

<body x-data="{ page: 'suppliers', 'loaded': true, 'darkMode': true, 'stickyMenu': false, 'sidebarToggle': false, 'scrollTop': false }" x-init="
         darkMode = JSON.parse(localStorage.getItem('darkMode'));
         $watch('darkMode', value => localStorage.setItem('darkMode', JSON.stringify(value)))" :class="{'dark text-bodydark bg-boxdark-2': darkMode === true}">
    <div class="flex h-screen overflow-hidden">
        <?php
        $page = 'sales';
        include './includes/sidebar.php'; ?>
        <div class="relative flex flex-1 flex-col overflow-y-auto overflow-x-hidden">
            <?php include './includes/header.php'; ?>
            <main>
                <div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
                    <div class="flex items-center justify-center">
                        <form class="bg-white text-dark dark:bg-boxdark mb-8 rounded flex flex-col" action="./sales.php" method="GET">
                            <div class="p-6.5">
                                <div class="text-center text-xl mb-4 dark:text-white text-black">Select Date</div>
                                <div class=" flex flex-col gap-6 xl:flex-row">
                                    <div class="w-full xl:w-1/2">
                                        <input name="date" type="date" class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" value="" />
                                    </div>
                                    <div class="w-full xl:w-1/2">
                                        <input type="submit" value="Search" name="search" class="w-full bg-primary hover:bg-secondary hover:cursor-pointer rounded text-white py-3 px-5 font-medium outline-none transition" />
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>


                    <?php

                    $results_per_page = 15;
                    $search_result = 1;
                    $search = $_GET['date'] ?? '';
                    $date = date("Y-m-d");
                    // find out the number of results stored in database
                    $sql = "SELECT * FROM `pharmacy_sale` WHERE `date` = '$date'";
                    $result = mysqli_query($conn, $sql);
                    $number_of_results = mysqli_num_rows($result);

                    // determine number of total pages available
                    $number_of_pages = ceil($number_of_results / $results_per_page);

                    // determine which page number visitor is currently on
                    if (!isset($_GET['page'])) {
                        $page = 1;
                    } else {
                        $page = $_GET['page'];
                    }

                    // determine the sql LIMIT starting number for the results on the displaying page
                    $this_page_first_result = ($page - 1) * $results_per_page;

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
                                    Amount
                                </th>
                                <th class=" border-gray-300 hidden border p-3 font-bold uppercase lg:table-cell">
                                    Total Price $
                                </th>
                                <th class=" border-gray-300 hidden border p-3 font-bold uppercase lg:table-cell">
                                    Type of Sale
                                </th>
                                <th class=" border-gray-300 hidden border p-3 font-bold uppercase lg:table-cell">
                                    Date
                                </th>
                            </tr>
                        </thead>
                        <tbody class="dark:bg-black dark:text-white " id="tbody">
                            <?php

                            // retrieve selected results from database and display them on page
                            if (!isset($_GET['search'])) {
                                $total_report = $conn->query("SELECT 
                    payment,
                    SUM(sub_price) AS total_amount
                FROM 
                pharmacy_sale
                WHERE
                    `date` = '$date'
                GROUP BY 
                    payment;
                ");
                                echo ' <div class="sm:w-1/2 mx-auto mb-4 rounded-lg border border-stroke bg-white py-6 px-7.5 shadow-default dark:border-strokedark dark:bg-boxdark">';

                                $total = 0;
                                while ($rs = $total_report->fetch_assoc()) {
                                    $total_payment = $rs['total_amount'];
                                    $payment_type = $rs['payment'];
                                    $total += $total_payment;
                            ?>

                                    <div class="mt-4 flex items-end justify-between">
                                        <h4 class="text-lg font-light text-black dark:text-white">
                                            <?php echo $payment_type; ?>
                                        </h4>
                                        <span class="text-lg dark:text-white font-bold">
                                            <?php echo $total_payment . " Birr"; ?>
                                        </span>
                                    </div>
                                <?php
                                }
                                ?>
                                <div class="mt-4 flex items-end justify-between">
                                    <h4 class="text-lg font-light text-black dark:text-white">
                                        <?php echo "Total"; ?>
                                    </h4>
                                    <span class="text-lg dark:text-white font-bold">
                                        <?php echo $total . " Birr"; ?>
                                    </span>
                                </div>
                </div>
                <?php
                                $sql = $conn->query("SELECT * FROM `pharmacy_sale` WHERE `date` = '$date' ORDER BY `name` ASC LIMIT $this_page_first_result,$results_per_page");
                                while ($row = $sql->fetch_assoc()) {
                                    $id = $row['id'];
                                    $name = $row['name'];
                                    $type = $row['type'];
                                    $amount = $row['quan'];
                                    $total_price = $row['sub_price'];
                                    $saleType = $row['payment'];
                                    $sale_date = $row['date'];
                ?>
                    <tr class=" lg:flex-no-wrap mb-10 flex flex-row flex-wrap lg:mb-0 lg:table-row lg:flex-row">
                        <td class="text-gray-800 dark:text-white relative w-full flex justify-between border border-b border-bodydark2 p-3 md:block lg:static lg:table-cell lg:w-auto">
                            <span class=" px-2 py-1 text-center text-xs font-bold uppercase lg:hidden">Name</span>
                            <p class="medicineName break-words ml-8 md:ml-0 md:text-left  capitalize">
                                <?php echo $name; ?>
                            </p>
                        </td>
                        <td class="text-gray-800 dark:text-white relative w-full flex justify-between border border-b border-bodydark2 p-3 md:block lg:static lg:table-cell lg:w-auto">
                            <span class=" px-2 py-1 text-center text-xs font-bold uppercase lg:hidden">Type</span>
                            <p class="medicineName break-words ml-8 md:ml-0 md:text-left  capitalize">
                                <?php echo $type; ?>
                            </p>
                        </td>
                        <td class="text-gray-800 dark:text-white relative w-full flex justify-between border border-b border-bodydark2 p-3 md:block lg:static lg:table-cell lg:w-auto">
                            <span class=" px-2 py-1 text-center text-xs font-bold uppercase lg:hidden">Amount</span>
                            <p class="medicineName break-words ml-8 md:ml-0 md:text-left  capitalize">
                                <?php echo $amount; ?>
                            </p>
                        </td>
                        <td class="text-gray-800 dark:text-white relative w-full flex justify-between border border-b border-bodydark2 p-3 md:block lg:static lg:table-cell lg:w-auto">
                            <span class=" px-2 py-1 text-center text-xs font-bold uppercase lg:hidden">Total</span>
                            <p class="medicineName break-words ml-8 md:ml-0 md:text-left  capitalize">
                                <?php echo $total_price; ?>
                            </p>
                        </td>
                        <td class="text-gray-800 dark:text-white relative w-full flex justify-between border border-b border-bodydark2 p-3 md:block lg:static lg:table-cell lg:w-auto">
                            <span class=" px-2 py-1 text-center text-xs font-bold uppercase lg:hidden">Sale Type</span>
                            <p class="medicineName break-words ml-8 md:ml-0 md:text-left  capitalize">
                                <?php echo $saleType; ?>
                            </p>
                        </td>
                        <td class="text-gray-800 dark:text-white relative w-full flex justify-between border border-b border-bodydark2 p-3 md:block lg:static lg:table-cell lg:w-auto">
                            <span class=" px-2 py-1 text-center text-xs font-bold uppercase lg:hidden">Date</span>
                            <p class="medicineName break-words ml-8 md:ml-0 md:text-left  capitalize">
                                <?php echo $sale_date; ?>
                            </p>
                        </td>
                    </tr>
                <?php
                                }
                            } else {
                                $total_report = $conn->query("SELECT 
                                payment,
                                SUM(sub_price) AS total_amount
                            FROM 
                                pharmacy_sale
                            WHERE
                                `date` = '$search'
                            GROUP BY 
                                payment;
                            ");
                                echo ' <div class="sm:w-1/2 mx-auto mb-4 rounded-lg border border-stroke bg-white py-6 px-7.5 shadow-default dark:border-strokedark dark:bg-boxdark">';

                                $total = 0;
                                while ($rs = $total_report->fetch_assoc()) {
                                    $total_payment = $rs['total_amount'];
                                    $payment_type = $rs['payment'];
                                    $total += $total_payment;
                ?>

                    <div class="mt-4 flex items-end justify-between">
                        <h4 class="text-lg font-light text-black dark:text-white">
                            <?php echo $payment_type; ?>
                        </h4>
                        <span class="text-lg dark:text-white font-bold">
                            <?php echo $total_payment . " Birr"; ?>
                        </span>
                    </div>
                <?php
                                }
                ?>
                <div class="mt-4 flex items-end justify-between">
                    <h4 class="text-lg font-light text-black dark:text-white">
                        <?php echo "Total"; ?>
                    </h4>
                    <span class="text-lg dark:text-white font-bold">
                        <?php echo $total . " Birr"; ?>
                    </span>
                </div>
        </div>
        <?php
                                $sql = $conn->query("SELECT * FROM `pharmacy_sale` WHERE `date` = '$search' ORDER BY `name` ASC");
                                if ($sql->num_rows > 0) {
                                    while ($row = $sql->fetch_assoc()) {
                                        $id = $row['id'];
                                        $name = $row['name'];
                                        $type = $row['type'];
                                        $amount = $row['quan'];
                                        $total_price = $row['sub_price'];
                                        $saleType = $row['payment'];
                                        $sale_date = $row['date'];
        ?>
                <tr class=" lg:flex-no-wrap mb-10 flex flex-row flex-wrap lg:mb-0 lg:table-row lg:flex-row">
                    <td class="text-gray-800 dark:text-white relative w-full flex justify-between border border-b border-bodydark2 p-3 md:block lg:static lg:table-cell lg:w-auto">
                        <span class=" px-2 py-1 text-center text-xs font-bold uppercase lg:hidden">Name</span>
                        <p class="medicineName break-words ml-8 md:ml-0 md:text-left  capitalize">
                            <?php echo $name; ?>
                        </p>
                    </td>
                    <td class="text-gray-800 dark:text-white relative w-full flex justify-between border border-b border-bodydark2 p-3 md:block lg:static lg:table-cell lg:w-auto">
                        <span class=" px-2 py-1 text-center text-xs font-bold uppercase lg:hidden">Type</span>
                        <p class="medicineName break-words ml-8 md:ml-0 md:text-left  capitalize">
                            <?php echo $type; ?>
                        </p>
                    </td>
                    <td class="text-gray-800 dark:text-white relative w-full flex justify-between border border-b border-bodydark2 p-3 md:block lg:static lg:table-cell lg:w-auto">
                        <span class=" px-2 py-1 text-center text-xs font-bold uppercase lg:hidden">Amount</span>
                        <p class="medicineName break-words ml-8 md:ml-0 md:text-left  capitalize">
                            <?php echo $amount; ?>
                        </p>
                    </td>
                    <td class="text-gray-800 dark:text-white relative w-full flex justify-between border border-b border-bodydark2 p-3 md:block lg:static lg:table-cell lg:w-auto">
                        <span class=" px-2 py-1 text-center text-xs font-bold uppercase lg:hidden">Total</span>
                        <p class="medicineName break-words ml-8 md:ml-0 md:text-left  capitalize">
                            <?php echo $total_price; ?>
                        </p>
                    </td>
                    <td class="text-gray-800 dark:text-white relative w-full flex justify-between border border-b border-bodydark2 p-3 md:block lg:static lg:table-cell lg:w-auto">
                        <span class=" px-2 py-1 text-center text-xs font-bold uppercase lg:hidden">Sale Type</span>
                        <p class="medicineName break-words ml-8 md:ml-0 md:text-left  capitalize">
                            <?php echo $saleType; ?>
                        </p>
                    </td>
                    <td class="text-gray-800 dark:text-white relative w-full flex justify-between border border-b border-bodydark2 p-3 md:block lg:static lg:table-cell lg:w-auto">
                        <span class=" px-2 py-1 text-center text-xs font-bold uppercase lg:hidden">Date</span>
                        <p class="medicineName break-words ml-8 md:ml-0 md:text-left  capitalize">
                            <?php echo $sale_date; ?>
                        </p>
                    </td>
                </tr>
            <?php
                                    }
                                } else {
                                    $search_result = 0;
            ?>
            <h1 class="text-center text-2xl text-black dark:text-white">Item Not Found</h1>
            <h1 class="text-center text-2xl text-black dark:text-white">Please Check The Name Again</h1>
    <?php
                                }
                            }
    ?>
    </tbody>
    </table>
    <!-- table end -->
    <!-- component pagination -->
    <div class="<?php if (empty($search)) {
                    echo 'mt-8 flex justify-center flex-wrap wrap';
                } else {
                    echo 'mt-8 flex justify-center hidden';
                } ?>">
        <nav aria-label="Page navigation example">
            <ul class="list-style-none flex">
                <?php
                for ($page = 1; $page <= $number_of_pages; $page++) {
                ?>
                    <li class="page-item">
                        <a class="page-link hover:text-gray-800 hover:bg-gray-200 relative block rounded border-0 bg-transparent py-1.5 px-3 text-boxdark-2 outline-none transition-all duration-300 focus:shadow-none dark:text-whiter" href="home.php?page=<?php echo $page; ?>"><?php echo $page; ?></a>
                    </li>
                <?php
                }
                ?>
            </ul>
        </nav>
    </div>





    </div>
    </main>
    </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script defer src="bundle.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
    <script src="./script/app.js"></script>
</body>

</html>
<?php
require './backend/db.php';
require './backend/auth.php';
$date = date('Y-m-d');
$year = explode('-', $date)[0];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css" rel="stylesheet" />
    <title>Pharmacy | Store</title>
    <link rel="icon" href="favicon.ico">
    <link href="./style/style.css" rel="stylesheet">
    <link href="./style/alert.css" rel="stylesheet">
</head>

<body x-data="{ page: 'home', 'loaded': true, 'darkMode': true, 'stickyMenu': false, 'sidebarToggle': false, 'scrollTop': false }" x-init="
darkMode = JSON.parse(localStorage.getItem('darkMode'));
$watch('darkMode', value => localStorage.setItem('darkMode', JSON.stringify(value)))" :class="{'dark text-bodydark bg-boxdark-2': darkMode === true}">

    <div class="flex h-screen overflow-hidden">
        <?php
        $page = 'exportReport';
        include './includes/sidebar.php'; ?>
        <div class="relative flex flex-1 flex-col overflow-y-auto overflow-x-hidden">
            <?php include './includes/header.php'; ?>
            <main>
                <div class="alert-box absolute flex border-l-6 border-primary bg-danger px-7 py-8 shadow-md dark:bg-danger text-white md:p-9 align-center justify-center" id="alert-box">

                    <div class="w-full">
                        <h5 class="mb-3 font-bold text-white">
                            Update Info!
                        </h5>
                        <input type="hidden" name="" id="status" value="<?php echo @$_REQUEST['status']; ?>">
                        <ul>
                            <li class="leading-relaxed text-white">
                                <p id="error-text">
                                    <?php
                                    $msg = @$_REQUEST['msg'];
                                    $lout = @$_REQUEST['lout'];
                                    echo $msg;
                                    echo $lout;
                                    ?>
                                </p>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
                    <!-- component -->

                    <div class="flex items-center justify-center">
                        <form class="mx-10 flex w-3/4 mb-8 rounded bg-white dark:bg-boxdark" action="./exportReport.php" method="GET">
                            <input required class="text-gray-400 w-3/4 border-none rounded-md bg-transparent dark:bg-boxdark px-4 py-1 outline-none focus:outline-none" type="month" name="search" placeholder="Search..." />
                            <input type="submit" value="Search" class=" text-sm md:text-lg md:w-1/4 w-[30%]  cursor-pointer rounded-lg border border-primary bg-primary p-4 font-medium text-white transition hover:bg-opacity-90" />
                        </form>
                    </div>
                    <table class="w-full border-collapse text-boxdark-2 dark:bg-danger dark:text-white">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th class=" border-gray-300 hidden border p-3 font-bold uppercase lg:table-cell">
                                    Total Unpaid Suppliers
                                </th>
                                <th class=" border-gray-300 hidden border p-3 font-bold uppercase lg:table-cell">
                                    Total Paid Suppliers
                                </th>
                                <th class=" border-gray-300 hidden border p-3 font-bold uppercase lg:table-cell">
                                    Total Expense
                                </th>
                                <th class=" border-gray-300 hidden border p-3 font-bold uppercase lg:table-cell">
                                    Total Sell
                                </th>
                                <th class=" border-gray-300 hidden border p-3 font-bold uppercase lg:table-cell">
                                    Total Net Sell
                                </th>
                            </tr>
                        </thead>
                        <tbody class="dark:bg-black dark:text-white " id="tbody">
                            <?php
                            include './includes/exportQuery.php';
                            $search = $_GET['search'] ?? '';
                            $search_result = 1;
                            // retrieve selected results from database and display them on page
                            if (empty($search)) {
                                $result1 = $conn->query($totals);
                                $row1 = $result1->fetch_assoc();
                                $profit = $row1['profit'];
                                $total_cost = $row1['purchase_price'];
                                $total_revenue = $row1['cost_price'];

                                $result2 = $conn->query($pay_status);
                            ?>
                                <?php
                                while ($row2 = $result2->fetch_assoc()) {
                                    $total_unpaid = number_format($row2['total_unpaid_amount'], 2, '.', ',');
                                    $total_paid = number_format($row2['total_paid_amount'], 2, '.', ',');
                                    $total_cost = number_format($total_cost, 2, '.', ',');
                                    $total_revenue = number_format($total_revenue, 2, '.', ',');
                                    $total_profit = number_format($profit, 2, '.', ',');

                                    include './includes/exportTable.php';
                                }
                            } else {
                                $year = explode('-', $search)[0];
                                include './includes/exportQuery.php';
                                $result1 = $conn->query($totals);
                                $row1 = $result1->fetch_assoc();
                                $profit = $row1['profit'];
                                $total_cost = $row1['purchase_price'];
                                $total_revenue = $row1['cost_price'];

                                $result2 = $conn->query($pay_status);
                                if ($result2->num_rows > 0) {
                                    while ($row2 = $result2->fetch_assoc()) {
                                        $total_unpaid = number_format($row2['total_unpaid_amount'], 2, '.', ',');
                                        $total_paid = number_format($row2['total_paid_amount'], 2, '.', ',');
                                        $total_cost = number_format($total_cost, 2, '.', ',');
                                        $total_revenue = number_format($total_revenue, 2, '.', ',');
                                        $total_profit = number_format($profit, 2, '.', ',');

                                        include './includes/exportTable.php';
                                    }
                                } else {
                                    $search_result = 0;
                                ?>
                                    <h1 class="text-center text-2xl text-black dark:text-white">Item Not Found</h1>
                                    <h1 class="text-center text-2xl text-black dark:text-white">Please Check The Date Again</h1>
                            <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                    <?php
                    if ($search_result != 0) {
                    ?>
                        <div class="export flex items-center justify-end my-2">
                            <a href="./backend/exportTotal.php?page=general&year=<?php echo $year; ?>" class="text-sm md:text-lg cursor-pointer rounded-lg bg-secondary py-1 px-6 font-medium text-white transition hover:bg-opacity-90">
                                Export
                            </a>
                        </div>
                    <?php
                    }
                    ?>
                </div>

            </main>
            <!-- ===== Main Content End ===== -->
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script defer src="bundle.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>

    <script>
        const table = document.querySelector('table');
        const searchResult = document.getElementById('searchResult');

        // if(searchResult.value == )
        if (table.lastElementChild.innerText == '') {
            table.classList.add('hidden');
        } else {
            table.classList.remove('hidden');
        }
    </script>
    <script src="./script/app.js"></script>
</body>

</html>
<?php
require './backend/db.php';

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
<style>
    .chartTwo::-webkit-scrollbar {
        width: 10px;
    }

    .chartTwo::-webkit-scrollbar-thumb {
        background-color: rgb(138 22 104);
    }

    .chartTwo::-webkit-scrollbar-track {
        background-color: "#24303f";
    }
</style>

<body x-data="{ page: 'suppliers', 'loaded': true, 'darkMode': true, 'stickyMenu': false, 'sidebarToggle': false, 'scrollTop': false }" x-init="
         darkMode = JSON.parse(localStorage.getItem('darkMode'));
         $watch('darkMode', value => localStorage.setItem('darkMode', JSON.stringify(value)))" :class="{'dark text-bodydark bg-boxdark-2': darkMode === true}">
    <div class="flex h-screen overflow-hidden">
        <?php
        $page = 'report';
        include './includes/sidebar.php'; ?>
        <div class="relative flex flex-1 flex-col overflow-y-auto overflow-x-hidden">
            <?php include './includes/header.php'; ?>

            <main>

                <div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
                    <!-- component -->
                    <form class="bg-white text-dark dark:bg-boxdark mb-8 rounded flex flex-col" action="./report.php" method="GET">
                        <div class="p-6.5">
                            <div class="text-center text-xl mb-4 dark:text-white text-black">Select Month</div>
                            <div class=" flex flex-col gap-6 xl:flex-row">
                                <div class="w-full xl:w-1/2">
                                    <input name="date" type="month" class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" value="<?php
                                                                                                                                                                                                                                                                                                                                                            $date = date("Y-m-d");
                                                                                                                                                                                                                                                                                                                                                            $month_num = explode('-', $date)[1];
                                                                                                                                                                                                                                                                                                                                                            $year = explode('-', $date)[0];
                                                                                                                                                                                                                                                                                                                                                            echo $year . '-' . $month_num;
                                                                                                                                                                                                                                                                                                                                                            ?>" />
                                </div>
                                <div class="w-full xl:w-1/2">
                                    <input type="submit" value="Search" name="search" class="w-full bg-primary hover:bg-secondary hover:cursor-pointer rounded text-white py-3 px-5 font-medium outline-none transition" />
                                </div>
                            </div>

                        </div>

                    </form>
                    <?php
                    $date = date("Y-m-d");
                    if ((!isset($_GET['search']))) {
                        $month_num = explode('-', $date)[1];
                        $year = explode('-', $date)[0];
                    } else {
                        if ($_GET['date'] == '') {
                            $month_num = explode('-', $date)[1];
                            $year = explode('-', $date)[0];
                        } else {
                            $month_num = explode('-', $_GET['date'])[1];
                            $year = explode('-', $_GET['date'])[0];
                        }
                    }
                    include './includes/report.php'; ?>
                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2 md:gap-6 xl:grid-cols-4 2xl:gap-7.5">
                        <!-- Card Item Start -->
                        <div class="rounded-lg border border-stroke bg-white py-6 px-7.5 shadow-default dark:border-strokedark dark:bg-boxdark">
                            <div class="flex h-11.5 w-11.5 items-center justify-center rounded-full bg-meta-2 dark:bg-meta-4">
                                <i class="fa-solid fa-boxes-packing"></i>
                            </div>

                            <div class="mt-4 flex items-end justify-between">
                                <h4 class="text-lg font-light text-black dark:text-white">
                                    Suppliers Payment
                                </h4>
                                <span class="text-lg dark:text-white font-bold">
                                    <?php echo $total_unpaid . " Birr"; ?>
                                </span>
                            </div>
                        </div>
                        <div class="rounded-lg border border-stroke bg-white py-6 px-7.5 shadow-default dark:border-strokedark dark:bg-boxdark">
                            <div class="flex items-center justify-between">
                                <div class="flex h-11.5 w-11.5 items-center justify-center rounded-full bg-meta-2 dark:bg-meta-4">
                                    <i class="fas fa-money-bills"></i>
                                </div>
                                <p><?php echo $month[$month_num]; ?></p>
                            </div>

                            <div class="mt-4 flex items-end justify-between">
                                <h4 class="text-lg font-light text-black dark:text-white">
                                    Total Sell
                                </h4>
                                <span class="text-lg dark:text-white font-bold">
                                    <?php echo $total_revenue . " Birr"; ?>
                                </span>
                            </div>
                        </div>
                        <div class="rounded-lg border border-stroke bg-white py-6 px-7.5 shadow-default dark:border-strokedark dark:bg-boxdark">
                            <div class="flex items-center justify-between">
                                <div class="flex h-11.5 w-11.5 items-center justify-center rounded-full bg-meta-2 dark:bg-meta-4">
                                    <i class="fa-solid fa-money-bill-transfer"></i>
                                </div>
                                <p><?php echo $month[$month_num]; ?></p>
                            </div>

                            <div class="mt-4 flex items-end justify-between">
                                <h4 class="text-lg font-light text-black dark:text-white">
                                    Total Expense
                                </h4>
                                <span class="text-lg dark:text-white font-bold">
                                    <?php echo $total_cost . " Birr"; ?>
                                </span>
                            </div>
                        </div>
                        <div class="rounded-lg border border-stroke bg-white py-6 px-7.5 shadow-default dark:border-strokedark dark:bg-boxdark">
                            <div class="flex items-center justify-between">
                                <div class="flex h-11.5 w-11.5 items-center justify-center rounded-full bg-meta-2 dark:bg-meta-4">
                                    <i class="fas fa-money-bills"></i>
                                </div>
                                <p><?php echo $month[$month_num]; ?></p>
                            </div>

                            <div class="mt-4 flex items-end justify-between">
                                <h4 class="text-lg font-light text-black dark:text-white">
                                    Net Sell
                                </h4>
                                <span class="text-lg dark:text-white font-bold">
                                    <?php echo $profit . " Birr"; ?>
                                </span>
                            </div>
                        </div>
                        <!-- Card Item End -->
                    </div>

                    <div class="mt-4 grid grid-cols-12 gap-4 md:mt-6 md:gap-6 2xl:mt-7.5 2xl:gap-7.5">
                        <!-- ====== Chart One Start -->
                        <div class="col-span-12 rounded-sm border border-stroke bg-white px-5 pt-7.5 pb-5 shadow-default dark:border-strokedark dark:bg-boxdark sm:px-7.5 xl:col-span-8">
                            <div class="flex flex-wrap items-start justify-between gap-3 sm:flex-nowrap">

                                <div class="flex w-full max-w-45 justify-end">
                                    <!-- <div class="inline-flex items-center rounded-md bg-whiter p-1.5 dark:bg-meta-4">
                                        <p><?php echo $month[$month_num]; ?></p>
                                    </div> -->
                                </div>
                            </div>
                            <div>
                                <canvas id="profitChart" height="150px" class="-ml-5 dark:text-white">
                                </canvas>
                                <?php
                                $year = explode("-", date('Y-m-d'))[0];
                                $query = $conn->query("
                                SELECT
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

                                foreach ($query as $data) {
                                    $months[] = $data['month'];
                                    $amounts[] = $data['profit'];
                                }

                                ?>
                            </div>
                        </div>
                        <!-- ====== Chart One End -->

                        <!-- ====== Chart Two Start -->
                        <div class="col-span-12 rounded-sm border border-stroke bg-white p-7.5 shadow-default dark:border-strokedark dark:bg-boxdark xl:col-span-4">
                            <div style="height: 450px;" class="overflow-hidden overflow-y-auto chartTwo">
                                <div class="mb-4 flex items-center justify-between">
                                    <div>
                                        <h4 class="text-xl font-bold text-black dark:text-white">
                                            Total:
                                        </h4>
                                    </div>
                                    <select name="selectYear" id="selectYear" class="relative z-20 inline-flex appearance-none bg-transparent py-1 pl-3 pr-8 text-sm font-medium outline-none" onchange="fetchMonths()">
                                        <option value="" selected default disabled> Please Select Year</option>
                                    </select>
                                </div>
                                <div class="relative z-20 inline-block flex flex-col ">
                                    <div id="monthContainer" class="flex flex-col w-full">
                                        <div class="rounded-sm bg-gray-2 dark:bg-meta-4 flex items-center justify-between">
                                            <div class="p-2.5 xl:p-5">
                                                <h5 class="text-sm font-medium uppercase xsm:text-base">Month</h5>
                                            </div>
                                            <div class="p-2.5 text-center xl:p-5">
                                                <h5 class="text-sm font-medium uppercase xsm:text-base">Profit</h5>
                                            </div>

                                        </div>
                                        <!-- <div class="border-b border-stroke dark:border-strokedark flex items-center justify-between">
                                            <div class="flex items-center justify-center p-2.5 xl:p-5">
                                                <p class="font-medium text-black dark:text-white">January</p>
                                            </div>
                                            <div class="flex items-center justify-center p-2.5 xl:p-5">
                                                <p class="font-medium text-meta-3">$5,</p>
                                            </div>
                                        </div> -->

                                    </div>
                                </div>
                            </div>
                            <div>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- Main modal -->


            </main>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script defer src="bundle.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
    <script src="./script/app.js"></script>
    <script>
        const months = <?php echo json_encode($months) ?>;
        const amounts = <?php echo json_encode($amounts) ?>;
        const chartData = {
            // labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
            labels: months,
            datasets: [{
                label: "Profit",
                backgroundColor: "rgb(96,176,0)",
                borderWidth: 2,
                data: amounts,
            }]
        };
        const ctx = document.getElementById("profitChart")
        const myChart = new Chart(ctx, {
            type: 'bar',
            data: chartData,
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Amount (Birr)',
                            color: '#aeaa9b',
                        },
                        ticks: {
                            color: '#aeaa9b',
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Months',
                            color: '#aeaa9b',
                        },
                        ticks: {
                            color: '#aeaa9b',
                        }
                    }
                },
                plugins: {
                    tooltip: {
                        mode: 'index',
                        intersect: false
                    }
                },
                legend: {
                    labels: {
                        fontColor: "#FFFFFF",
                    }
                }
            }
        })

        document.addEventListener('DOMContentLoaded', () => {
            fetchYears();
        })

        function fetchYears() {
            fetch('http://localhost/pharm_store/api/getYears.php')
                .then(response => response.json())
                .then(data => {
                    let yearDropDown = document.getElementById('selectYear')
                    // yearDropDown.innerHTML = '<option value="" selected default disabled>Please Select Year</option>';
                    data.forEach(year => {
                        const option = document.createElement('option');
                        option.value = year;
                        option.textContent = year;
                        yearDropDown.appendChild(option);
                    })
                     let selectedYear = document.getElementById('selectYear').value;
                     if(!selectedYear){
                        selectedYear = new Date().getFullYear();
                        yearDropDown.value = selectedYear
                     }
                    fetchMonths(selectedYear)
                })
                .catch(error => console.log(error))
        }

        function fetchMonths(selectedYear) {
            // let selectedYear = document.getElementById('selectYear').value;
            // if (!selectedYear) return false;
            fetch(`http://localhost/pharm_store/api/testing.php?year=${selectedYear}`)
                .then(response => response.json())
                .then(data => {
                    let monthContainer = document.getElementById('monthContainer')
                    monthContainer.innerHTML = ''
                    data.forEach((month) => {
                        const container = document.createElement('div');
                        const monthNameContainer = document.createElement('div');
                        const monthName = document.createElement('p');
                        const profitContainer = document.createElement('div');
                        const profit = document.createElement('p');

                        container.classList.add('border-b')
                        container.classList.add('border-stroke')
                        container.classList.add('dark:border-strokedark')
                        container.classList.add('flex')
                        container.classList.add('items-center')
                        container.classList.add('justify-between')

                        monthNameContainer.classList.add('p-2.5')
                        monthNameContainer.classList.add('xl:p-5')
                        profitContainer.classList.add('p-2.5')
                        profitContainer.classList.add('xl:p-5')

                        monthName.classList.add('font-medium')
                        monthName.classList.add('text-black')
                        monthName.classList.add('dark:text-white')
                        profit.classList.add('font-medium')
                        profit.classList.add('text-meta-3')

                        monthName.textContent = month.month
                        profit.textContent = month.profit + ' Birr'

                        monthNameContainer.appendChild(monthName);
                        profitContainer.appendChild(profit);
                        container.appendChild(monthNameContainer);
                        container.appendChild(profitContainer);
                        monthContainer.appendChild(container);
                    })
                })
        }
    </script>
</body>

</html>
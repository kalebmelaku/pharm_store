<?php
require './backend/db.php';
require './backend/auth.php';
$step = @$_GET['step'];
$invoice_number = @$_GET['invoice_number'];
$quantity = @$_GET['quantity'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css" rel="stylesheet" />
    <title>Pharmacy | Update</title>
    <link rel="icon" href="favicon.ico">
    <link href="./style/alert.css" rel="stylesheet">
    <link href="./style/style.css" rel="stylesheet">
</head>
<style>
    table thead {
        background-color: var(--primary);
        color: white;
    }
</style>

<body x-data="{ page: 'expired', 'loaded': true, 'darkMode': true, 'stickyMenu': false, 'sidebarToggle': false, 'scrollTop': false }" x-init="
         darkMode = JSON.parse(localStorage.getItem('darkMode'));
         $watch('darkMode', value => localStorage.setItem('darkMode', JSON.stringify(value)))" :class="{'dark text-bodydark bg-boxdark-2': darkMode === true}">
    <div class="flex h-screen overflow-hidden">
        <?php
        $page = 'suppliers';
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
                    <div class="flex flex-col gap-9 xl:w-3/4 mx-auto">

                        <?php
                        if ($step == 2) {
                        ?>
                            <div class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
                                <div class="border-b border-stroke py-4 px-6.5 dark:border-strokedark">
                                    <h3 class="font-semibold text-black dark:text-white">
                                        Add Medicine Detail
                                    </h3>
                                </div>
                                <form action="./backend/addSupplier.php" method="POST">
                                    <input type="hidden" name="list" value="<?php echo $quantity; ?>" id="quantity">
                                    <input type="hidden" name="invoice_number" value="<?php echo $invoice_number; ?>" id="">
                                    <div class="p-6.5 form-container">
                                        <?php
                                        for ($i = 1; $i <= $quantity; $i++) {
                                        ?>
                                            <div class="mb-4.5 flex flex-col gap-6 xl:flex-row">
                                                <div class="w-full xl:w-1/2">
                                                    <label class="mb-2.5 block text-black dark:text-white">
                                                        Medicine <?php echo $i; ?> Name
                                                    </label>
                                                    <input required name="name<?php echo $i; ?>" type="text" class="name w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                                                </div>
                                                <div class="w-full xl:w-1/2">
                                                    <label class="mb-2.5 block text-black dark:text-white">
                                                        Medicine <?php echo $i; ?> Type
                                                    </label>
                                                    <input required name="type<?php echo $i; ?>" type="text" class="type w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                                                </div>
                                            </div>
                                            <div class="mb-4.5 flex flex-col gap-6 xl:flex-row">
                                                <div class="w-full xl:w-1/2">
                                                    <label class="mb-2.5 block text-black dark:text-white">
                                                        Medicine <?php echo $i; ?> Purchase Price
                                                    </label>
                                                    <input required name="price<?php echo $i; ?>" type="text" class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary price" />
                                                </div>
                                                <div class="w-full xl:w-1/2">
                                                    <label class="mb-2.5 block text-black dark:text-white">
                                                        Medicine <?php echo $i; ?> Ex-Date
                                                    </label>
                                                    <input required name="date<?php echo $i; ?>" type="date" class="ex-date w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                                                </div>
                                            </div>
                                            <div class="mb-4.5 flex flex-col gap-6 xl:flex-row">
                                                <div class="w-full xl:w-1/2">
                                                    <label class="mb-2.5 block text-black dark:text-white">
                                                        Medicine <?php echo $i; ?> Quantity
                                                    </label>
                                                    <input required name="quantity<?php echo $i; ?>" type="text" class="quantity w-full  rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                                                </div>
                                                <div class="w-full xl:w-1/2">
                                                    <label class="mb-2.5 block text-black dark:text-white">
                                                        Medicine <?php echo $i; ?> Sell Price
                                                    </label>
                                                    <input required name="sell_price<?php echo $i; ?>" type="text" class="quantity w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                                                </div>

                                            </div>
                                            <hr class="mb-4">
                                        <?php
                                        }

                                        ?>
                                        <div class="mb-4.5 flex flex-col gap-6 xl:flex-row">
                                            <div class="w-full">
                                                <label class="mb-2.5 block text-black dark:text-white invisible">
                                                    Invisible
                                                </label>
                                                <input type="submit" value="Submit" name="submit" class="w-full bg-primary hover:bg-secondary hover:cursor-pointer rounded text-white py-3 px-5 font-medium outline-none transition" />
                                            </div>

                                        </div>
                                    </div>
                                </form>
                            </div>

                        <?php
                        } else if ($step == 3) {
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
                                            Purchase Price
                                        </th>
                                        <th class=" border-gray-300 hidden border p-3 font-bold uppercase lg:table-cell">
                                            Sell Price
                                        </th>
                                        <th class=" border-gray-300 hidden border p-3 font-bold uppercase lg:table-cell">
                                            Quantity
                                        </th>

                                        <th class=" border-gray-300 hidden border p-3 font-bold uppercase lg:table-cell">
                                            Ex-Date
                                        </th>

                                        <th class=" border-gray-300 hidden border p-3 font-bold uppercase lg:table-cell">
                                            Invoice Number
                                        </th>
                                        <th class=" border-gray-300 hidden border p-3 font-bold uppercase lg:table-cell">
                                            Reg-Date
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="dark:bg-black dark:text-white" id="tbody">
                                    <?php

                                    // retrieve selected results from database and display them on page

                                    $sql = $conn->query("SELECT * FROM `temp_meds` WHERE `invoice_no` = '$invoice_number'");
                                    if ($sql->num_rows > 0) {
                                        while ($row = $sql->fetch_assoc()) {
                                            $id = $row['id'];
                                            $name = $row['name'];
                                            $type = $row['type'];
                                            $price = $row['purchase_price'];
                                            $sell_price = $row['sell_price'];
                                            $quantity = $row['quantity'];
                                            $exdate = $row['exdate'];
                                            $reg_date = $row['created_at'];
                                            $pageName = '';

                                    ?>
                                            <tr class=" lg:flex-no-wrap mb-10 flex flex-row flex-wrap lg:mb-0 lg:table-row lg:flex-row">
                                                <td class="text-gray-800 dark:text-white relative w-full flex justify-between border border-b border-bodydark2 p-3 md:block lg:static lg:table-cell lg:w-auto">
                                                    <span class=" px-2 py-1 text-center text-xs font-bold uppercase lg:hidden">Name</span>
                                                    <p class="medicineName break-words ml-8 md:ml-0 md:text-left  capitalize">
                                                        <?php echo $name; ?>
                                                    </p>
                                                </td>
                                                <td class="text-gray-800 dark:text-white relative md:text-center block w-full border border-b p-3 text-right lg:static lg:table-cell lg:w-auto">
                                                    <span class="absolute top-[20%] left-0 px-2 py-1 text-xs font-bold uppercase lg:hidden">Invoice Number</span>
                                                    <p class="break-words">
                                                        <?php echo $type; ?>
                                                    </p>
                                                </td>
                                                <td class="text-gray-800 dark:text-white relative md:text-center block w-full border border-b p-3 text-right lg:static lg:table-cell lg:w-auto">
                                                    <span class="absolute top-[20%] left-0 px-2 py-1 text-xs font-bold uppercase lg:hidden">Payment</span>
                                                    <p class="break-words">
                                                        <?php echo $price; ?>
                                                    </p>
                                                </td>
                                                <td class="text-gray-800 dark:text-white relative md:text-center block w-full border border-b p-3 text-right lg:static lg:table-cell lg:w-auto">
                                                    <span class="absolute top-[20%] left-0 px-2 py-1 text-xs font-bold uppercase lg:hidden">Payment</span>
                                                    <p class="break-words">
                                                        <?php echo $sell_price; ?>
                                                    </p>
                                                </td>
                                                <td class="text-gray-800 dark:text-white relative md:text-center block w-full border border-b p-3 text-right lg:static lg:table-cell lg:w-auto">
                                                    <span class="absolute top-[20%] left-0 px-2 py-1 text-xs font-bold uppercase lg:hidden">Total $</span>
                                                    <p class="break-words">
                                                        <?php echo $quantity; ?>
                                                    </p>
                                                </td>
                                                <td class="text-gray-800 dark:text-white relative md:text-center block w-full border border-b p-3 text-right lg:static lg:table-cell lg:w-auto">
                                                    <span class="absolute top-[20%] left-0 px-2 py-1 text-xs font-bold uppercase lg:hidden">Date</span>
                                                    <p class="break-words">
                                                        <?php echo $exdate; ?>
                                                    </p>
                                                </td>
                                                <td class="text-gray-800 dark:text-white relative md:text-center block w-full border border-b p-3 text-right lg:static lg:table-cell lg:w-auto">
                                                    <span class="absolute top-[20%] left-0 px-2 py-1 text-xs font-bold uppercase lg:hidden">Invoice Number</span>
                                                    <p class="break-words">
                                                        <?php echo $invoice_number; ?>
                                                    </p>
                                                </td>
                                                <td class="text-gray-800 dark:text-white relative md:text-center block w-full border border-b p-3 text-right lg:static lg:table-cell lg:w-auto">
                                                    <span class="absolute top-[20%] left-0 px-2 py-1 text-xs font-bold uppercase lg:hidden">Invoice Number</span>
                                                    <p class="break-words">
                                                        <?php echo $reg_date; ?>
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

                                    ?>
                                </tbody>
                            </table>
                            <div class="flex gap-6 flex-col items-center justify-between xl:flex-row">
                                <button type="button" onclick="printInvoice()" class="w-full text-center text-white  bg-secondary px-4 py-2 hover:bg-primary transition-all ease-in duration-200 ">Print</button>
                                <a href="./backend/addSupplier.php?invoice=<?php echo $invoice_number; ?>" class="w-full text-center text-white  bg-primary px-4 py-2 hover:bg-secondary transition-all ease-in duration-200">Confirm</a>
                            </div>
                        <?php
                        } else {
                        ?>
                            <div class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
                                <div class="border-b border-stroke py-4 px-6.5 dark:border-strokedark">
                                    <h3 class="font-semibold text-black dark:text-white">
                                        Add New Supplier
                                    </h3>
                                </div>
                                <form action="./backend/addSupplier.php" method="POST">
                                    <div class="p-6.5">
                                        <div class="mb-4.5 flex flex-col gap-6 xl:flex-row">
                                            <div class="w-full ">
                                                <label class="mb-2.5 block text-black dark:text-white">
                                                    Name
                                                </label>
                                                <input required name="name" type="text" class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                                            </div>

                                        </div>
                                        <div class="mb-4.5 flex flex-col gap-6 xl:flex-row">
                                            <div class="w-full ">
                                                <label class="mb-2.5 block text-black dark:text-white">
                                                    Invoice Number
                                                </label>
                                                <input required name="invoice_number" type="text" class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                                            </div>


                                        </div>
                                        <div class="mb-4.5 flex flex-col gap-6 xl:flex-row">

                                            <div class="w-full ">
                                                <label class="mb-2.5 block text-black dark:text-white">
                                                    Quantity
                                                </label>
                                                <input required name="quantity" type="number" min='0' class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                                            </div>
                                        </div>
                                        <div class="mb-2 flex flex-col gap-6 xl:flex-row">
                                            <input type="hidden" name="med_id">
                                            <div class="w-full">
                                                <label class="mb-2.5 block text-black dark:text-white invisible">
                                                    btn
                                                </label>
                                                <input type="submit" value="Next" name="nextForm" class="w-full bg-primary hover:bg-secondary hover:pointer-events-auto rounded text-white py-3 px-5 font-medium outline-none transition" />
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>


            </main>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script defer src="bundle.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>

    <script src="./script/app.js"></script>

    <script>
        function printInvoice() {
            window.print()
        }
    </script>
</body>

</html>
<?php
require_once './backend/db.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Pharmacy | Payments</title>
    <link rel="icon" href="favicon.ico">
    <link href="./style/style.css" rel="stylesheet">
</head>

<body x-data="{ page: 'settings', 'loaded': true, 'darkMode': true, 'stickyMenu': false, 'sidebarToggle': false, 'scrollTop': false }" x-init="
         darkMode = JSON.parse(localStorage.getItem('darkMode'));
         $watch('darkMode', value => localStorage.setItem('darkMode', JSON.stringify(value)))" :class="{'dark text-bodydark bg-boxdark-2': darkMode === true}">
    <div class="flex h-screen overflow-hidden">
        <?php
        $page = 'settings';
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
                    <div class="sm:w-1/2 mx-auto">
                        <form class="bg-white text-dark dark:bg-boxdark mb-8 rounded flex flex-col" action="./backend/addPayment.php" method="POST">
                            <div class="p-6.5">
                                <div class="text-center text-xl mb-4 dark:text-white text-black">Add Payment Method</div>
                                <div class="flex flex-col gap-6 xl:flex-row">
                                    <div class="w-full xl:w-1/2">
                                        <input name="name" type="text" class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                                    </div>
                                    <div class="w-full xl:w-1/2">
                                        <input type="submit" value="Add" name="submit" class="w-full bg-primary hover:bg-secondary hover:cursor-pointer rounded text-white py-3 px-5 font-medium outline-none transition" />
                                    </div>
                                </div>
                            </div>
                        </form>

                        <table class="w-full border-collapse text-boxdark-2 dark:bg-danger dark:text-white">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th class=" border-gray-300 hidden border p-3 font-bold uppercase lg:table-cell">
                                        Name
                                    </th>
                                    <th class=" border-gray-300 hidden border p-3 font-bold uppercase lg:table-cell">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="dark:bg-black dark:text-white " id="tbody">
                                <?php
                                $sql = $conn->query("SELECT * FROM `paymentmethod`");
                                if ($sql->num_rows > 0) {
                                    while ($row = $sql->fetch_assoc()) {
                                        $id = $row['id'];
                                        $name = $row['name'];
                                ?>
                                        <tr class=" lg:flex-no-wrap mb-10 flex flex-row flex-wrap lg:mb-0 lg:table-row lg:flex-row">
                                            <td class="text-gray-800 dark:text-white relative w-full flex justify-between border border-b border-bodydark2 p-3 md:block lg:static lg:table-cell lg:w-auto">
                                                <span class=" px-2 py-1 text-center text-xs font-bold uppercase lg:hidden">Name</span>
                                                <p class="medicineName break-words ml-8 md:ml-0 md:text-left  capitalize">
                                                    <?php echo $name; ?>
                                                </p>
                                            </td>
                                            <td class="text-gray-800 dark:text-white relative md:text-center block w-full border border-b p-3 text-right lg:static lg:table-cell lg:w-auto">
                                                <span class="absolute top-[20%] left-0 px-2 py-1 text-xs font-bold uppercase lg:hidden">Action</span>
                                                <a href='./backend/deletePayment.php?id=<?php echo $id; ?>' class="bg-secondary px-4 py-2 hover:bg-primary rounded-lg">
                                                    <i class="fa-solid fa-x"></i>
                                                </a>
                                            </td>

                                    <?php
                                    }
                                }


                                    ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <script defer src="bundle.js"></script>
    <script src="./script/app.js"></script>
</body>

</html>
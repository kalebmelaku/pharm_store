<?php
require './backend/db.php';
require './backend/auth.php';
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Pharmacy | Password</title>
    <link rel="icon" href="favicon.ico">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css" rel="stylesheet" />
    <link href="./style/alert.css" rel="stylesheet">
    <link href="./style/style.css" rel="stylesheet">
</head>

<body x-data="{ page: 'settings', 'loaded': true, 'darkMode': true, 'stickyMenu': false, 'sidebarToggle': false, 'scrollTop': false }" x-init="
         darkMode = JSON.parse(localStorage.getItem('darkMode'));
         $watch('darkMode', value => localStorage.setItem('darkMode', JSON.stringify(value)))" :class="{'dark text-bodydark bg-boxdark-2': darkMode === true}">
    <div class="flex h-screen overflow-hidden">
        <?php
        $page = 'settings';
        $curr = 'password';
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

                                    $email = $_SESSION['user'];
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
                        <form class="bg-white text-dark dark:bg-boxdark mb-4 rounded flex flex-col w-1/2" action="./backend/changePass.php" method="POST">
                            <div class="p-6.5">
                                <div class="text-center text-xl mb-5 dark:text-white text-black">Change Password</div>
                                <div class="w-full mb-4">
                                    <label class="mb-2.5 block text-black dark:text-white">
                                        Current Password
                                    </label>
                                    <input name="current" required type="password" class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input readonly dark:focus:border-primary" />
                                </div>
                                <div class="w-full mb-4">
                                    <label class="mb-2.5 block text-black dark:text-white">
                                        New Password
                                    </label>
                                    <input name="newPass" required type="password" class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                                </div>
                                <div class="w-full mb-4">
                                    <label class="mb-2.5 block text-black dark:text-white">
                                        Confirm Password
                                    </label>
                                    <input name="confPass" required type="password" class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
                                </div>
                                <div class="w-full mb-4">
                                    <input type="hidden" name="email" value="<?php echo $email; ?>">
                                    <input name="submit" type="submit" class="w-full bg-primary hover:bg-secondary hover:pointer-events-auto rounded text-white py-3 px-5 font-medium outline-none transition" />
                                </div>
                            </div>
                        </form>
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
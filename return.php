<?php
require './backend/db.php';
require './backend/auth.php';
$sql2 = $conn->query("DELETE FROM `pharmacy_sale` WHERE `quan` = 0");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Pharmacy | Return</title>
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
        $curr = 'return';
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
                        <form class="bg-white text-dark dark:bg-boxdark mb-4 rounded flex flex-col w-3/4">
                            <div class="p-6.5">
                                <div class="text-center text-xl mb-5 dark:text-white text-black">Return Sale</div>
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
                                                Sale Method
                                            </th>
                                            <th class=" border-gray-300 hidden border p-3 font-bold uppercase lg:table-cell">
                                                Return Amount
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="dark:bg-black dark:text-white" id="tbody">
                                        <tr class=" lg:flex-no-wrap mb-10 flex flex-row flex-wrap lg:mb-0 lg:table-row lg:flex-row">
                                            <td class="text-gray-800 dark:text-white relative w-full flex justify-between border border-b border-bodydark2 p-3 md:block lg:static lg:table-cell lg:w-auto">
                                                <select class="relative z-20 w-full appearance-none rounded border border-stroke bg-transparent py-3 px-3 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input" name="med_name" id="med_name">
                                                    <option selected disabled value="">Select Medicine</option>
                                                    <?php
                                                    $today = date('Y-m-d');
                                                    $sql = $conn->query("SELECT DISTINCT id, name, type FROM `pharmacy_sale` WHERE `date` = '$today'");
                                                    while ($row = $sql->fetch_assoc()) {
                                                        $med_id = $row['id'];
                                                        $name = $row['name'];
                                                        $type = $row['type'];
                                                    ?>
                                                        <option class="py-2" value="<?php echo $med_id; ?>"><?php echo $name; ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                                <!-- <span class=" px-2 py-1 text-center text-xs font-bold uppercase lg:hidden">Name</span>
                                                <p class="medicineName break-words ml-8 md:ml-0 md:text-left  capitalize">
                                                    Name
                                                </p> -->
                                            </td>
                                            <td class="text-gray-800 dark:text-white relative md:text-center block w-full border border-b p-3 text-right lg:static lg:table-cell lg:w-auto">
                                                <span class="absolute top-[20%] left-0 px-2 py-1 text-xs font-bold uppercase lg:hidden">Type</span>
                                                <p class="break-words" id="type">
                                                </p>
                                            </td>
                                            <td class="text-gray-800 dark:text-white relative md:text-center block w-full border border-b p-3 text-right lg:static lg:table-cell lg:w-auto">
                                                <span class="absolute top-[20%] left-0 px-2 py-1 text-xs font-bold uppercase lg:hidden">Sale Method</span>
                                                <select class="relative z-20 w-full appearance-none rounded border border-stroke bg-transparent py-3 px-3 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input" name="med_type" id="med_type">
                                                </select>
                                            </td>
                                            <td class="text-gray-800 dark:text-white relative md:text-center block w-full border border-b p-3 text-right lg:static lg:table-cell lg:w-auto">
                                                <span class="absolute top-[20%] left-0 px-2 py-1 text-xs font-bold uppercase lg:hidden">Return Amount</span>
                                                <input required type="number" name="return_amount" id="return_amount" min='0' class="w-full bg-transparent hover:pointer-events-auto rounded text-white py-3 px-5 font-medium outline-none transition">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <input id="btn" type="submit" value="Return" class="mt-6 w-full bg-primary dark:bg-primary py-3 text-white bg-graydark hover:bg-secondary">
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
    <script>
        const med_name_select = document.getElementById('med_name');
        const btn = document.getElementById('btn');
        med_name_select.addEventListener('change', (e) => {
            const med_id = e.target.value;
            fetch(`http://localhost/pharm_store/api/fetchSoldMedicine.php?med_id=${med_id}`)
                .then(response => response.json())
                .then(data => {
                    const payments = data.map(item => item);
                    const selectPayment = document.getElementById('med_type');

                    selectPayment.innerHTML = '';
                    payments.forEach(payment => {
                        document.getElementById('type').innerText = payment.type
                        const option = document.createElement('option');
                        option.text = payment.payment
                        selectPayment.appendChild(option);
                    })
                })
                .catch(error => console.log(error))
        })
        btn.addEventListener('click', (e) => {
            const med_id = document.getElementById('med_name').value;
            const sale = document.getElementById('med_type').value;
            const amount = document.getElementById('return_amount').value;

            const postData = {
                med_id,
                amount,
                sale
            };
            const options = {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(postData)
            };
            const url = 'http://localhost/pharm_store/backend/returnSale.php';
            fetch(url, options)
                .then(response => 
                    window.location.href = response.url
                )
                
                .catch(error => {
                    // Handle errors
                    console.error('Error:', error);
                });
            e.preventDefault();
        })
    </script>
</body>

</html>
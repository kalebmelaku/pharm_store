<table class="w-full border-collapse text-boxdark-2 dark:bg-danger dark:text-white">
    <thead class="bg-primary text-white">
        <tr>
            <th class=" border-gray-300 hidden border p-3 font-bold uppercase lg:table-cell">
                Patient ID
            </th>
            <th class=" border-gray-300 hidden border p-3 font-bold uppercase lg:table-cell">
                Patient Name
            </th>
            <th class=" border-gray-300 hidden border p-3 font-bold uppercase lg:table-cell">
                Total Medicines
            </th>
            <th class=" border-gray-300 hidden border p-3 font-bold uppercase lg:table-cell">
                Total Amount ($)
            </th>
            <th class=" border-gray-300 hidden border p-3 font-bold uppercase lg:table-cell">
                Payment Status
            </th>
            <th class=" border-gray-300 hidden border p-3 font-bold uppercase lg:table-cell">
                Actions
            </th>
        </tr>
    </thead>
    <tbody class="dark:bg-black dark:text-white " id="tbody">
        <?php

        // retrieve selected results from database and display them on page

        $sql = $conn->query(
            '
        SELECT 
        patient_id,
        payment,
        date,
        SUM(tot_amount) AS tot_amount,
        COUNT(amount) AS amount
        FROM 
        admission_med
        GROUP BY 
        patient_id, payment
        ORDER BY 
                date DESC
        LIMIT ' . $this_page_first_result . ',' . $results_per_page
        );
        if ($sql->num_rows > 0) {
            while ($row = $sql->fetch_assoc()) {
                $id = $row['patient_id'];
                // $med_name = $row['name'];
                $total_amount = $row['amount'];
                $total_price = $row['tot_amount'];
                $payment = $row['payment'];
                $date = $row['date'];

                $getName = $conn->query("SELECT * FROM `patient` WHERE `id` = '$id'");
                $rs = $getName->fetch_assoc();
                $pat_name = $rs['name'];
                $pageName = '';
        ?>
                <tr class=" lg:flex-no-wrap mb-10 flex flex-row flex-wrap lg:mb-0 lg:table-row lg:flex-row">
                    <td class="text-gray-800 dark:text-white relative md:text-center block w-full border border-b p-3 text-right lg:static lg:table-cell lg:w-auto">
                        <span class="absolute top-[20%] left-0 px-2 py-1 text-xs font-bold uppercase lg:hidden">Pat_id</span>
                        <p class="break-words">
                            <?php echo $id; ?>
                        </p>
                    </td>
                    <td class="text-gray-800 dark:text-white relative md:text-center block w-full border border-b p-3 text-right lg:static lg:table-cell lg:w-auto">
                        <span class="absolute top-[20%] left-0 px-2 py-1 text-xs font-bold uppercase lg:hidden">Pat_id</span>
                        <p class="break-words capitalize text-left">
                            <?php
                            echo $pat_name;
                            ?>
                        </p>
                    </td>
                    <td class="text-gray-800 dark:text-white relative md:text-center block w-full border border-b p-3 text-right lg:static lg:table-cell lg:w-auto">
                        <span class="absolute top-[20%] left-0 px-2 py-1 text-xs font-bold uppercase lg:hidden">Total $</span>
                        <p class="break-words">
                            <?php echo $total_amount; ?>
                        </p>
                    </td>
                    <td class="text-gray-800 dark:text-white relative md:text-center block w-full border border-b p-3 text-right lg:static lg:table-cell lg:w-auto">
                        <span class="absolute top-[20%] left-0 px-2 py-1 text-xs font-bold uppercase lg:hidden">Total $</span>
                        <p class="break-words">
                            <?php echo $total_price . " BIRR"; ?>
                        </p>
                    </td>
                    <td class="text-gray-800 dark:text-white relative md:text-center block w-full border border-b p-3 text-right lg:static lg:table-cell lg:w-auto">
                        <span class="absolute top-[20%] left-0 px-2 py-1 text-xs font-bold uppercase lg:hidden">Payment</span>
                        <p class="break-words">
                            <?php
                            if ($payment == 0) {
                                echo "Unpaid";
                            } else {
                                echo "Paid";
                            }
                            ?>
                        </p>
                    </td>
                    <td class="text-gray-800 dark:text-white relative md:text-center block w-full border border-b p-3 text-right lg:static lg:table-cell lg:w-auto">
                        <span class="absolute top-[20%] left-0 px-2 py-1 text-xs font-bold uppercase lg:hidden">Actions</span>
                        <a href="./admissionDetail.php?id=<?php echo $id; ?>&payment=<?php echo $payment; ?>&pat_name=<?php echo $pat_name; ?>" class="text-white  bg-secondary px-4 py-2 hover:bg-primary transition-all ease-in duration-200 ">Detail</a>
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
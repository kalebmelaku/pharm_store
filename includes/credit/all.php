<table class="w-full border-collapse text-boxdark-2 dark:bg-danger dark:text-white">
    <thead class="bg-primary text-white">
        <tr>
            <th class=" border-gray-300 hidden border p-3 font-bold uppercase lg:table-cell">
                Organization Name
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
        *,
        SUM(sub_price) AS tot_amount,
        SUM(quan) AS amount
        FROM 
        credit_pharm
        GROUP BY 
            status, org
        ORDER BY 
                date DESC
        LIMIT ' . $this_page_first_result . ',' . $results_per_page
        );
        if ($sql->num_rows > 0) {
            while ($row = $sql->fetch_assoc()) {
                // $id = $row['patient_id'];
                $org = $row['org'];
                $total_amount = $row['amount'];
                $total_price = $row['tot_amount'];
                $date = $row['date'];
                $status = $row['status'];
                $payment = '';
                $status ? $payment = 'Paid' : $payment = 'Not Paid';
        ?>
                <tr class=" lg:flex-no-wrap mb-10 flex flex-row flex-wrap lg:mb-0 lg:table-row lg:flex-row">
                    <td class="text-gray-800 dark:text-white relative md:text-center block w-full border border-b p-3 text-right lg:static lg:table-cell lg:w-auto">
                        <span class="absolute top-[20%] left-0 px-2 py-1 text-xs font-bold uppercase lg:hidden">Org_Name</span>
                        <p class="break-words uppercase text-left">
                            <?php echo $org; ?>
                        </p>
                    </td>
                    <td class="text-gray-800 dark:text-white relative md:text-center block w-full border border-b p-3 text-right lg:static lg:table-cell lg:w-auto">
                        <span class="absolute top-[20%] left-0 px-2 py-1 text-xs font-bold uppercase lg:hidden">Total Amount</span>
                        <p class="break-words capitalize text-left">
                            <?php
                            echo $total_amount;
                            ?>
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
                            <?php echo $payment; ?>
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
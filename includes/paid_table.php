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
            <?php echo $invoice_no; ?>
        </p>
    </td>
    <td class="text-gray-800 dark:text-white relative md:text-center block w-full border border-b p-3 text-right lg:static lg:table-cell lg:w-auto">
        <span class="absolute top-[20%] left-0 px-2 py-1 text-xs font-bold uppercase lg:hidden">Payment</span>
        <p class="break-words">
            <?php
            if ($status == 0) {

                echo "Unpaid";
            } else {
                echo "Paid";
            }
            ?>
        </p>
    </td>
    <td class="text-gray-800 dark:text-white relative md:text-center block w-full border border-b p-3 text-right lg:static lg:table-cell lg:w-auto">
        <span class="absolute top-[20%] left-0 px-2 py-1 text-xs font-bold uppercase lg:hidden">Total $</span>
        <p class="break-words">
            <?php echo $total . " BIRR"; ?>
        </p>
    </td>
    <td class="text-gray-800 dark:text-white relative md:text-center block w-full border border-b p-3 text-right lg:static lg:table-cell lg:w-auto">
        <span class="absolute top-[20%] left-0 px-2 py-1 text-xs font-bold uppercase lg:hidden">Payment Date</span>
        <p class="break-words">
            <?php echo $date; ?>
        </p>
    </td>

    <td class="text-gray-800 dark:text-white relative md:text-center block w-full border border-b p-3 text-right lg:static lg:table-cell lg:w-auto">
        <span class="absolute top-[20%] left-0 px-2 py-1 text-xs font-bold uppercase lg:hidden">Actions</span>
        <?php
        if ($status == 0) {

        //   "delQueue(\''. $result['id']. '\')"
        echo '<button onclick="modal(' . $invoice_no . ', \'' . $name . '\', ' . $total . ')" data-modal-target="default-modal" data-modal-toggle="default-modal" class="border-0 text-white bg-secondary px-4 py-1 hover:bg-primary transition-all ease-in duration-200" type="button">
        Pay
    </button>';

    
        } else {
        }
        ?>

        <a href="./unpaidDetail.php?id=<?php echo $invoice_no; ?>" class="text-white  bg-secondary px-4 py-2 hover:bg-primary transition-all ease-in duration-200 ">Detail</a>
    </td>
</tr>
<tr class=" lg:flex-no-wrap mb-10 flex flex-row flex-wrap lg:mb-0 lg:table-row lg:flex-row">
    <td class="text-gray-800 dark:text-white relative w-full flex justify-between border border-b border-bodydark2 p-3 md:block lg:static lg:table-cell lg:w-auto">
        <span class=" px-2 py-1 text-center text-xs font-bold uppercase lg:hidden">Name</span>
        <p class="medicineName break-words ml-8 md:ml-0 md:text-left  capitalize">
            <?php echo $name; ?>
        </p>
    </td>
    <td class="text-gray-800 dark:text-white relative md:text-center block w-full border border-b p-3 text-right lg:static lg:table-cell lg:w-auto">
        <span class="absolute top-[20%] left-0 px-2 py-1 text-xs font-bold uppercase lg:hidden">Type</span>
        <p class="break-words">
            <?php echo $type; ?>
        </p>
    </td>
    <td class="text-gray-800 dark:text-white relative md:text-center block w-full border border-b p-3 text-right lg:static lg:table-cell lg:w-auto">
        <span class="absolute top-[20%] left-0 px-2 py-1 text-xs font-bold uppercase lg:hidden">Quantity</span>
        <p class="break-words">
            <?php echo $amount; ?>
        </p>
    </td>
    <td class="text-gray-800 dark:text-white relative md:text-center block w-full border border-b p-3 text-right lg:static lg:table-cell lg:w-auto">
        <span class="absolute top-[20%] left-0 px-2 py-1 text-xs font-bold uppercase lg:hidden">Selling $</span>
        <p class="break-words">
            <?php echo $sell_price . " BIRR"; ?>
        </p>
    </td>
    <td class="text-gray-800 dark:text-white relative md:text-center block w-full border border-b p-3 text-right lg:static lg:table-cell lg:w-auto">
        <span class="absolute top-[20%] left-0 px-2 py-1 text-xs font-bold uppercase lg:hidden">Exp Date</span>
        <p class="break-words">
            <?php echo $exp_date; ?>
        </p>
    </td>

    <td class="text-gray-800 dark:text-white relative md:text-center block w-full border border-b p-3 text-right lg:static lg:table-cell lg:w-auto">
        <span class="absolute top-[20%] left-0 px-2 py-1 text-xs font-bold uppercase lg:hidden">Actions</span>

        <a href="<?php echo ($pageName === 'approve') ? './backend/approvePharmacy.php?id=' . $id : './updatePharmacy.php?id=' . $id; ?>"
            class="text-white bg-secondary px-4 py-2 hover:bg-primary transition-all ease-in duration-200">
            <?php echo ($pageName === 'approve') ? 'Approve' : 'Update'; ?>
        </a>
    </td>
</tr>
<tr class=" lg:flex-no-wrap mb-10 flex flex-row flex-wrap lg:mb-0 lg:table-row lg:flex-row">
    <td class="text-gray-800 dark:text-white relative w-full flex justify-between border border-b border-bodydark2 p-3 md:block lg:static lg:table-cell lg:w-auto">
        <span class=" px-2 py-1 text-center text-xs font-bold uppercase lg:hidden">Name</span>
        <p class="medicineName break-words ml-8 md:ml-0 md:text-left  capitalize">
            <?php echo $total_unpaid; ?>
        </p>
    </td>
    <td class="text-gray-800 dark:text-white relative md:text-center block w-full border border-b p-3 text-right lg:static lg:table-cell lg:w-auto">
        <span class="absolute top-[20%] left-0 px-2 py-1 text-xs font-bold uppercase lg:hidden">Invoice Number</span>
        <p class="break-words">
        <?php echo $total_paid; ?>
        </p>
    </td>

    <td class="text-gray-800 dark:text-white relative md:text-center block w-full border border-b p-3 text-right lg:static lg:table-cell lg:w-auto">
        <span class="absolute top-[20%] left-0 px-2 py-1 text-xs font-bold uppercase lg:hidden">Total $</span>
        <p class="break-words">
        <?php echo $total_cost; ?>
        </p>
    </td>
    <td class="text-gray-800 dark:text-white relative md:text-center block w-full border border-b p-3 text-right lg:static lg:table-cell lg:w-auto">
        <span class="absolute top-[20%] left-0 px-2 py-1 text-xs font-bold uppercase lg:hidden">Total $</span>
        <p class="break-words">
        <?php echo $total_revenue; ?>
        </p>
    </td>
    <td class="text-gray-800 dark:text-white relative md:text-center block w-full border border-b p-3 text-right lg:static lg:table-cell lg:w-auto">
        <span class="absolute top-[20%] left-0 px-2 py-1 text-xs font-bold uppercase lg:hidden">Total $</span>
        <p class="break-words">
        <?php echo $total_profit; ?>
        </p>
    </td>


</tr>
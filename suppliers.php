<?php
require './backend/db.php';
require './backend/auth.php';
$select = $conn->query('SELECT `status` FROM `suppliers`');
$rs = $select->fetch_assoc();
$payStatus = @$rs['status']
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<title>Pharmacy | Suppliers</title>
	<link rel="icon" href="favicon.ico">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css" rel="stylesheet" />
	<link href="./style/alert.css" rel="stylesheet">
	<link href="./style/style.css" rel="stylesheet">
</head>

<body x-data="{ page: 'suppliers', 'loaded': true, 'darkMode': true, 'stickyMenu': false, 'sidebarToggle': false, 'scrollTop': false }" x-init="
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
					<!-- component -->

					<div class="flex items-center justify-center">
						<form class="bg-white text-dark dark:bg-boxdark mb-4 rounded flex flex-col" action="./suppliers.php" method="GET">
							<div class="p-6.5">
								<div class="text-center text-xl mb-2 dark:text-white text-black">Filter Search</div>
								<div class="flex mb-4 gap-4">
									<div class="w-full xl:w-1/2">
										<input placeholder="Invoice Number" name="invoice_no" type="text" class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
									</div>
									<div class="w-full xl:w-1/2">
										<input placeholder="Supplier Name" name="supplier_name" type="text" class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
									</div>
								</div>
								<div class=" flex flex-col gap-6 xl:flex-row">
									<div class="w-full">
										<div class="flex justify-between align-center">
											<div class="flex items-center gap-3 border p-2">
												<label for="all" class="flex cursor-pointer select-none items-center">
													All
												</label>
												<div class="relative">
													<input type="radio" checked name="checkPayment" id="all" class="" value="all" />
												</div>
											</div>
											<div class="flex items-center gap-3 border p-2">
												<label for="payed" class="flex cursor-pointer select-none items-center">
													Payed
												</label>
												<div class="relative">
													<input type="radio" name="checkPayment" id="payed" class="" value="payed" />
												</div>
											</div>
											<div class="flex items-center gap-3 border p-2">
												<label for="notPayed" class="flex cursor-pointer select-none items-center">
													Not Payed
												</label>
												<div class="relative">
													<input type="radio" name="checkPayment" id="notPayed" class="" value="not payed" />
												</div>
											</div>
										</div>
									</div>
									<div class="w-full xl:w-1/2">
										<input type="submit" value="Search" name="search" class="w-full bg-primary hover:bg-secondary hover:cursor-pointer rounded text-white py-3 px-5 font-medium outline-none transition" />
									</div>
								</div>

								<div class="mb-2 flex flex-col gap-6 xl:flex-row">
								</div>
							</div>
							<a href="./addSupplier.php" class="text-white w- text-center bg-secondary px-4 py-2 hover:bg-primary transition-all ease-in duration-200 ">Add New Supplier</a>
						</form>
					</div>

					<?php
					$results_per_page = 15;
					$search_result = 1;
					$search = $_GET['search'] ?? '';
					// find out the number of results stored in database
					$sql = 'SELECT * FROM `suppliers`';
					$result = mysqli_query($conn, $sql);
					$number_of_results = mysqli_num_rows($result);

					// determine number of total pages available
					$number_of_pages = ceil($number_of_results / $results_per_page);

					// determine which page number visitor is currently on
					if (!isset($_GET['page'])) {
						$page = 1;
					} else {
						$page = $_GET['page'];
					}

					// determine the sql LIMIT starting number for the results on the displaying page
					$this_page_first_result = ($page - 1) * $results_per_page;
					if (!isset($_GET['search'])) { ?>
						<?php include './includes/suppliers_page/all.php'; ?>
					<?php
					} else {
						$invoice_no = $_GET['invoice_no'];
						$checkPayment = $_GET['checkPayment'];
						$supplier_name = $_GET['supplier_name'];
						if (!empty($supplier_name)) {
							include './includes/suppliers_page/supplier_name.php';
						} else if (!empty($invoice_no)) {
							include './includes/suppliers_page/invoice_all.php';
						} else if ($checkPayment == 'payed') {
							include './includes/suppliers_page/payed.php';
						} else if ($checkPayment == 'not payed') {
							include './includes/suppliers_page/notPayed.php';
						} else if ($checkPayment == 'all') {
							include './includes/suppliers_page/all.php';
						}
					}
					?>
				</div>
				<!-- Main modal -->
				<div id="default-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
					<div class="relative p-4 w-full max-w-2xl max-h-full">
						<!-- Modal content -->
						<div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
							<!-- Modal header -->
							<div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
								<h3 class="text-xl font-semibold text-gray-900 dark:text-white">
									Invoice Payment
								</h3>
							</div>
							<!-- Modal body -->
							<div class="p-4 md:p-5 space-y-4">
								<form action="./backend/payInvoice.php" method="POST">
									<div class="p-6.5">
										<div class="mb-4.5 flex flex-col gap-6 xl:flex-row">
											<div class="w-full xl:w-1/2">
												<label class="mb-2.5 block text-black dark:text-white">
													Name
												</label>
												<input readonly required id="invoiceName" name="name" type="text" class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input readonly dark:focus:border-primary" />
											</div>
											<div class="w-full xl:w-1/2">
												<label class="mb-2.5 block text-black dark:text-white">
													Invoice Number
												</label>
												<input readonly required id="invoiceInput" name="invoiceNumber" type="text" class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
											</div>
										</div>
										<div class="mb-4.5 flex flex-col gap-6 xl:flex-row">
											<div class="w-full xl:w-1/2">
												<label class="mb-2.5 block text-black dark:text-white">
													Total Price
												</label>
												<input required readonly id="invoiceTotal" name="price" type="text" class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
											</div>
											<div class="w-full xl:w-1/2">
												<label class="mb-3 block text-sm font-medium text-black dark:text-white">
													Payment Method
												</label>
												<div>
													<div class="relative z-20 bg-white dark:bg-form-input">
														<select class="relative z-20 w-full appearance-none rounded border border-stroke bg-transparent py-3 px-3 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input" id="paymentMethod" name="paymentMethod" required>
															<option value="cash" disabled selected>Select Payment Method</option>
															<?php
															$fetchPayment = $conn->query("SELECT * FROM `paymentmethod`");
															while ($payment = $fetchPayment->fetch_assoc()) {
																$paymentName = $payment['name'];
															?>
																<option value="<?php echo $paymentName; ?>"><?php echo $paymentName; ?></option>
															<?php
															}
															?>
														</select>
													</div>
												</div>
											</div>
										</div>
										<div class="mb-2 flex flex-col gap-6 xl:flex-row">
											<input type="hidden" name="med_id" value="">
											<div class="w-full">
												<label class="mb-2.5 block text-black dark:text-white invisible">
													btn
												</label>
												<input type="submit" value="Pay" name="payInvoice" class="w-full bg-primary hover:bg-secondary hover:pointer-events-auto rounded text-white py-3 px-5 font-medium outline-none transition" />
											</div>
										</div>
									</div>
								</form>
							</div>
						</div>
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
		const table = document.querySelector('table');
		const searchResult = document.getElementById('searchResult');
		const invoiceInput = document.getElementById('invoiceInput');
		const invoiceName = document.getElementById('invoiceName');
		const invoiceTotal = document.getElementById('invoiceTotal');
		const referenceNo = document.getElementById('referenceNo');
		const refCont = document.getElementById('refCont');
		const paymentMethod = document.getElementById('paymentMethod');
		if (table.lastElementChild.innerText == '') {
			table.classList.add('hidden');
		} else {
			table.classList.remove('hidden');
		}

		function modal(id, name, total) {
			invoiceInput.value = id;
			invoiceName.value = name;
			invoiceTotal.value = total;

		}
	</script>
</body>

</html>
<?php
require './backend/db.php';
$select = $conn->query('SELECT `status` FROM `suppliers`');
$rs = $select->fetch_assoc();
$payStatus = $rs['status']
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
						<form class="bg-white text-dark dark:bg-boxdark mb-4 rounded" action="./suppliers.php" method="GET">
							<div class="p-6.5">
								<div class="text-center text-xl mb-2 dark:text-white text-black">Filter Search</div>
								<div class=" flex flex-col gap-6 xl:flex-row">
									<div class="w-full xl:w-1/2">
										<input placeholder="Invoice Number" name="invoice_no" type="text" class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
									</div>
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

						if (!empty($invoice_no)) {
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

		if (table.lastElementChild.innerText == '') {
			table.classList.add('hidden');
		} else {
			table.classList.remove('hidden');
		}
	</script>
</body>

</html>
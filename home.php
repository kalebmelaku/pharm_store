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
	<link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css" rel="stylesheet" />
	<title>Pharmacy | Store</title>
	<link rel="icon" href="favicon.ico">
	<link href="./style/style.css" rel="stylesheet">
	<link href="./style/alert.css" rel="stylesheet">
</head>

<body x-data="{ page: 'home', 'loaded': true, 'darkMode': true, 'stickyMenu': false, 'sidebarToggle': false, 'scrollTop': false }" x-init="
         darkMode = JSON.parse(localStorage.getItem('darkMode'));
         $watch('darkMode', value => localStorage.setItem('darkMode', JSON.stringify(value)))" :class="{'dark text-bodydark bg-boxdark-2': darkMode === true}">

	<div class="flex h-screen overflow-hidden">
		<?php
		$page = 'home';
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
						<form class="mx-10 flex w-3/4 mb-8 rounded bg-white dark:bg-boxdark" action="./home.php" method="GET">
							<input class="text-gray-400 w-3/4 border-none rounded-md bg-transparent dark:bg-boxdark px-4 py-1 outline-none focus:outline-none" type="search" name="search" placeholder="Search..." />
							<button type="submit" class=" text-sm md:text-lg md:w-1/4 w-[30%]  cursor-pointer rounded-lg border border-primary bg-primary p-4 font-medium text-white transition hover:bg-opacity-90">
								Search
							</button>
						</form>
					</div>

					<?php
					$results_per_page = 15;
					$search_result = 1;
					$search = $_GET['search'] ?? '';
					// find out the number of results stored in database
					$sql = 'SELECT * FROM `pharm_store` ';
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
					?>
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
									Quantity
								</th>
								<th class=" border-gray-300 hidden border p-3 font-bold uppercase lg:table-cell">
									Purchase $
								</th>
								<!-- <th class=" border-gray-300 hidden border p-3 font-bold uppercase lg:table-cell">
									Selling $
								</th> -->
								<th class=" border-gray-300 hidden border p-3 font-bold uppercase lg:table-cell">
									Reg Date
								</th>
								<th class=" border-gray-300 hidden border p-3 font-bold uppercase lg:table-cell">
									Exp Date
								</th>
								<th class=" border-gray-300 hidden border p-3 font-bold uppercase lg:table-cell">
									Actions
								</th>
							</tr>
						</thead>
						<tbody class="dark:bg-black dark:text-white " id="tbody">
							<?php

							// retrieve selected results from database and display them on page
							if (empty($search)) {
								$sql = $conn->query('SELECT * FROM `pharm_store` ORDER BY `name` ASC LIMIT ' . $this_page_first_result . ',' . $results_per_page);
								while ($row = $sql->fetch_assoc()) {
									$id = $row['id'];
									$name = $row['name'];
									$type = $row['type'];
									$amount = $row['amount'];
									$purchase = $row['sell_price'];
									$sell_price = $row['purchase_price'];
									$reg_date = $row['date'];
									$exp_date = $row['exdate'];
									$pageName = '';
									include './includes/table_row.php';
								}
							} else {
								$sql = $conn->query("SELECT * FROM `pharm_store` WHERE `name` LIKE '%$search%' ORDER BY `name` ASC");
								if ($sql->num_rows > 0) {
									while ($row = $sql->fetch_assoc()) {
										$id = $row['id'];
										$name = $row['name'];
										$type = $row['type'];
										$amount = $row['amount'];
										$purchase = $row['sell_price'];
										$sell_price = $row['purchase_price'];
										$reg_date = $row['date'];
										$exp_date = $row['exdate'];
										$pageName = '';
										include './includes/table_row.php';
									}
								} else {
									$search_result = 0;
							?>
									<h1 class="text-center text-2xl text-black dark:text-white">Item Not Found</h1>
									<h1 class="text-center text-2xl text-black dark:text-white">Please Check The Name Again</h1>
							<?php
								}
							}
							?>
						</tbody>
					</table>
					<!-- table end -->
					<!-- component pagination -->
					<div class="<?php if (empty($search)) {
									echo 'mt-8 flex justify-center flex-wrap wrap';
								} else {
									echo 'mt-8 flex justify-center hidden';
								} ?>">
						<nav aria-label="Page navigation example">
							<ul class="list-style-none flex">
								<?php
								for ($page = 1; $page <= $number_of_pages; $page++) {
								?>
									<li class="page-item">
										<a class="page-link hover:text-gray-800 hover:bg-gray-200 relative block rounded border-0 bg-transparent py-1.5 px-3 text-boxdark-2 outline-none transition-all duration-300 focus:shadow-none dark:text-whiter" href="home.php?page=<?php echo $page; ?>"><?php echo $page; ?></a>
									</li>
								<?php
								}
								?>
							</ul>
						</nav>
					</div>
					<!-- pagination end -->
					<!-- Main modal -->

				</div>

			</main>
			<!-- ===== Main Content End ===== -->
		</div>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
	<script defer src="bundle.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>

	<script>
		const table = document.querySelector('table');
		const searchResult = document.getElementById('searchResult');

		// if(searchResult.value == )
		if (table.lastElementChild.innerText == '') {
			table.classList.add('hidden');
		} else {
			table.classList.remove('hidden');
		}
	</script>
	<script src="./script/app.js"></script>
</body>

</html>
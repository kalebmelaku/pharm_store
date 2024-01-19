<?php
require './backend/db.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<title>Pharmacy | Expiring</title>
	<link rel="icon" href="favicon.ico">
	<link href="./style/style.css" rel="stylesheet">
</head>

<body x-data="{ page: 'expired', 'loaded': true, 'darkMode': true, 'stickyMenu': false, 'sidebarToggle': false, 'scrollTop': false }" x-init="
         darkMode = JSON.parse(localStorage.getItem('darkMode'));
         $watch('darkMode', value => localStorage.setItem('darkMode', JSON.stringify(value)))" :class="{'dark text-bodydark bg-boxdark-2': darkMode === true}">

	<div class="flex h-screen overflow-hidden">

		<?php 
		$page = 'expired';include './includes/sidebar.php'; ?>

		<div class="relative flex flex-1 flex-col overflow-y-auto overflow-x-hidden">
			<?php include './includes/header.php'; ?>
			<main>
				<div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
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
								<th class=" border-gray-300 hidden border p-3 font-bold uppercase lg:table-cell">
									Reg Date
								</th>
								<th class=" border-gray-300 hidden border p-3 font-bold uppercase lg:table-cell">
									Exp Date
								</th>
								<th class=" border-gray-300 hidden border p-3 font-bold uppercase lg:table-cell">
									Remaining Days
								</th>
							</tr>
						</thead>
						<tbody class="dark:bg-black dark:text-white " id="tbody">
							<?php
							$results_per_page = 15;
							$sql = "SELECT * FROM `pharm_store` WHERE `exdate` <= DATE_ADD(CURDATE(), INTERVAL 1 MONTH) ";
							$result = mysqli_query($conn, $sql);

							$number_of_results = mysqli_num_rows($result);
							$number_of_pages = ceil($number_of_results / $results_per_page);
							if (!isset($_GET['page'])) {
								$page = 1;
							} else {
								$page = $_GET['page'];
							}


							$this_page_first_result = ($page - 1) * $results_per_page;
							$sql = $conn->query("SELECT *, DATEDIFF(`exdate`, CURDATE()) AS days_remaining FROM `pharm_store` WHERE `exdate` <= DATE_ADD(CURDATE(), INTERVAL 1 MONTH) ORDER BY exdate ASC LIMIT $this_page_first_result , $results_per_page");

							while ($row = $sql->fetch_assoc()) {
								$id = $row['id'];
								$name = $row['name'];
								$type = $row['type'];
								$amount = $row['amount'];
								$purchase = $row['cost'];
								$sell_price = $row['price'];
								$reg_date = $row['date'];
								$exp_date = $row['exdate'];
								$remaining_days = $row['days_remaining'];

								$pageName = 'expired';
								include './includes/table_row.php';
							}

							?>
						</tbody>
					</table>
					<div class="mt-8 flex justify-center flex-wrap wrap">
						<nav aria-label="Page navigation example">
							<ul class="list-style-none flex">
								<?php
								for ($page = 1; $page <= $number_of_pages; $page++) {
								?>
									<li class="page-item">
										<a class="page-link hover:text-gray-800 hover:bg-gray-200 relative block rounded border-0 bg-transparent py-1.5 px-3 text-boxdark-2 outline-none transition-all duration-300 focus:shadow-none dark:text-whiter" href="expired.php?page=<?php echo $page; ?>"><?php echo $page; ?></a>
									</li>
								<?php
								}
								?>
							</ul>
						</nav>
					</div>
				</div>
			</main>
		</div>
	</div>
	<script defer src="bundle.js"></script>
</body>

</html>
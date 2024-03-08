<?php
require './backend/db.php';
$id = $_GET['id'];
if (empty($id)) {
	header("Location: ./home.php");
}
$sql = $conn->query("SELECT * FROM `pharm_store` WHERE `id` = '$id'");

while ($row = $sql->fetch_assoc()) {
	$med_name = $row['name'];
	$type = $row['type'];
	$amount = $row['amount'];
	$sell_price = $row['sell_price'];
	$purchase_price = $row['purchase_price'];
	$reg_date = $row['date'];
	$exp_date = $row['exdate'];
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<title>Pharmacy | Update</title>
	<link rel="icon" href="favicon.ico">
	<link href="./style/style.css" rel="stylesheet">
	<link href="./style/alert.css" rel="stylesheet">
</head>

<body x-data="{ page: 'expired', 'loaded': true, 'darkMode': true, 'stickyMenu': false, 'sidebarToggle': false, 'scrollTop': false }" x-init="
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
					<div class="flex flex-col gap-9 xl:w-1/2 mx-auto">

						<div class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
							<div class="border-b border-stroke py-4 px-6.5 dark:border-strokedark">
								<h3 class="font-semibold text-black dark:text-white">
									Update Medicine Detail
								</h3>
							</div>
							<form action="./backend/updateInventory.php" method="POST">
								<div class="p-6.5">
									<div class="mb-4.5 flex flex-col gap-6 xl:flex-row">
										<div class="w-full xl:w-1/2">
											<label class="mb-2.5 block text-black dark:text-white">
												Name
											</label>
											<input required name="name" type="text" value="<?php echo $med_name; ?>" class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
										</div>

										<div class="w-full xl:w-1/2">
											<label class="mb-2.5 block text-black dark:text-white">
												Type
											</label>
											<input required name="type" type="text" value="<?php echo $type; ?>" class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
										</div>
									</div>
									<div class="mb-4.5 flex flex-col gap-6 xl:flex-row">
										<div class="w-full xl:w-1/2">
											<label class="mb-2.5 block text-black dark:text-white">
												Quantity
											</label>
											<input required name="amount" type="text" value="<?php echo $amount ?>" class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
										</div>

										<div class="w-full xl:w-1/2">
											<label class="mb-2.5 block text-black dark:text-white">
												Purchase Price
											</label>
											<input required name="purchasePrice" type="text" value="<?php echo $purchase_price; ?>" class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
										</div>
									</div>
									<div class="mb-4.5 flex flex-col gap-6 xl:flex-row">
										<!-- <div class="w-full xl:w-1/2">
											<label class="mb-2.5 block text-black dark:text-white">
												Selling Price
											</label>
											<input required type="text" class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" value="<?php echo $sell_price; ?>" />
										</div> -->

										<div class="w-full ">
											<label class="mb-2.5 block text-black dark:text-white">
												Expire Date
											</label>
											<input required name="expDate" type="date" value="<?php echo $exp_date; ?>" class="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary" />
										</div>
									</div>
									<div class="mb-2 flex flex-col gap-6 xl:flex-row">
										<input type="hidden" name="med_id" value="<?php echo $id; ?>">
										<div class="w-full xl:w-1/2">
											<label class="mb-2.5 block text-black dark:text-white invisible">
												btn
											</label>
											<input type="submit" value="Update" name="updateBtn" class="w-full bg-primary hover:bg-secondary hover:pointer-events-auto rounded text-white py-3 px-5 font-medium outline-none transition" />
										</div>
										<div class="w-full xl:w-1/2">
											<label class="mb-2.5 block text-black dark:text-white invisible">
												btn
											</label>
											<input type="submit" value="Delete" name="deleteBtn" class="w-full bg-danger hover:cursor-pointer rounded text-white py-3 px-5 font-medium outline-none transition" />
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</main>
		</div>
	</div>
	<script defer src="bundle.js"></script>
	<script src="./script/app.js"></script>
</body>

</html>
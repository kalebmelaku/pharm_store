<?php

require '../backend/db.php';

$med_id = @$_GET['rm'];
$today = date("Y-m-d");
@$sql = "DELETE FROM `pharma_daily_sell` WHERE `id` = '$med_id'";
if (!$conn->query($sql)) {
	echo $conn->error;
}

// define how many results you want per page

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<!-- basic -->
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<!-- mobile metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta name="viewport" content="initial-scale=1, maximum-scale=1" />
	<!-- site metas -->
	<title>Admin</title>
	<meta name="keywords" content="" />
	<meta name="description" content="" />
	<meta name="author" content="" />
	<link href="https://fonts.googleapis.com/css2?family=Dosis:wght@200;300;400;600;700;800&display=swap" rel="stylesheet" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link rel="icon" href="../../img/favicon.ico" type="image/png" />
	<link rel="stylesheet" href="../styles/bootstrap.min.css" />
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/css/bootstrap-select.min.css">
	<link rel="stylesheet" href="../styles/style.css" />
	<link rel="stylesheet" href="../styles/responsive.css" />
	<link rel="stylesheet" href="../styles/bootstrap-select.css" />
	<link rel="stylesheet" href="../styles/perfect-scrollbar.css" />
	<link rel="stylesheet" href="../styles/custom.css" />
	<style>
		.btn-group {
			display: none !important;
		}
	</style>
</head>

<body class="dashboard dashboard_1">
	<div class="full_container">
		<div class="inner_container">
			<!-- Sidebar  -->
			<nav id="sidebar">
				<div class="sidebar_blog_1">
					<div class="sidebar-header">
						<div class="logo_section">
							<a href="index.html"><img class="logo_icon img-responsive" src="../../img/logo.png" alt="#" /></a>
						</div>
					</div>
					<div class="sidebar_user_info">
						<div class="icon_setting"></div>
						<div class="user_profle_side">
							<div class="user_img">
								<img class="img-responsive" src="../../img/logo.png" alt="#" />
							</div>
							<div class="user_info">
								<?php
								$phone = $_SESSION['user'];
								$sql = "SELECT * FROM `users` WHERE `phone` = '$phone'";
								$res = $conn->query($sql);
								while ($row = mysqli_fetch_assoc($res)) {
									$name = $row['name'];
								}
								?>
								<h6>
									<?php
									echo $name;
									?>
								</h6>
							</div>
						</div>
					</div>
				</div>
				<div class="sidebar_blog_2">
					<?php
					include './side_nav.php';
					?>
				</div>
			</nav>
			<!-- end sidebar -->

			<!-- right content -->
			<div id="content">
				<!-- topbar -->
				<div class="topbar">
					<nav class="navbar navbar-expand-lg navbar-light">
						<div class="full">
							<button type="button" id="sidebarCollapse" class="sidebar_toggle">
								<i class="fa-solid fa-bars"></i>
							</button>
							<div class="right_topbar"></div>
						</div>
					</nav>
				</div>
				<!-- end topbar -->

				<!-- dashboard inner -->
				<div class="midde_cont">
					<div class="container-fluid">
						<div class="info" id="info">
							<p class="error">
								<?php
								@$err = $_REQUEST['err'];
								echo $err;
								?>
							</p>
							<p class="succ">
								<?php
								@$lout = $_REQUEST['msg'];
								echo $lout;
								?>
							</p>
						</div>
						<form action="selled_list.php" class="search">
							<h3>Search</h3>
							<div class="search-form">
								<input type="date" name="date" id="search" />
								<input type="submit" name="search-date" value="Search" class="btn btn-primary" />
							</div>
						</form>

						<?php
						if (isset($_GET['search-date'])) {
							//$sdate = $_GET['search'];
							$today = $_GET['date'];
							$search_sql = "SELECT * FROM `pharma_daily_sell` WHERE `date` = '$today'";
							$rs = $conn->query($search_sql);
							echo "
									<table class='table'>
									<thead>
                                    <thead>
                                    <th>Name</th>
                                    <th>Type</th>
                                    <th>Amount</th>
                                    <th>Price</th>
                                    <th>sub_price</th>
                                    <th>Date</th>
                                </thead>
									</thead>
									";

							while ($row = mysqli_fetch_array($rs)) {
								$id = $row['id'];
								$name = $row['name'];
								$type = $row['type'];
								$price = $row['price'];
								$amount = $row['quan'];
								$sub = $row['sub_price'];
								$date = $row['date'];
								if ($amount == 0) {
									$rmv = "X";
								} else {
									$rmv = '';
								}
								echo "	
												<tbody>
													<tr>
														<td data-label='Name'>$name</td>
														<td data-label='Type'>$type</td>
														<td data-label='amount'>$amount</td>
														<td data-label='Sell Price'>$price</td>
														<td data-label='Reg Date'>$sub</td>
														<td data-label='Exp Date'><span class='rmv'>$date <a href='./selled_list.php?rm=$id'>$rmv</a></span></td>

														
													</tr>
												</tbody>
												";
							}

							// display the links to the pages



							//}
							// } else {
							// 	echo $conn->error;
							// }
							echo "</table>";
							echo '<div class="pagination">';
							//echo $_GET['page'];
							// for ($page = 1; $page <= $number_of_pages; $page++) {
							// 	
						}
						?>


					</div>
					<!-- footer -->
				</div>
				<!-- end dashboard inner -->
			</div>
		</div>
	</div>
	<!-- jQuery -->
	<script src="../js/jquery.min.js"></script>
	<script src="../js/popper.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>
	<!-- wow animation -->
	<script src="../js/animate.js"></script>
	<!-- select country -->
	<script src="../js/bootstrap-select.js"></script>
	<!-- nice scrollbar -->
	<script src="../js/perfect-scrollbar.min.js"></script>
	<script>
		var ps = new PerfectScrollbar("#sidebar");
	</script>
	<!-- custom js -->
	<script src="../js/custom.js"></script>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/js/bootstrap-select.min.js"></script>
</body>

</html>
<script>
	const feedback = document.getElementById("info");
	setTimeout(() => {
		feedback.style.display = "none";
	}, 3000)
</script>
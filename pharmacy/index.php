<?php
require '../backend/db.php';
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
	<title>Pharmacy</title>
	<meta name="keywords" content="" />
	<meta name="description" content="" />
	<meta name="author" content="" />
	<link href="https://fonts.googleapis.com/css2?family=Dosis:wght@200;300;400;600;700;800&display=swap" rel="stylesheet" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link rel="icon" href="../../img/favicon.ico" type="image/png" />
	<link rel="stylesheet" href="../styles/bootstrap.min.css" />
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/css/bootstrap-select.min.css">

	<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
	<link rel="stylesheet" href="./styles/style.css" />
	<link rel="stylesheet" href="./styles/responsive.css" />
	<link rel="stylesheet" href="./styles/bootstrap-select.css" />
	<link rel="stylesheet" href="./styles/perfect-scrollbar.css" />
	<link rel="stylesheet" href="./styles/custom.css" />



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

					<?php
					session_start();
					$phone_user = $_SESSION['user'];
					$sql = "SELECT * FROM `pharm_user` WHERE `email` = '$phone_user'";
					$res = $conn->query($sql);
					while ($row = mysqli_fetch_assoc($res)) {
						$name = $row['name'];
					}
					?>

				</div>
		</div>

		</nav>
		<!-- end sidebar -->
		<!-- right content -->
		<div id="content">
			<!-- topbar -->
			<div class="topbar">
				<nav class="navbar navbar-expand-lg navbar-light">
					<div class="full">
						<a href="../home.php" type="button" id="sidebarCollapse" class="sidebar_toggle">
							<i class="fa-solid fa-home text-white"></i>
						</a>
						<div class="right_topbar"></div>
					</div>
				</nav>
			</div>
			<!-- end topbar -->
			<!-- dashboard inner -->
			<div class="midde_cont">
				<div class="container-fluid">
					<div id="feedback">
						<?php
						@$msg = $_REQUEST['msg'];
						echo "<p>$msg</p>"
						?>
					</div>
					<!--<a href="./pharmaTest.php" class="btn btn-danger">TEST SERVER</a>-->
					<div class="pharmacy">
						<form method="post" id="insert_form" action="../backend/cart.php">
							<div class="table-responsive">
								<table class="table table-bordered" id="item_table">
									<tr class="mob_table">
										<th>Name</th>
										<th>Type</th>
										<th>Quantity</th>
										<th>Patient Id</th>
									</tr>
									<tbody>
										<tr>
											<td data-label="Name" id="select-div">
												<select name="name" class="form-control selectpicker" data-live-search="true" id="authors">
													<option selected="" disabled="">Select Medicine</option>
													<?php
													require 'data.php';
													$authors = loadAuthors();
													foreach ($authors as $author) {
														echo "<option id='" . $author['id'] . "' value='" . $author['id'] . "'>" . $author['name'] . "</option>";
													}
													?>
												</select>
											</td>
											<td data-label="Type" id="select-div">
												<!-- <select name="type" id="books" name="books" class="form-control" data-live-search="true">
													<option selected="" disabled="">Select Type</option>
													</select> -->
												<input type="text" name="book" id="books" readonly class="form-control">
												<input type="hidden" name="med_id" id="med_id" readonly class="form-control">

											</td>
											<td data-label="Quantity">
												<input type="number" name="quant" id="quant" min="0" required>
											</td>
											<td data-label="Patient Id">
												<input type="number" name="pat_id" id="pat_id" min="0">
												<input type="hidden" name="user_id" value="<?php echo $phone_user; ?>">
											</td>
										</tr>
									</tbody>
								</table>
								<div align="center">
									<input type="submit" name="submit" id="submit_button" class="btn btn-primary" value="Add To Cart" data-toggle="modalss" data-target="#exampleModalCenter" />
								</div>
							</div>
						</form>
						<div class="cart">
							<h3 class="center">Cart</h3>
							<div class="elements">
								<div class="middle-cart">
									<?php
									$sql = "SELECT * FROM `cart` WHERE `user_id` = '$phone_user' ORDER BY `rn` DESC";
									$rs = mysqli_query($con, $sql);
									if (mysqli_num_rows($rs)) {
										while ($row = mysqli_fetch_assoc($rs)) {
											$id = $row['id'];
									?>

											<div class="element">
												<div>
													<?php
													echo "<a href='../backend/remove_cart.php?rn=$id&user=$phone_user'><b>X</b></a>";

													echo  "<h4>" . $row['name'] . "<br>" . $row['sub_price'] . '$' . "</h4>";
													?>
												</div>
												<?php
												echo "<p> x" . $row['quant'] . "</p>";

												?>
											</div>

									<?php
										}
									}

									?>

								</div>
								<div class="bottom-cart">
									<ul>
										<div class="left-list">
											<li>Total</li>
										</div>
										<div class="right-list">

											<?php
											$sql = "SELECT SUM(sub_price) AS total FROM `cart` WHERE `user_id` = '$phone_user'";
											$rs = mysqli_query($conn, $sql);
											$val = mysqli_fetch_assoc($rs);
											$num = $val['total'];
											?>
											<li><?php
												echo $num;
												?>$</li>
										</div>
									</ul>
									<!-- <a href="#" data-modal-target="#modal">Confirm Order</a> -->
									<button class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">Confirm Order</button>
								</div>
							</div>
						</div>
					</div>

				</div>

			</div>
		</div>
	</div>
	</div>
	<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h3 class="modal-title" id="exampleModalLongTitle">ORDER SUMMERY</h3>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">X</span>
					</button>
				</div>
				<div class="modal-body">
					<table class="table">
						<tr>
							<th>Name</th>
							<th>Each Price</th>
							<th>Quantity</th>
							<th>Sub Total Price</th>
						</tr>
						<?php

						$sql = "SELECT * FROM `cart` WHERE `user_id` = '$phone_user'";
						$rs = mysqli_query($conn, $sql);
						while ($row = mysqli_fetch_assoc($rs)) {
						?>
							<tr>
								<td><?php
									echo $row['name'];
									?></td>
								<td><?php
									echo $row['price'] . "$";
									?></td>
								<td><?php
									echo $row['quant'];
									?></td>
								<td><?php
									echo $row['sub_price'] . "$";
									?></td>
							</tr>
						<?php
						}
						?>
					</table>
					<div class="total">
						<p>Total</p>
						<p><?php
							echo $num . "$";
							?></p>
					</div>
					<div class="payment">
						<form action="../backend/confirm.php" method="GET">
							<div>
								<label for="system">System</label>
								<input type="radio" name="payment" id="system" value="system">
							</div>
							<div>
								<label for="cash">Cash</label>
								<input type="radio" name="payment" id="cash" value="cash">
								<input type="hidden" name="tot_price" value="<?php echo $num; ?>">
								<input type="hidden" name="user_id" value="<?php echo $phone_user; ?>">
							</div>
							<div>
								<label for="credit">Credit</label>
								<select name="credit" id="credit">
									<option value="" disabled selected>None</option>
									<option value="cigna">Cigna</option>
									<option value="stc">Save The Children</option>
								</select>
							</div>
					</div>
				</div>
				<div class="modal-footer">

					<button type="button" class="btn btn-secondary" id="btnPrint" data-dismiss="modal">PRINT</button>
					<!-- <a class="btn" href="../../backend/confirm.php">DONE</a> -->
					<input type="submit" class="btn" value="Done" name="submit">
					</form>
					<!-- <button type="button" name="done" class="btn btn-secondary" data-dismiss="modal">DONE</button> -->
				</div>
			</div>
		</div>
	</div>
	<!-- jQuery -->
	<script src="./js/jquery.min.js"></script>
	<script src="./js/popper.min.js"></script>
	<script src="./js/bootstrap.min.js"></script>
	<!-- wow animation -->
	<script src="./js/animate.js"></script>
	<!-- select country -->
	<script src="./js/bootstrap-select.js"></script>
	<!-- nice scrollbar -->
	<script src="./js/perfect-scrollbar.min.js"></script>
	<script>
		var ps = new PerfectScrollbar("#sidebar");
	</script>
	<!-- custom js -->
	<script src="./js/custom.js"></script>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/js/bootstrap-select.min.js"></script>
</body>

</html>

<script>
	$(document).ready(function() {
		$("#authors").change(function() {
			var aid = $("#authors").val();
			$.ajax({
				url: 'data.php',
				method: 'post',
				data: 'aid=' + aid
			}).done(function(books) {
				console.log(aid);
				console.log(books);
				books = JSON.parse(books);
				$('#books').empty();
				books.forEach(function(book) {
					//$('#books').append('<option>Hello</option>')
					$('#books').val(book.type),
						$('#med_id').val(book.id)
				})
			})
		})
	})

	document.getElementById("btnPrint").onclick = function() {
		window.print();
	}
	const feedback = document.getElementById("feedback");
	setTimeout(() => {
		feedback.style.display = "none";
	}, 3000)
</script>
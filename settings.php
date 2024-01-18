<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<title>Pharmacy | Setting</title>
	<link rel="icon" href="favicon.ico">
	<link href="./style/style.css" rel="stylesheet">
</head>

<body x-data="{ page: 'settings', 'loaded': true, 'darkMode': true, 'stickyMenu': false, 'sidebarToggle': false, 'scrollTop': false }" x-init="
         darkMode = JSON.parse(localStorage.getItem('darkMode'));
         $watch('darkMode', value => localStorage.setItem('darkMode', JSON.stringify(value)))" :class="{'dark text-bodydark bg-boxdark-2': darkMode === true}">
	<div class="flex h-screen overflow-hidden">
		<?php
		$page = 'settings';
		 include './includes/sidebar.php'; ?>


		<div class="relative flex flex-1 flex-col overflow-y-auto overflow-x-hidden">
			<?php include './includes/header.php'; ?>
			<main>
				<div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10"></div>
			</main>
		</div>
	</div>
	<script defer src="bundle.js"></script>
</body>

</html>
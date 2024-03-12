<aside :class="sidebarToggle ? 'translate-x-0' : '-translate-x-full'" class="absolute left-0 top-0 z-9999 flex h-screen w-52.5 flex-col overflow-y-hidden bg-white duration-300 ease-linear dark:bg-boxdark lg:static lg:translate-x-0" @click.outside="sidebarToggle = false">
	<!-- SIDEBAR HEADER -->
	<div class="flex items-center justify-between gap-2 px-6 py-5.5 lg:py-6.5">
		<div class="w-full h-28">
			<img class="w-full h-full hidden dark:block" src="src/images/logo/logo.png" alt="logo" />
			<img class="w-full h-full dark:hidden" src="src/images/logo/logo-dark.png" alt="logo" />
		</div>

		<button class="block lg:hidden" @click.stop="sidebarToggle = !sidebarToggle">
			<svg class="fill-current" width="20" height="18" viewBox="0 0 20 18" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M19 8.175H2.98748L9.36248 1.6875C9.69998 1.35 9.69998 0.825 9.36248 0.4875C9.02498 0.15 8.49998 0.15 8.16248 0.4875L0.399976 8.3625C0.0624756 8.7 0.0624756 9.225 0.399976 9.5625L8.16248 17.4375C8.31248 17.5875 8.53748 17.7 8.76248 17.7C8.98748 17.7 9.17498 17.625 9.36248 17.475C9.69998 17.1375 9.69998 16.6125 9.36248 16.275L3.02498 9.8625H19C19.45 9.8625 19.825 9.4875 19.825 9.0375C19.825 8.55 19.45 8.175 19 8.175Z" fill="#ffffff" />
			</svg>
		</button>
	</div>
	<!-- SIDEBAR HEADER -->

	<div class="no-scrollbar flex flex-col overflow-y-auto duration-300 ease-linear">
		<nav class="mt-5 py-4 px-4 lg:mt-9 lg:px-6" ">
			<div>
				<h3 class=" mb-4 ml-4 text-sm font-medium dark:text-bodydark2 text-boxdark-2">
			MENU
			</h3>

			<ul class="mb-6 flex flex-col">
				<!-- <li class="mb-4 w-full">
						<a
							class="group relative flex items-center gap-2.5 rounded-sm py-2 px-4 font-medium text-boxdark dark:text-bodydark1 duration-300 ease-in-out hover:bg-graydark hover:text-white dark:hover:bg-meta-4"
							href="./home.php"
							@click="selected = (selected === 'Home' ? '':'Home')"
							:class="{ 'bg-primary dark:bg-primary text-white': (selected === 'Home') && (page === 'home') }"
							:class="page === 'home' && 'bg-graydark'"
						>
							<i class="fa-solid fa-warehouse"></i>

							Inventory
						</a>
					</li> -->
				<li class="<?php if ($page == 'report') {
								echo 'mb-4 w-full bg-primary dark:bg-primary text-white bg-graydark';
							} else {
								echo 'mb-4 w-full text-white hover:bg-graydark';
							} ?>">
					<a class="<?php if ($page == 'report') {
									echo 'group relative flex items-center gap-2.5 rounded-sm py-2 px-4 font-medium text-white dark:text-bodydark1 duration-300 ease-in-out hover:bg-graydark hover:text-white dark:hover:bg-meta-4';
								} else {
									echo 'group relative flex items-center gap-2.5 rounded-sm py-2 px-4 font-medium text-boxdark dark:text-bodydark1 duration-300 ease-in-out hover:bg-graydark hover:text-white dark:hover:bg-meta-4';
								} ?>" href="./report.php">
						<i class="fa-solid fa-house"></i>
						Home

					</a>
				</li>
				<li class="<?php if ($page == 'home') {
								echo 'mb-4 w-full bg-primary dark:bg-primary text-white bg-graydark';
							} else {
								echo 'mb-4 w-full text-white hover:bg-graydark';
							} ?>">
					<a class="<?php if ($page == 'home') {
									echo 'group relative flex items-center gap-2.5 rounded-sm py-2 px-4 font-medium text-white dark:text-bodydark1 duration-300 ease-in-out hover:bg-graydark hover:text-white dark:hover:bg-meta-4';
								} else {
									echo 'group relative flex items-center gap-2.5 rounded-sm py-2 px-4 font-medium text-boxdark dark:text-bodydark1 duration-300 ease-in-out hover:bg-graydark hover:text-white dark:hover:bg-meta-4';
								} ?>" href="./home.php">
						<i class="fa-solid fa-warehouse"></i>
						Inventory

					</a>
				</li>
				<li class="<?php if ($page == 'pharmacy') {
								echo 'mb-4 w-full bg-primary dark:bg-primary text-white bg-graydark';
							} else {
								echo 'mb-4 w-full text-white hover:bg-graydark';
							} ?>">
					<a class="<?php if ($page == 'pharmacy') {
									echo 'group relative flex items-center gap-2.5 rounded-sm py-2 px-4 font-medium text-white dark:text-bodydark1 duration-300 ease-in-out hover:bg-graydark hover:text-white dark:hover:bg-meta-4';
								} else {
									echo 'group relative flex items-center gap-2.5 rounded-sm py-2 px-4 font-medium text-boxdark dark:text-bodydark1 duration-300 ease-in-out hover:bg-graydark hover:text-white dark:hover:bg-meta-4';
								} ?>" href="./pharmacy.php">
						<i class="fa-solid fa-prescription-bottle-medical"></i>
						Pharmacy

					</a>
				</li>
				<!-- <li class="<?php if ($page == 'sell') {
									echo 'mb-4 w-full bg-primary dark:bg-primary text-white bg-graydark';
								} else {
									echo 'mb-4 w-full text-white hover:bg-graydark';
								} ?>">
					<a class="<?php if ($page == 'sell') {
									echo 'group relative flex items-center gap-2.5 rounded-sm py-2 px-4 font-medium text-white dark:text-bodydark1 duration-300 ease-in-out hover:bg-graydark hover:text-white dark:hover:bg-meta-4';
								} else {
									echo 'group relative flex items-center gap-2.5 rounded-sm py-2 px-4 font-medium text-boxdark dark:text-bodydark1 duration-300 ease-in-out hover:bg-graydark hover:text-white dark:hover:bg-meta-4';
								} ?>" href="./pharmacy/">
						<i class="fa-solid fa-prescription-bottle-medical"></i>
						Sell

					</a>
				</li> -->
				<li class="<?php if ($page == 'expired') {
								echo 'mb-4 w-full bg-primary dark:bg-primary text-white bg-graydark';
							} else {
								echo 'mb-4 w-full text-white hover:bg-graydark';
							} ?>">
					<a class="<?php if ($page == 'expired') {
									echo 'group relative flex items-center gap-2.5 rounded-sm py-2 px-4 font-medium text-white dark:text-bodydark1 duration-300 ease-in-out hover:bg-graydark hover:text-white dark:hover:bg-meta-4';
								} else {
									echo 'group relative flex items-center gap-2.5 rounded-sm py-2 px-4 font-medium text-boxdark dark:text-bodydark1 duration-300 ease-in-out hover:bg-graydark hover:text-white dark:hover:bg-meta-4';
								} ?>" href="./expired.php">
						<i class="fa-solid fa-calendar-xmark"></i>
						Expiring Soon

					</a>
				</li>

				<li class="<?php if ($page == 'sales') {
								echo 'mb-4 w-full bg-primary dark:bg-primary text-white bg-graydark';
							} else {
								echo 'mb-4 w-full text-white hover:bg-graydark';
							} ?>">
					<a class="<?php if ($page == 'sales') {
									echo 'group relative flex items-center gap-2.5 rounded-sm py-2 px-4 font-medium text-white dark:text-bodydark1 duration-300 ease-in-out hover:bg-graydark hover:text-white dark:hover:bg-meta-4';
								} else {
									echo 'group relative flex items-center gap-2.5 rounded-sm py-2 px-4 font-medium text-boxdark dark:text-bodydark1 duration-300 ease-in-out hover:bg-graydark hover:text-white dark:hover:bg-meta-4';
								} ?>" href="./sales.php">
						<i class="fa-solid fa-book"></i>
						Daily Sale

					</a>
				</li>
				<li class="<?php if ($page == 'suppliers') {
								echo 'mb-4 w-full bg-primary dark:bg-primary text-white bg-graydark';
							} else {
								echo 'mb-4 w-full text-white hover:bg-graydark';
							} ?>">
					<a class="<?php if ($page == 'suppliers') {
									echo 'group relative flex items-center gap-2.5 rounded-sm py-2 px-4 font-medium text-white dark:text-bodydark1 duration-300 ease-in-out hover:bg-graydark hover:text-white dark:hover:bg-meta-4';
								} else {
									echo 'group relative flex items-center gap-2.5 rounded-sm py-2 px-4 font-medium text-boxdark dark:text-bodydark1 duration-300 ease-in-out hover:bg-graydark hover:text-white dark:hover:bg-meta-4';
								} ?>" href="./suppliers.php">
						<i class="fa-solid fa-truck-field"></i>
						Suppliers

					</a>
				</li>
				<!-- <li class="<?php if ($page == 'unpaid') {
									echo 'mb-4 w-full bg-primary dark:bg-primary text-white bg-graydark';
								} else {
									echo 'mb-4 w-full text-white hover:bg-graydark';
								} ?>">
					<a class="<?php if ($page == 'unpaid') {
									echo 'group relative flex items-center gap-2.5 rounded-sm py-2 px-4 font-medium text-white dark:text-bodydark1 duration-300 ease-in-out hover:bg-graydark hover:text-white dark:hover:bg-meta-4';
								} else {
									echo 'group relative flex items-center gap-2.5 rounded-sm py-2 px-4 font-medium text-boxdark dark:text-bodydark1 duration-300 ease-in-out hover:bg-graydark hover:text-white dark:hover:bg-meta-4';
								} ?>" href="./unpaid.php">
						<i class="fa-solid fa-file-invoice"></i>
						Unpaid

					</a>
				</li> -->
				<li id="config-toggler" class="<?php if ($page == 'settings') {
													echo 'mb-4 w-full bg-primary dark:bg-primary text-white bg-graydark';
												} else {
													echo 'mb-4 w-full text-white hover:bg-graydark';
												} ?>">
					<a class="<?php if ($page == 'settings') {
									echo 'group relative flex items-center gap-2.5 rounded-sm py-2 px-4 font-medium text-white dark:text-bodydark1 duration-300 ease-in-out hover:bg-graydark hover:text-white dark:hover:bg-meta-4';
								} else {
									echo 'group relative flex items-center gap-2.5 rounded-sm py-2 px-4 font-medium text-boxdark dark:text-bodydark1 duration-300 ease-in-out hover:bg-graydark hover:text-white dark:hover:bg-meta-4';
								} ?>" href="#">
						<i class="fa-solid fa-gear"></i>
						Settings

					</a>
				</li>
				<ul class="<?php if ($page == 'settings') {
								echo 'flex ml-4 flex-col';
							} else {
								echo 'flex ml-4 flex-col hidden';
							} ?>" id="configs">
					<!-- <li class="mb-4 w-full text-white hover:bg-graydark">

						<a class="<?php if ($page == 'settings') {
										echo 'group relative flex items-center gap-2.5 rounded-sm py-2 px-4 font-medium text-white dark:text-bodydark1 duration-300 ease-in-out hover:bg-graydark hover:text-white dark:hover:bg-meta-4';
									} else {
										echo 'group relative flex items-center gap-2.5 rounded-sm py-2 px-4 font-medium text-boxdark dark:text-bodydark1 duration-300 ease-in-out hover:bg-graydark hover:text-white dark:hover:bg-meta-4';
									} ?>" href="./payments.php">
							<i class="fa-solid fa-gear"></i>
							Payments
						</a>
					</li> -->
					<li class="<?php if ($page == 'settings' && $curr == 'password') {
								echo 'mb-4 w-full bg-secondary dark:bg-secondary text-white bg-graydark';
							} else {
								echo 'mb-4 w-full text-white hover:bg-graydark';
							} ?>">
					<a class="<?php if ($page == 'settings' && $curr == 'password') {
									echo 'group relative flex items-center gap-2.5 rounded-sm py-2 px-4 font-medium text-white dark:text-bodydark1 duration-300 ease-in-out hover:bg-graydark hover:text-white dark:hover:bg-meta-4';
								} else {
									echo 'group relative flex items-center gap-2.5 rounded-sm py-2 px-4 font-medium text-boxdark dark:text-bodydark1 duration-300 ease-in-out hover:bg-graydark hover:text-white dark:hover:bg-meta-4';
								} ?>" href="./password.php">
						<i class="fa-solid fa-lock"></i>
						Password

					</a>
				</li>
					<li class="<?php if ($page == 'settings' && $curr == 'return') {
								echo 'mb-4 w-full bg-secondary dark:bg-secondary text-white bg-graydark';
							} else {
								echo 'mb-4 w-full text-white hover:bg-graydark';
							} ?>">
					<a class="<?php if ($page == 'settings' && $curr == 'return') {
									echo 'group relative flex items-center gap-2.5 rounded-sm py-2 px-4 font-medium text-white dark:text-bodydark1 duration-300 ease-in-out hover:bg-graydark hover:text-white dark:hover:bg-meta-4';
								} else {
									echo 'group relative flex items-center gap-2.5 rounded-sm py-2 px-4 font-medium text-boxdark dark:text-bodydark1 duration-300 ease-in-out hover:bg-graydark hover:text-white dark:hover:bg-meta-4';
								} ?>" href="./return.php">
						<i class="fa-solid fa-rotate-left"></i>
						Return Sale

					</a>
				</li>

				</ul>
				<li class="<?php if ($page == 'logout') {
								echo 'mb-4 w-full bg-primary dark:bg-primary text-white bg-graydark';
							} else {
								echo 'mb-4 w-full text-white hover:bg-graydark';
							} ?>">
					<a class="<?php if ($page == 'logout') {
									echo 'group relative flex items-center gap-2.5 rounded-sm py-2 px-4 font-medium text-white dark:text-bodydark1 duration-300 ease-in-out hover:bg-graydark hover:text-white dark:hover:bg-meta-4';
								} else {
									echo 'group relative flex items-center gap-2.5 rounded-sm py-2 px-4 font-medium text-boxdark dark:text-bodydark1 duration-300 ease-in-out hover:bg-graydark hover:text-white dark:hover:bg-meta-4';
								} ?>" href="./backend/logout.php">
						<i class="fa-solid fa-right-from-bracket"></i>
						Logout

					</a>
				</li>


			</ul>
	</div>
	</nav>
	</div>
</aside>

<script>
	const config_toggler = document.getElementById('config-toggler');
	const configs = document.getElementById('configs');

	config_toggler.addEventListener('click', () => {
		configs.classList.toggle('hidden');
	})
</script>
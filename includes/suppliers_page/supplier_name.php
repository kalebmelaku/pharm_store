
<table class="w-full border-collapse text-boxdark-2 dark:bg-danger dark:text-white">
							<thead class="bg-primary text-white">
								<tr>
									<th class=" border-gray-300 hidden border p-3 font-bold uppercase lg:table-cell">
										Name
									</th>
									<th class=" border-gray-300 hidden border p-3 font-bold uppercase lg:table-cell">
										Invoice Number
									</th>
									<th class=" border-gray-300 hidden border p-3 font-bold uppercase lg:table-cell">
										Payment
									</th>
									<th class=" border-gray-300 hidden border p-3 font-bold uppercase lg:table-cell">
										Total $
									</th>
				
									<th class=" border-gray-300 hidden border p-3 font-bold uppercase lg:table-cell">
										Date
									</th>

									<th class=" border-gray-300 hidden border p-3 font-bold uppercase lg:table-cell">
										Actions
									</th>
								</tr>
							</thead>
							<tbody class="dark:bg-black dark:text-white " id="tbody">
								<?php

								// retrieve selected results from database and display them on page
								
                                    $sql = $conn->query("SELECT * FROM `suppliers` WHERE `name` LIKE '%$supplier_name%' AND `completed` = 1");
									if ($sql->num_rows > 0) {
                                        while ($row = $sql->fetch_assoc()) {
                                            $id = $row['id'];
											$name = $row['name'];
											$invoice_no = $row['invoice_no'];
                                            $status = $row['status'];
											$total = $row['total_amount'];
											$date = $row['date'];
											$pageName = '';
                                            
											include './includes/unpaid_table.php';
										}
									} else {
										$search_result = 0;
								?>
										<h1 class="text-center text-2xl text-black dark:text-white">Item Not Found</h1>
										<h1 class="text-center text-2xl text-black dark:text-white">Please Check The Name Again</h1>
								<?php
									}
								
								?>
							</tbody>
						</table>
<?php
session_start();

if (!isset($_SESSION["userID"])) {
	require ("../includes/login_tools.php");
	load();
}

$page_name = "t_transaction";
$page_title = "Today Transaction - GEMINI";
require ("../connect_db.php");
include ("includes/header.html");
?>

<style type="text/css">
	

	/*td:nth-child(2n) {
		background-color: lightgray;
	}*/
</style>



<div class="icon-box">
	<a href="">
		<span>&uarr;</span>
	</a>	
</div>



<div class="parallax" style="background-color: lightgray;">
	<div class="container" style="padding-top: 10em;">
		<div class="row">
			<div class="col-l-2 col-m-12 col-s-12">
				<div class="sidenav" id="">
					<h1 class="heading black">Option</h1>
					<div class="card">						
						<a <?php echo ($page_name == "t_transaction") ? 'class="active"' : ""; ?> href="t_transaction.php">Today Transaction</a>
						<a <?php echo ($page_name == "transaction_h") ? 'class="active"' : ""; ?> href="transaction_h.php">Transaction History</a>					
					</div>
				</div>
			</div>


			<div class="col-l-10 col-m-12 col-s-12">
				<div class="content">
					<h1 class="heading black">Transaction History</h1>					
						
					<?php
					$getTransactionQuery = "SELECT
											    *
											FROM transaction
											LEFT JOIN user ON `transaction`.user_id = `user`.user_id
											LEFT JOIN product ON `transaction`.product_id = `product`.product_id
											LEFT JOIN address ON `transaction`.address_id = `address`.address_id
											WHERE `transaction`.transaction_time > CURDATE()-1											
											ORDER BY
											    `transaction`.transaction_id
											DESC
											";

					$getTransaction = mysqli_query($connection, $getTransactionQuery);

					if (mysqli_num_rows($getTransaction) > 0) {
						while ($row = mysqli_fetch_array($getTransaction)) {
							$t_id = $row["transaction_id"];
							$datetime = date_create($row["transaction_time"]);
							$p_id = $row["product_name"];
							$price = $row["product_price"];

							$plateNo = $row["plate_no"];
							$street1 = $row["street_1"];
							$street2 = $row["street_2"];
							$postcode = $row["postcode"];
							$city = $row["city"];
							$state = $row["state"];
							?>
							<div class="card">
								<table>
									<tr>
										<th>Transaction ID</th>
										<th>Transaction Date and Time</th>								
									</tr>
									<tr>
										<td><?php echo $t_id; ?></td>
										<td><?php echo date_format($datetime, "Y/M/d H:i:s"); ?></td>
									</tr>


									<tr>
										<th>Product ID</th>
										<th>Price</th>
									</tr>
									<tr>
										<td><?php echo $p_id; ?></td>
										<td><?php echo $price; ?></td>
									</tr>


									<tr>
										<th colspan="2">Shipping Address</th>
									</tr>
									<tr>
										<td colspan="2"><?php echo $plateNo.", ".$street1.", ".$street2.", ".$postcode.", ".$city.", ".$state; ?></td>
									</tr>
								</table>
							</div>
							<?php
						}
						?>

					<?php
					} else {
					?>
					<div class="card">
						<table>
							<tr>
								<td>No transaction.</td>
							</tr>
						</table>
					</div>
					<?php
					}
					?>
					
				</div>
			</div>	
		</div>
	</div>
</div>


<?php
include ("../includes/footer.html");
?>

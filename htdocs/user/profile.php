<?php
session_start();

if (!isset($_SESSION["userID"])) {
	require ("../includes/login_tools.php");
	load();
}

$page_name = "profile";
$page_title = "My Profile - GEMINI";
require ("../connect_db.php");
include ("includes/header.html");
?>

<div class="parallax" style="background-color: lightgray;">
	<div class="container" style="padding-top: 10em;">
		<div class="row">
			<div class="col-l-2 col-m-12 col-s-12">
				<div class="sidenav" id="">
					<h1 class="heading black">Setting</h1>
					
					<div class="card">
						<a <?php echo ($page_name == "profile") ? 'class="active"' : ""; ?> href="profile.php">My Profile</a>
						<a <?php echo ($page_name == "edit_address") ? 'class="active"' : ""; ?> href="edit_address.php">My Address</a>
						<a <?php echo ($page_name == "edit_profile") ? 'class="active"' : ""; ?> href="edit_profile.php">Edit Profile</a>
						<a <?php echo ($page_name == "transaction") ? 'class="active"' : ""; ?> href="transaction.php">Transaction History</a>
						<a <?php echo ($page_name == "delete_acc") ? 'class="active"' : ""; ?> href="delete_acc.php">Delete Account</a>
					</div>
				</div>
			</div>



			<div class="col-l-10">
				<div class="content">
					<h1 class="heading black">My Profile</h1>
				</div>

				<div class="content">
					<div class="card">						
						<table cellpadding="10" cellspacing="0">
							<tr>
								<td>User ID</td>
								<td><?php echo $_SESSION["userID"]; ?></td>
							</tr>

							<tr>
								<td>E-mail</td>
								<td><?php echo $_SESSION["Email"]; ?></td>
							</tr>

							<tr>
								<td>First Name (Given Name)</td>
								<td><?php echo $_SESSION["FirstName"]; ?></td>
							</tr>

							<tr>
								<td>Last Name (Surname)</td>
								<td><?php echo $_SESSION["LastName"]; ?></td>
							</tr>
						</table>
					</div>
				</div>







				<div class="content">
					<h1 class="heading black">My Address</h1>
				</div>
				<?php
				$getAddressQuery = "SELECT
									    *
									FROM
									    user
									LEFT JOIN user_address ON `user`.user_id = `user_address`.user_id
									LEFT JOIN address ON `user_address`.address_id = `address`.address_id
									WHERE
									    `user_address`.user_id = '".$_SESSION["userID"]."'
									";

				$getAddress = mysqli_query($connection, $getAddressQuery);

				if (mysqli_num_rows($getAddress) > 0) {					
				?>

				<div class="content">

					<?php					
					while ($row = mysqli_fetch_array($getAddress)) {
						$plateNo = $row["plate_no"];
						$street1 = $row["street_1"];
						$street2 = $row["street_2"];
						$postcode = $row["postcode"];
						$city = $row["city"];
						$state = $row["state"];
						$phoneNo = $row["phone_no"];
						?>

						<div class="card">
							<table cellpadding="10" cellspacing="0">
								<tr>
									<td>Contact Number: <?php echo $phoneNo; ?></td>	
								</tr>

								<tr>
									<td><?php echo $plateNo.", ".$street1.", ".$street2.", ".$postcode.", ".$city.", ".$state; ?></td>
								</tr>

							</table>							
						</div>

						<?php
					}
					?>
					
				</div>

				<?php
				} else {
				?>

				<div class="content">
					<div class="card">
						<table>
							<tr>
								<td>No address?</td>
								<td class="right"><a href="edit_address.php">Add Address</a></td>
							</tr>
						</table>
					</div>
				</div>

				<?php
				}
				?>
				
			</div>
		</div>
	</div>
</div>



<?php
include ("../includes/footer.html");
?>

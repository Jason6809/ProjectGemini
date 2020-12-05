<?php
session_start();

if (!isset($_SESSION["userID"])) {
	require ("../includes/login_tools.php");
	load();
}

$page_name = "edit_address";
$page_title = "My Address - GEMINI";
require ("../connect_db.php");
include ("includes/header.html");
?>

<?php
$operationDesc = array();
?>

<?php
if (isset($_GET["delete"])) {
	$id = $_GET["delete"];

	$query = "DELETE FROM address WHERE address_id = '$id'";

	if (mysqli_query($connection, $query)) {
		$operationDesc[] = "Delete Successful.";
	} else {
		$operationDesc[] = "Delete Error.".mysqli_error($connection);
	}
}
?>


<?php
if (isset($_POST["submit"])) {
	$plateNo = $_POST["plateNo"];
	$street1 = $_POST["street1"];
	$street2 = $_POST["street2"];
	$postcode = $_POST["postcode"];
	$city = $_POST["city"];
	$state = $_POST["state"];
	$phoneNo = $_POST["phoneNo"];

	$addAddressQuery = "INSERT INTO address(
						    plate_no,
						    street_1,
						    street_2,
						    postcode,
						    city,
						    state,
						    phone_no
						)
						VALUES(
						    '$plateNo',
						    '$street1',
						    '$street2',
						    '$postcode',
						    '$city',
						    '$state',
						    '$phoneNo'
						)
						";


	$addAddress = mysqli_query($connection, $addAddressQuery);

	if ($addAddress) {
		$last_id = mysqli_insert_id($connection);

		$joinUserAddressQuery = "INSERT INTO user_address VALUES('".$_SESSION["userID"]."', '$last_id')";
		$joinUserAddress = mysqli_query($connection, $joinUserAddressQuery);

		if ($joinUserAddress) {
			$operationDesc[] = "Add address successful.";
		} else {
			$operationDesc[] = "Add address failed.".mysqli_error($connection);
		}		
	} else {
		$operationDesc[] = "Add address error.".mysqli_error($connection);
	}
}
?>




<div class="notice_box" style="display: <?php if(!empty($operationDesc)){echo "block";}else{echo "none";} ?>">
	<?php
	if (!empty($operationDesc)) {
		?>

		<label style="color: white;">
			<?php
			// error_reporting(0);
			foreach ($operationDesc as $msg) {
				echo $msg."<br/>";
			}
			?>
		</label>

		<?php
	}
	?>
</div>





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




		
			<div class="col-l-10 col-m-12 col-s-12">
				<form action="" method="post" id="form" style="padding: 0;">
					
					<div class="content">
						<h1 class="heading black">Add Address</h1>					
					</div>

					<div class="card">				

						<div class="content" style="width: 100%;">

							<label style="color: red; align-self: flex-end;">*required field</label>					

							<label>Plate Number*</label>
							<input type="text" name="plateNo" placeholder="Plate No" required />

							<label>Street 1*</label>
							<input type="text" name="street1" placeholder="Jalan XXXXX" required />

							<label>Street 2*</label>
							<input type="text" name="street2" placeholder="Taman XXXXX" required />

							<label>Postcode*</label>
							<input type="number" name="postcode" placeholder="XXXXX" required />
							
							<label>City*</label>
							<input type="text" name="city" placeholder="City" required />

							<label>State*</label>
							<input type="text" name="state" placeholder="State" required />

							<label>Contact Number</label>
							<input type="text" name="phoneNo" placeholder="010-1112222">

							<div class="button_box">
								<input type="reset" value="Clear" onclick="location.href='edit_address.php'" />
								<!-- <input type="submit" name="update" value="Update" /> -->
								<input type="submit" name="submit" value="Add Address" />
							</div>

						</div>
					</div>
				</form>






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
						$addressID = $row["address_id"];
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
									<td rowspan="2">
										<form id="form" style="padding-top: 0;">
											<div class="button_box">
												<a href="edit_address.php?delete=<?php echo $addressID; ?>" style="margin-bottom: 0;">Delete</a>
											</div>
										</form>
									</td>										
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
								<td>No address</td>
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
</div>

<?php
include ("../includes/footer.html");
?>

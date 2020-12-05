<?php
session_start();

if (!isset($_SESSION["userID"])) {
	require ("../includes/login_tools.php");
	load();
}

$page_name = "delete_acc";
$page_title = "Delete Account - GEMINI";
require ("../connect_db.php");
include ("includes/header.html");
?>

<?php
$operationDesc = array();
?>

<?php
if (isset($_GET["delete"])) {
	$id = $_GET["delete"];

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

	while ($row = mysqli_fetch_array($getAddress)) {
		$addressID = $row["address_id"];

		$deleteAddressQuery = "DELETE FROM address WHERE address_id = '$addressID'";

		if (mysqli_query($connection, $deleteAddressQuery)) {
			$operationDesc[] = "Delete address successful.";
		} else {
			$operationDesc[] = "Delete address error.".mysqli_error($connection);
		}
	}

	$deleteUserQuery = "DELETE FROM user WHERE user_id = '$id'";

	if (mysqli_query($connection, $deleteUserQuery)) {
		$operationDesc[] = "Delete Successful.";
		header("Location: ../includes/logout.php");
	} else {
		$operationDesc[] = "Delete Error.".mysqli_error($connection);
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



<div class="parallax fill" style="background-color: lightgray;">
	<div class="container" style="padding-top: 0;">
		<div class="row">
			<div class="col-l-2 col-m-12 col-s-12">
				<div class="sidenav" id="">
					<h1 class="heading black">Setting</h1>
					<div class="card">
						<a <?php echo ($page_name == "profile") ? 'class="active"' : ""; ?> href="profile.php">My Profile</a>
						<a <?php echo ($page_name == "edit_address") ? 'class="active"' : ""; ?> href="edit_address.php">My Address</a>
						<a <?php echo ($page_name == "edit_profile") ? 'class="active"' : ""; ?> href="edit_profile.php">Edit Profile</a>
						<a <?php echo ($page_name == "transaction") ? 'class="active"' : ""; ?> href="transaction.php">Transaction History</a>
						<a <?php echo ($page_name == "delete_acc") ? 'class="active"' : ""; ?> href="">Delete Account</a>
					</div>
				</div>
			</div>

	
			<div class="col-l-10 col-m-12 col-s-12">
				<div class="content">
					<h1 class="heading black">Delete Account</h1>
					<div class="card">
						<table>
							<tr>
								<td>Confirm Delete Account? You can't undo this action.</td>
								<td>
									<form id="form" style="padding: 0;">
										<a class="right" href="delete_acc.php?delete=<?php echo $_SESSION["userID"]; ?>">Confirm Delete</a>
									</form>
								</td>							
							</tr>
						</table>
					</div>
				</div>
			</div>	
		</div>
	</div>
</div>

<?php
include ("../includes/footer.html");
?>
<?php
session_start();

if (!isset($_SESSION["userID"])) {
	require ("../includes/login_tools.php");
	load();
}

$page_name = "edit_profile";
$page_title = "Edit Profile - GEMINI";
require ("../connect_db.php");
include ("includes/header.html");
?>

<?php
$operationDesc = array();
?>

<?php

?>


<?php
if (isset($_POST["update"])) {
	$firstName = mysqli_real_escape_string($connection, trim($_POST["fname"]));
	$lastName  = mysqli_real_escape_string($connection, trim($_POST["lname"]));
	$email     = mysqli_real_escape_string($connection, trim($_POST["email"]));
	$password  = mysqli_real_escape_string($connection, trim($_POST["password"]));

	$updateProfileQuery = "UPDATE
							    user
							SET
							    email = '$email',
							    firstname = '$firstName',
							    lastname = '$lastName',
							    password = md5('$password')
							WHERE
								user_id = '".$_SESSION["userID"]."'
							";

	if (mysqli_query($connection, $updateProfileQuery)) {
		$_SESSION["Email"] = $email;
		$_SESSION["FirstName"] = $firstName;
		$_SESSION["LastName"] = $lastName;

		$operationDesc[] = "Update successful.";
	} else {
		$operationDesc[] = "Update Error.".mysqli_error($connection);
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
						<a <?php echo ($page_name == "edit_profile") ? 'class="active"' : ""; ?> href="">Edit Profile</a>
						<a <?php echo ($page_name == "transaction") ? 'class="active"' : ""; ?> href="transaction.php">Transaction History</a>
						<a <?php echo ($page_name == "delete_acc") ? 'class="active"' : ""; ?> href="delete_acc.php">Delete Account</a>
					</div>
				</div>
			</div>




		
			<div class="col-l-10 col-m-12 col-s-12">
				<form action="" method="post" id="form" style="padding: 0;">
					
					<div class="content">
						<h1 class="heading black">Edit Profile</h1>					
					</div>

					<div class="card">				

						<div class="content" style="width: 100%;">

							<!-- <label style="color: red; align-self: flex-end;">*required field</label>					 -->

							<label>First Name</label>
							<input type="text" name="fname" placeholder="Given Name" value="<?php echo $_SESSION["FirstName"]; ?>" />

							<label>Last Name</label>
							<input type="text" name="lname" placeholder="Surname" value="<?php echo $_SESSION["LastName"]; ?>" />

							<label>Email</label>
							<input type="email" name="email" placeholder="Email" value="<?php echo $_SESSION["Email"]; ?>" />

							<label>Password</label>
							<input type="password" name="password" placeholder="Password" value="" />

							<div class="button_box">
								<!-- <input type="submit" name="update" value="Update" /> -->
								<input type="submit" name="update" value="Update" />
							</div>

						</div>
					</div>
				</form>






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

			</div>
		</div>
	</div>
</div>

<?php
include ("../includes/footer.html");
?>


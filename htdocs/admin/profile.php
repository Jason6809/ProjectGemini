<?php
session_start();

if (!isset($_SESSION["userID"])) {
	require ("../includes/login_tools.php");
	load();
}

$page_name = "profile";
$page_title = "Edit Profile - ADMIN";
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
	
	$password  = mysqli_real_escape_string($connection, trim($_POST["password"]));

	$updateProfileQuery = "UPDATE
							    user
							SET
							    password = md5('$password')
							WHERE
								user_id = '".$_SESSION["userID"]."'
							";

	if (mysqli_query($connection, $updateProfileQuery)) {		
		$operationDesc[] = "Update successful.";
	} else {
		$operationDesc[] = "Update Error.".mysqli_error($connection);
	}
}
?>







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
					<h1 class="heading black">Setting</h1>
					<div class="card">						
						<a <?php echo ($page_name == "profile") ? 'class="active"' : ""; ?> href="profile.php">Change Password</a>						
					</div>
				</div>
			</div>




		
			<div class="col-l-10 col-m-12 col-s-12">
				<form action="" method="post" id="form" style="padding: 0;">
					
					<div class="content">
						<h1 class="heading black">Change Password</h1>					
					</div>
					
					<div class="card">
						<div class="content">
							<label>Operation Description</label>
							<?php
							if (!empty($operationDesc)) {
								?>

								<label>
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
					</div>

					<div class="card">				

						<div class="content" style="width: 100%;">

							<!-- <label style="color: red; align-self: flex-end;">*required field</label>				 -->

							

							<label>Password</label>
							<input type="password" name="password" minlength="8" placeholder="Password" value="" />

							<div class="button_box">
								<!-- <input type="submit" name="update" value="Update" /> -->
								<input type="submit" name="update" value="Update" />
							</div>

						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<?php
include ("../includes/footer.html");
?>
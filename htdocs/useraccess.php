<?php
$page_name = "useraccess";
$page_title = "Sign Up and Login - GEMINI";
require ('connect_db.php');
include ('includes/header.php');
?>

<?php
$operationDescSignUp = array();

if (isset($_POST["signup"])) {
	$firstName = mysqli_real_escape_string($connection, trim($_POST["fname"]));
	$lastName  = mysqli_real_escape_string($connection, trim($_POST["lname"]));
	$email     = mysqli_real_escape_string($connection, trim($_POST["email"]));
	$password  = mysqli_real_escape_string($connection, trim($_POST["password"]));

	//check duplicated account
	$checkEmailQuery = "SELECT email FROM user WHERE email='$email'";
	$result = mysqli_query($connection, $checkEmailQuery);
	if (mysqli_num_rows($result) != 0) {

		$operationDescSignUp[] = "Email address already registered.";

	} else {

		$signupQuery = "INSERT INTO user(email, firstname, lastname, password, access_level) VALUES('$email', '$firstName', '$lastName', md5('$password'), 3)";
		if (mysqli_query($connection, $signupQuery)) {

			$operationDescSignUp[] = "Sign Up Successful. Please proceed to login.";

		} else {

			$operationDescSignUp[] = "Sign Up Failed. Please try again later. ".mysqli_error($connection);

		}

	}

}
?>




<?php
$operationDescLogin = array();
require ("includes/login_tools.php");

if (isset($_POST["login"])) {
	$email = mysqli_real_escape_string($connection, trim("admin@admin.com"));
	list($check, $data) = validate($connection, $_POST["email"] , $_POST["password"]);

	if ($check) {
		if ($data["access_level"] == 1) {

			session_start();

			$_SESSION["userID"] = $data["user_id"];
			$_SESSION["FirstName"] = $data["firstname"];

			load("admin/index.php");

		} elseif ($data["access_level"] == 2) {

			session_start();

			$_SESSION["userID"] = $data["stylist_id"];
			$_SESSION["FirstName"] = $data["firstname"];

			load("stylist/index.php");	

		} else {

			session_start();

			$_SESSION["userID"] = $data["user_id"];
			$_SESSION["Email"] = $data["email"];
			$_SESSION["FirstName"] = $data["firstname"];
			$_SESSION["LastName"] = $data["lastname"];

			load("user/index.php");

		}
	} else {
		$operationDescLogin = $data;
	}
}
?>








<div class="parallax" style="background-image: url('includes/img/parallax.jpg');" id="userForm">
	<div class="container">

		<div class="row">
			<div class="col-l-6 col-m-12 col-s-12">

				<form action="" method="post" id="form">
					<div class="content">

						<h1 class="heading">Login</h1>

						<div class="card">
							<div class="content">
								<?php
								if (!empty($operationDescLogin)) {
									?>

									<label style="color: white; align-self: flex-end;">
										<?php
										// error_reporting(0);
										foreach ($operationDescLogin as $msg) {
											echo $msg."<br/>";
										}
										?>
									</label>

									<?php
								}
								?>

								<label style="color: red; align-self: flex-end;">*Required field.</label>

								<label>Email*</label>
								<input type="email" name="email" placeholder="Email" value="" required />

								<label>Password*</label>
								<input type="password" name="password" minlength="8" placeholder="Password" value="" required />

								<div class="button_box">
									<input type="submit" name="login" value="Login" />
								</div>

							</div>
						</div>
					</div>
				</form>
			</div>


			<div class="col-l-6 col-m-12 col-s-12">

				<form action="" method="post" id="form">
					<div class="content">

						<h1 class="heading">Sign Up</h1>


						<div class="card">
							<div class="content">

								<?php
								if (!empty($operationDescSignUp)) {
									?>

									<label style="color: white; align-self: flex-end;">
										<?php
										// error_reporting(0);
										foreach ($operationDescSignUp as $msg) {
											echo $msg."<br/>";
										}
										?>
									</label>

									<?php
								}
								?>

								<label style="color: red; align-self: flex-end;">*Required field.</label>

								<label>First Name*</label>
								<input type="text" name="fname" placeholder="Given Name" required />

								<label>Last Name*</label>
								<input type="text" name="lname" placeholder="Surname" required />

								<label>Email*</label>
								<input type="email" name="email" placeholder="Email" value="" required />

								<label>Password*</label>
								<input type="password" name="password" minlength="8" placeholder="Password" value="" required />

								<div class="button_box">
									<input type="submit" name="signup" value="Sign Up" />
								</div>

							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<?php
include ("includes/footer.php");
?>

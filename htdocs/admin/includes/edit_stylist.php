<?php
$operationDesc = array();
?>


<?php
//DELETE
if (isset($_GET["delete"])) {
	$id = $_GET["delete"];

	$target_dir  = "img/uploads/stylist/";
	$get_image_query = "SELECT stylist_img FROM stylist WHERE stylist_id = '$id'";
	$get_image = mysqli_query($connection, $get_image_query);

	while ($row = mysqli_fetch_array($get_image)) {
		$target_file = $target_dir.$row["stylist_img"];
	}

	$query = "DELETE FROM stylist WHERE stylist_id = '$id'";
	// $query2 = "DELETE FROM stylist_detail WHERE stylist_id = '$id'";
	$result = mysqli_query($connection, $query);
	// $result2 = mysqli_query($connection, $query2);

	if ($result && unlink($target_file)) {

		$operationDesc[] = "Delete Successful. Please clear the form.";

	} else {

		$operationDesc[] = "Delete Error.";

	}
}
?>














<?php
//CHECK SUBMIT
if (isset($_POST["submit"])) {
	$target_dir  = "img/uploads/stylist/";
	$target_file = $target_dir.basename($_FILES["fileToUpload"]["name"]);

	$ic 		= $_POST["ic"];
	$name       = $_POST["name"];
	$school     = $_POST["school"];
	$intro 		= $_POST["intro"];
	$branch 	= $_POST["branch"];
	$exp		= $_POST["exp"];
	$fees 		= $_POST["fees"];

	$phoneNo 	= $_POST["phoneNo"];
	$startDate  = $_POST["startDate"];
	$salary 	= $_POST["salary"];

	$email     = mysqli_real_escape_string($connection, trim($_POST["email"]));
	$password  = mysqli_real_escape_string($connection, trim($_POST["password"]));

	if (isset($_FILES["fileToUpload"]) && $_FILES["fileToUpload"]["error"] == 0) {
		$allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
		$filename = $_FILES["fileToUpload"]["name"];
		$tmpfile  = $_FILES["fileToUpload"]["tmp_name"];
		$filetype = $_FILES["fileToUpload"]["type"];
		$filesize = $_FILES["fileToUpload"]["size"];


		//VERIFY IMAGE
		$imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
		if (!array_key_exists($imageFileType, $allowed)) die($operationDesc[] = "Error: Please a valid file format.");


		//VERITY FILESIZE
		$maxSize = 10 * 1024 * 1024;
		if ($filesize > $maxSize) die($operationDesc[] = "Error: File size is too larger. Maximum is 10MB");


		//VERITY FILETYPE
		if (in_array($filetype, $allowed)) {
			//VERITY SAME FILE
			if (file_exists($target_file)) {

				$operationDesc[] = "Error: ".$filename." is already exists.";

				?>

				<!-- <script type="text/javascript">
					alert("<?php //echo $filename.' is already exists.'; ?>");
				</script> -->

				<?php
			} else {
				$query = "INSERT INTO stylist(
							    stylist_ic,
							    stylist_name,
							    stylist_school,
							    stylist_intro,
							    stylist_branch,
							    stylist_exp,
							    stylist_fees,
							    stylist_img
							)
							VALUES(
							    '$ic',
							    '$name',
							    '$school',
							    '$intro',
							    '$branch',
							    '$exp',
							    '$fees',
							    '".$filename."'
							)
							";

				if (mysqli_query($connection, $query)) {
					$last_id = mysqli_insert_id($connection);

					$query2 = "INSERT INTO stylist_detail(
								    salary,
								    start_date,
								    phone_no,
								    stylist_id,
								    stylist_pass
								)
								VALUES(
								    '$salary',
								    '$startDate',
								    '$phoneNo',
								    '$last_id',
								    '$password'
								)
							    ";

					if(mysqli_query($connection, $query2)){
						$query3 = "INSERT INTO user(
								    stylist_id,
								    email,
								    firstname,
								    lastname,
								    password,
								    access_level
								)
								VALUES(
								    '$last_id',
								    '$email',
								    '$name',
								    '$name',
								    md5('$password'),
								    2
								)
								";
						if (mysqli_query($connection, $query3)) {

							move_uploaded_file($tmpfile, $target_file);
							$operationDesc[] = "Submit Successful.";

						} else {

							$operationDesc[] = "Submit Error.";

						}
						
					} else {

						$operationDesc[] = "Submit Error.";

					}
					

				} else {

					$operationDesc[] = "Submit Error.";

				}
				?>

				<!-- <script type="text/javascript">
					<?php //echo 'alert("<?php echo "Successful"; ?>");'; ?>
				</script> -->

				<?php
			}
		} else {

			$operationDesc[] = "Error: Error to upload file.";

			?>

			<!-- <script type="text/javascript">
				<?php //echo 'alert("<?php echo "Error to upload file."; ?>");'; ?>
			</script> -->

			<?php
		}
	} else {

		$operationDesc[] = "Error: No image selected.";

		?>

		<!-- <script type="text/javascript">
			alert("<?php //echo 'Error Code = '.$_FILES["fileToUpload"]["error"].'\n'.'No file selected.'; ?>");
		</script> -->

		<?php
	}
}
?>
















<?php
//CHECK EDIT
$edit_id 	 = "";
$edit_ic 	 = "";
$edit_name 	 = "";
$edit_school = "";
$edit_exp 	 = "";
$edit_intro  = "";
$edit_branch = "";
$edit_fees 	 = "";
$edit_img 	 = "";

$edit_phoneNo = "";
$edit_startDate = "";
$edit_salary = "";

$edit_email = "";
$edit_password = "";


if (isset($_GET["edit"])) {

	$id=$_GET["edit"];

	$edit_query = "SELECT
					    *
					FROM
					    stylist
					LEFT JOIN branch ON `stylist`.stylist_branch = `branch`.branch_id
					LEFT JOIN stylist_detail ON `stylist`.stylist_id = `stylist_detail`.stylist_id
					LEFT JOIN user ON `stylist`.stylist_id = `user`.stylist_id
					WHERE `stylist`.stylist_id = '$id'
					";

	$edit_result = mysqli_query($connection, $edit_query);

	while ($row = mysqli_fetch_array($edit_result)) {

		$edit_id 	 = $row["stylist_id"];
		$edit_ic 	 = $row["stylist_ic"];
		$edit_name 	 = $row["stylist_name"];
		$edit_school = $row["stylist_school"];
		$edit_exp 	 = $row["stylist_exp"];
		$edit_intro  = $row["stylist_intro"];
		$edit_branch = $row["stylist_branch"];
		$edit_fees 	 = $row["stylist_fees"];
		$edit_img 	 = $row["stylist_img"];

		$edit_phoneNo   = $row["phone_no"];
		$edit_startDate = $row["start_date"];
		$edit_salary    = $row["salary"];

		$edit_email = $row["email"];
		$edit_password = $row["stylist_pass"];
	}
}
?>


















<?php
//CHECK UPDATE
if (isset($_POST["update"])) {
	$target_dir  = "img/uploads/stylist/";
	$target_file = $target_dir.basename($_FILES["fileToUpload"]["name"]);

	$id 		= $_GET["edit"];
	$ic 		= $_POST["ic"];
	$name       = $_POST["name"];
	$school     = $_POST["school"];
	$intro 		= $_POST["intro"];
	$branch 	= $_POST["branch"];
	$exp		= $_POST["exp"];
	$fees 		= $_POST["fees"];

	$phoneNo 	= $_POST["phoneNo"];
	$startDate  = $_POST["startDate"];
	$salary 	= $_POST["salary"];

	$email     = mysqli_real_escape_string($connection, trim($_POST["email"]));
	$password  = mysqli_real_escape_string($connection, trim($_POST["password"]));

	if (isset($_FILES["fileToUpload"]) && $_FILES["fileToUpload"]["error"] == 0) {
		$allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
		$filename = $_FILES["fileToUpload"]["name"];
		$tmpfile  = $_FILES["fileToUpload"]["tmp_name"];
		$filetype = $_FILES["fileToUpload"]["type"];
		$filesize = $_FILES["fileToUpload"]["size"];


		//VERIFY IMAGE
		$imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
		if (!array_key_exists($imageFileType, $allowed)) die($operationDesc[] = "Error: Please a valid file format.");


		//VERITY FILESIZE
		$maxSize = 10 * 1024 * 1024;
		if ($filesize > $maxSize) die($operationDesc[] = "Error: File size is too larger. Maximum is 10MB");


		//VERITY FILETYPE
		if (in_array($filetype, $allowed)) {
			//VERITY SAME FILE
			if (file_exists($target_file)) {

				$operationDesc[] = "Error: ".$filename." this image is already exists";

				?>

				<!-- <script type="text/javascript">
					alert("<?php //echo $filename.' is already exists.'; ?>");
				</script> -->

				<?php
			} else {
				// $query = "INSERT INTO stylist(stylist_ic, stylist_name, stylist_school, stylist_intro, stylist_branch, stylist_exp, stylist_fees, stylist_detail, stylist_img) VALUES('$ic', '$name', '$school', '$intro', '$branch', '$exp', '$fees', '$detail', '".$filename."')";

				$update_query = "UPDATE
								    stylist
								SET
								    stylist_ic = '$ic',
								    stylist_name = '$name',
								    stylist_school = '$school',
								    stylist_intro = '$intro',
								    stylist_branch = '$branch',
								    stylist_exp = '$exp',
								    stylist_fees = '$fees',
								    stylist_img = '$filename'
								WHERE
								    stylist_id = $id
							    ";

				$update_query2 = "UPDATE
									    stylist_detail
									SET
									    salary = '$salary',
									    start_date = '$startDate',
									    phone_no = '$phoneNo',
									    stylist_pass = '$password'
									WHERE
									    stylist_id = $id
								 ";

				$update_query3 = "UPDATE
									    user
									SET
									    email = '$email',
									    password = md5('$password')						    
									WHERE
									    stylist_id = $id
								 ";

				$result = mysqli_query($connection, $update_query);
				$result2 = mysqli_query($connection, $update_query2);
				$result3 = mysqli_query($connection, $update_query3);

				if ($result && $result2 && $result3) {

					$operationDesc[] = "Update Successful. Please clear the form.";
					unlink($target_dir.$edit_img);
					move_uploaded_file($tmpfile, $target_file);

				} else {

					$operationDesc[] = "Update Error.";

				}
				?>

				<!-- <script type="text/javascript">
					alert("Update Successful");
				</script> -->

				<?php
			}
		} else {

			$operationDesc[] = "Error: Error to upload file.";

			?>

			<!-- <script type="text/javascript">
				alert("Error to upload file.");
			</script> -->

			<?php
		}
	} else {
		?>

		<?php
			$update_query = "UPDATE
							    stylist
							SET
							    stylist_ic = '$ic',
							    stylist_name = '$name',
							    stylist_school = '$school',
							    stylist_intro = '$intro',
							    stylist_branch = '$branch',
							    stylist_exp = '$exp',
							    stylist_fees = '$fees'
							WHERE
							    stylist_id = $id
						    ";

			$update_query2 = "UPDATE
								    stylist_detail
								SET
								    salary = '$salary',
								    start_date = '$startDate',
								    phone_no = '$phoneNo',
								    stylist_pass = '$password'
								WHERE
								    stylist_id = $id
							 ";

			$update_query3 = "UPDATE
								    user
								SET
								    email = '$email',
								    password = md5('$password')						    
								WHERE
								    stylist_id = $id
							 ";

			$result = mysqli_query($connection, $update_query);
			$result2 = mysqli_query($connection, $update_query2);
			$result3 = mysqli_query($connection, $update_query3);

			if ($result && $result2 && $result3) {

				$operationDesc[] = "Update Successful. Please clear the form.";

			} else {

				$operationDesc[] = "Update Error.";

			}
		?>

		<!-- <script type="text/javascript">
			alert("Successful");
		</script> -->

		<?php
	}
}
?>

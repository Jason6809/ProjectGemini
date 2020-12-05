<?php
$operationDesc = array();
?>


<?php
//DELETE
if (isset($_GET["delete"])) {
	$id = $_GET["delete"];

	$target_dir  = "img/uploads/location/";
	$get_image_query = "SELECT branch_img FROM branch WHERE branch_id = '$id'";
	$get_image = mysqli_query($connection, $get_image_query);

	while ($row = mysqli_fetch_array($get_image)) {
		$target_file = $target_dir.$row["branch_img"];
	}

	$query = "DELETE FROM branch WHERE branch_id = '$id'";


	if (mysqli_query($connection, $query) && unlink($target_file)) {

		$operationDesc[] = "Delete Successful. Please clear the form.";

	} else {

		$operationDesc[][] = "Delete Error.";

	}
}
?>
















<?php
//CHECK SUBMIT
if (isset($_POST["submit"])) {
	$target_dir  = "img/uploads/location/";
	$target_file = $target_dir.basename($_FILES["fileToUpload"]["name"]);

	$name    = $_POST["name"];
	$address = $_POST["address"];
	$phoneNo = $_POST["phoneNo"];

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
				$query = "INSERT INTO branch(
							    branch_name,
							    branch_phoneNo,
							    branch_address,
							    branch_img
							)
							VALUES(
							    '$name',
							    '$phoneNo',
							    '$address',
							    '".$filename."'
							)
						 ";

				if(mysqli_query($connection, $query)) {

					move_uploaded_file($tmpfile, $target_file);
					$operationDesc[] = "Submit Successful.";

				} else {

					$operationDesc[] = "Submit Error.";

				}
				?>

				<!-- <script type="text/javascript">
					<?php //echo 'alert("<?php echo "Successful!"; ?>");'; ?>
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
$edit_id 	  = "";
$edit_name    = "";
$edit_address = "";
$edit_phoneNo = "";
$edit_img 	  = "";

if (isset($_GET["edit"])) {

	$id=$_GET["edit"];
	$edit_query = "SELECT * FROM branch WHERE branch_id = $id";

	$edit_result = mysqli_query($connection, $edit_query);

	while ($row = mysqli_fetch_array($edit_result)) {

		$edit_id 	  = $row["branch_id"];
		$edit_name    = $row["branch_name"];
		$edit_address = $row["branch_address"];
		$edit_phoneNo = $row["branch_phoneNo"];
		$edit_img	  = $row["branch_img"];

	}
}
?>














<?php
//CHECK UPDATE
if (isset($_POST["update"])) {
	$target_dir  = "img/uploads/location/";
	$target_file = $target_dir.basename($_FILES["fileToUpload"]["name"]);

	$id 	 = $_GET["edit"];
	$name    = $_POST["name"];
	$address = $_POST["address"];
	$phoneNo = $_POST["phoneNo"];


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
								    branch
								SET
								    branch_name = '$name',
								    branch_address = '$address',
								    branch_phoneNo = '$phoneNo',
								    branch_img = '$filename'
								WHERE
								    branch_id = $id
								";

				if(mysqli_query($connection, $update_query)) {

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
							    branch
							SET
							    branch_name = '$name',
							    branch_address = '$address',
							    branch_phoneNo = '$phoneNo'
							WHERE
								branch_id = $id
							";

			if(mysqli_query($connection, $update_query)) {

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

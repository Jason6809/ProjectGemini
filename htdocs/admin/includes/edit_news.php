<?php
$operationDesc = array();
?>


<?php
//DELETE
if (isset($_GET["delete"])) {
	$id = $_GET["delete"];

	$target_dir  = "img/uploads/news/";
	$get_image_query = "SELECT img_name FROM news WHERE news_id = '$id'";
	$get_image = mysqli_query($connection, $get_image_query);

	while ($row = mysqli_fetch_array($get_image)) {
		$target_file = $target_dir.$row["img_name"];
	}

	$query = "DELETE FROM news WHERE news_id = '$id'";


	if (mysqli_query($connection, $query) && unlink($target_file)) {

		$operationDesc[] = "Delete Successful. Please clear the form.";

	} else {

		$operationDesc[] = "Delete Error.";

	}
}
?>












<?php
//CHECK SUBMIT
if (isset($_POST["submit"])) {
	$target_dir  = "img/uploads/news/";
	$target_file = $target_dir.basename($_FILES["fileToUpload"]["name"]);

	$title       = $_POST["title"];
	$content     = $_POST["content"];
	$date		 = $_POST["date"];

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
				$query = "INSERT INTO news(
							    news_title,
							    news_date,
							    news_content,
							    img_name
							)
							VALUES(
							    '$title',
							    '$date',
							    '$content',
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
$edit_title   = "";
$edit_content = "";
$edit_date	  = "";
$edit_img 	  = "";

if (isset($_GET["edit"])) {

	$id=$_GET["edit"];
	$edit_query = "SELECT * FROM news WHERE news_id = $id";

	$edit_result = mysqli_query($connection, $edit_query);

	while ($row = mysqli_fetch_array($edit_result)) {

		$edit_id 	  = $row["news_id"];
		$edit_title   = $row["news_title"];
		$edit_content = $row["news_content"];
		$edit_date	  = $row["news_date"];
		$edit_img	  = $row["img_name"];

	}
}
?>














<?php
//CHECK UPDATE
if (isset($_POST["update"])) {
	$target_dir  = "img/uploads/news/";
	$target_file = $target_dir.basename($_FILES["fileToUpload"]["name"]);

	$id 		 = $_GET["edit"];
	$title       = $_POST["title"];
	$content     = $_POST["content"];
	$date		 = $_POST["date"];


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
								    news
								SET
								    news_title = '$title',
								    news_date = '$date',
								    news_content = '$content',
								    img_name = '$filename'
								WHERE
								    news_id = $id
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
							    news
							SET
							    news_title = '$title',
							    news_date = '$date',
							    news_content = '$content'
							WHERE
							    news_id = $id
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

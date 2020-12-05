<?php
$operationDesc = array();
?>


<?php
//DELETE
if (isset($_GET["delete"])) {
	$id = $_GET["delete"];

	$target_dir  = "img/uploads/gallery/";
	$get_image_query = "SELECT img_name FROM gallery WHERE gallery_id = '$id'";
	$get_image = mysqli_query($connection, $get_image_query);

	while ($row = mysqli_fetch_array($get_image)) {
		$target_file = $target_dir.$row["img_name"];
	}

	$query = "DELETE FROM gallery WHERE gallery_id = '$id'";


	if (mysqli_query($connection, $query) && unlink($target_file)) {

		$operationDesc[] = "Delete Successful. Please clear the form.";

	} else {

		$operationDesc[] = "Delete Error. Please clear the form";

	}
}
?>






<?php
//CHECK SUBMIT
if (isset($_POST["submit"])) {
	$target_dir  = "img/uploads/gallery/";
	$target_file = $target_dir.basename($_FILES["fileToUpload"]["name"]);

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
				$query = "INSERT INTO gallery(img_name) VALUES('".$filename."')";

				if(mysqli_query($connection, $query)){

					move_uploaded_file($tmpfile, $target_file);

					$operationDesc[] = "Submit Successful.";

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

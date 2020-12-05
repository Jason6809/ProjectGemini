<?php
$operationDesc = array();
?>


<?php
//DELETE
if (isset($_GET["delete"])) {
	$id = $_GET["delete"];

	$target_dir  = "img/uploads/product/";
	$get_image_query = "SELECT product_img FROM product WHERE product_id = '$id'";
	$get_image = mysqli_query($connection, $get_image_query);

	while ($row = mysqli_fetch_array($get_image)) {
		$target_file = $target_dir.$row["product_img"];
	}

	$query = "DELETE FROM product WHERE product_id = '$id'";
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
	$target_dir  = "img/uploads/product/";
	$target_file = $target_dir.basename($_FILES["fileToUpload"]["name"]);

	$name 	   = $_POST["name"];
	$brand     = $_POST["brand"];
	$type 	   = $_POST["type"];
	$desc	   = $_POST["desc"];
	$price     = $_POST["price"];
	$quantity  = $_POST["quantity"];

	$purchaseDate  = $_POST["purchaseDate"];
	$cost 		   = $_POST["cost"];

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
				$query = "INSERT INTO product(
							    product_name,
							    product_brand,
							    product_type,
							    product_desc,
							    product_price,
							    product_quantity,
							    product_img
							)
							VALUES(
							    '$name',
							    '$brand',
							    '$type',
							    '$desc',
							    '$price',
							    '$quantity',
							    '".$filename."'
							)
							";

				if (mysqli_query($connection, $query)) {
					$last_id = mysqli_insert_id($connection);

					$query2 = "INSERT INTO product_detail(
								    purchase_date,
								    cost,
								    product_id
								)
								VALUES(
								    '$purchaseDate',
								    '$cost',								    
								    '$last_id'
								)
							    ";

					mysqli_query($connection, $query2);
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
















<?php
//CHECK EDIT
$edit_id 	   = "";
$edit_name 	   = "";
$edit_brand    = "";
$edit_type 	   = "";
$edit_desc	   = "";
$edit_price    = "";
$edit_quantity = "";
$edit_img 	   = "";

$edit_purchaseDate = "";
$edit_cost 		   = "";

if (isset($_GET["edit"])) {

	$id=$_GET["edit"];
	$edit_query = "SELECT
					    *
					FROM
					    product
					LEFT JOIN product_brand ON `product`.product_brand = `product_brand`.product_brand_id
					LEFT JOIN product_type ON `product`.product_type = `product_type`.product_type_id
					LEFT JOIN product_detail ON `product`.product_id = `product_detail`.product_id
					WHERE
						`product`.product_id = $id
					";

	$edit_result = mysqli_query($connection, $edit_query);

	while ($row = mysqli_fetch_array($edit_result)) {

		$edit_id 	   = $row["product_id"];
		$edit_name 	   = $row["product_name"];
		$edit_brand    = $row["product_brand"];
		$edit_type 	   = $row["product_type"];
		$edit_desc	   = $row["product_desc"];
		$edit_price    = $row["product_price"];
		$edit_quantity = $row["product_quantity"];
		$edit_img 	   = $row["product_img"];

		$edit_purchaseDate = $row["purchase_date"];
		$edit_cost 		   = $row["cost"];
	}
}
?>


















<?php
//CHECK UPDATE
if (isset($_POST["update"])) {
	$target_dir  = "img/uploads/product/";
	$target_file = $target_dir.basename($_FILES["fileToUpload"]["name"]);

	$id 	   = $_GET["edit"];
	$name 	   = $_POST["name"];
	$brand     = $_POST["brand"];
	$type 	   = $_POST["type"];
	$desc	   = $_POST["desc"];
	$price     = $_POST["price"];
	$quantity  = $_POST["quantity"];

	$purchaseDate  = $_POST["purchaseDate"];
	$cost 		   = $_POST["cost"];

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
								    product
								SET
								    product_name = '$name',
								    product_brand = '$brand',
								    product_type = '$type',
								    product_desc = '$desc',
								    product_price = '$price',
								    product_quantity = '$quantity',
								    product_img = '$filename'
								WHERE
								    product_id = $id
							    ";

				$update_query2 = "UPDATE
								    product_detail
								SET
								    purchase_date = '$purchaseDate',
								    cost = '$cost'
								WHERE
								    product_id = $id
								 ";

				$result = mysqli_query($connection, $update_query);
				$result2 = mysqli_query($connection, $update_query2);

				if ($result && $result2) {

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
							    product
							SET
							    product_name = '$name',
							    product_brand = '$brand',
							    product_type = '$type',
							    product_desc = '$desc',
							    product_price = '$price',
							    product_quantity = '$quantity'
							WHERE
							    product_id = $id
						    ";

			$update_query2 = "UPDATE
							    product_detail
							SET
							    purchase_date = '$purchaseDate',
							    cost = '$cost'
							WHERE
							    product_id = $id
							";

			$result = mysqli_query($connection, $update_query);
			$result2 = mysqli_query($connection, $update_query2);

			if ($result && $result2) {

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









<?php
if (isset($_GET["deletetype"])) {
	$id = $_GET["deletetype"];

	$query = "DELETE FROM product_type WHERE product_type_id='$id'";

	if (mysqli_query($connection, $query)) {
		$operationDesc[] = "Delete Type Successful.";
	} else {
		$operationDesc[] = "Delete Type Failed.";
	}
}
?>


<?php
if (isset($_POST["submitType"])) {
	$type = $_POST["type"];

	$query = "INSERT INTO product_type(type_name) VALUES('$type')";

	if (mysqli_query($connection, $query)) {
		$operationDesc[] = "Create Type Successful.";
	} else {
		$operationDesc[] = "Create Type Failed.";
	}
}
?>









<?php
if (isset($_GET["deletebrand"])) {
	$id = $_GET["deletebrand"];

	$query = "DELETE FROM product_brand WHERE product_brand_id='$id'";

	if (mysqli_query($connection, $query)) {
		$operationDesc[] = "Delete Brand Successful.";
	} else {
		$operationDesc[] = "Delete Brand Failed.";
	}
}
?>


<?php
if (isset($_POST["submitBrand"])) {
	$brand = $_POST["brand"];

	$query = "INSERT INTO product_brand(brand_name) VALUES('$brand')";

	if (mysqli_query($connection, $query)) {
		$operationDesc[] = "Create Brand Successful.";
	} else {
		$operationDesc[] = "Create Brand Failed.";
	}
}
?>
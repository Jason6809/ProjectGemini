<?php
session_start();

if (!isset($_SESSION["userID"])) {
  require ("../includes/login_tools.php");
  load();
}
?>




<?php
$page_name = "location";
$page_title = "Edit Location - ADMIN";
require ("../connect_db.php");
include ("includes/header.html");
?>


<?php
require ('includes/edit_location.php');
?>


<!-- <form action="" method="post" enctype="multipart/form-data">
	<input type="file" name="fileToUpload" id="fileToUpload" />
	<input type="submit" name="submit" value="Upload Image" />
</form> -->



<div class="icon-box">
	<a href="">
		<span>&uarr;</span>
	</a>	
</div>




<form action="" method="post" enctype="multipart/form-data"  id="form">
	<div class="container">
		<div class="content">
			<h1 class="heading">Location</h1>

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
				<div class="image" style="background-image: url('<?php echo "img/uploads/location/".$edit_img; ?>');" id="preview">
					<span>Preview</span>
				</div>

				<div class="content">

					<label style="color: red; align-self: flex-end;">*required field</label>

					<label>ID</label>
					<input type="number" placeholder="ID, Auto Increment, Read Only" style="background-color: lightgray;" value="<?php echo $edit_id; ?>" readonly />

					<label>Branch Name*</label>
					<input type="text" name="name" placeholder="Branch Name" value="<?php echo $edit_name; ?>" required />

					<label>Contact No*</label>
					<input type="text" name="phoneNo" placeholder="Content No" value="<?php echo $edit_phoneNo; ?>" required />

					<label>Address*</label>
					<textarea name="address" placeholder="Address" required ><?php echo $edit_address; ?></textarea>

					<label>Image*</label>
					<input type="file" name="fileToUpload" id="fileToUpload" onchange="previewImg()" />

					<div class="button_box">
						<input type="reset" value="Clear" onclick="location.href='location.php'" />
						<input type="submit" name="update" value="Update" />
						<input type="submit" name="submit" value="Submit" />
					</div>

				</div>

				<script type="text/javascript">

					function previewImg() {
						var preview = document.querySelector("#preview");
						var file = document.querySelector("#fileToUpload").files[0];
						var reader = new FileReader();

						reader.addEventListener("load", function () {
							preview.style.backgroundImage = "url(" + reader.result + ")";
						}, false);

						if (file) {
							reader.readAsDataURL(file);
						}
					}

				</script>
			</div>
		</div>
	</div>
</form>

<div class="parallax" style="background-image: url('../includes/img/parallax6.jpg'); display: block;" id="location">
	<div class="container">
		<div class="row">
			<div class="col-l-12">
				<h1 class="heading">Location</h1>
			</div>
		</div>

		<div class="row">

			<?php
			$query = "SELECT * FROM branch";
			$result = mysqli_query($connection, $query);

			while ($row = mysqli_fetch_array($result)) {
				$id      = $row["branch_id"];
				$img 	 = $row["branch_img"];
				$name 	 = $row["branch_name"];
				$phoneNo = $row["branch_phoneNo"];
				$address = $row["branch_address"];
				?>

				<div class="col-l-6 col-m-6 col-s-12" id="location_card">
					<div class="content">
						<div class="card">
							<div class="image" style="background-image: url('<?php echo "img/uploads/location/".$img; ?>');"></div>
							<div class="content">
								<p>ID: <?php echo $id; ?></p>
								<hr>
								<h1 class="heading"><?php echo $name; ?></h1>
								<p>Contact No: <?php echo $phoneNo; ?></p>
								<p>Address:<br/><?php echo $address; ?></p>

								<a class="right" href="location.php?delete=<?php echo $id; ?>">Delete</a>
								<a class="right" href="location.php?edit=<?php echo $id; ?>">Edit</a>
							</div>
						</div>
					</div>
				</div>

				<?php
			}
			?>
		</div>
	</div>
</div>

<?php
include ("../includes/footer.html");
?>

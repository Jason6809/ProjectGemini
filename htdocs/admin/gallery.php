<?php
session_start();

if (!isset($_SESSION["userID"])) {
  require ("../includes/login_tools.php");
  load();
}
?>

<?php
$page_name = "gallery";
$page_title = "Edit Gallery - ADMIN";
require ('../connect_db.php');
include ('includes/header.php');
?>

<?php
require ('includes/edit_gallery.php');
?>




<div class="icon-box">
	<a href="">
		<span>&uarr;</span>
	</a>	
</div>






<form action="" method="post" enctype="multipart/form-data" id="form">
	<div class="container">
		<div class="content">
			<h1 class="heading">Gallery</h1>

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
				<div class="image" style="height: 40em;" id="preview">
					<span>Preview</span>
				</div>

				<div class="content">

					<label style="color: red; align-self: flex-end;">*required field</label>

					<label>Image*</label>
					<input type="file" name="fileToUpload" id="fileToUpload" onchange="previewImg()" required />

					<div class="button_box">
						<input type="reset" value="Clear" onclick="location.href='gallery.php'" />
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






<div class="parallax" style="background-image: url('../includes/img/parallax7.jpg');" id="gallery">
	<div class="container">
		<div class="row">
			<div class="col-l-12">
				<div class="content">
					<h1 class="heading">Gallery</h1>
				</div>
			</div>
		</div>


		<div class="img_row">
			<div class="img_column">

				<?php
				$count = 1;
				$query = "SELECT * FROM gallery ORDER BY gallery_id DESC";
				$result = mysqli_query($connection, $query);

				while ($row = mysqli_fetch_array($result)) {
					$id = $row["gallery_id"];
					$img = $row["img_name"];



					if ($count <  3) {

						?>

				<div class="card">
					<div class="content">
						<p>ID: <?php echo $id." count: ".$count ?></p>
						<img src="<?php echo "img/uploads/gallery/".$img; ?>">
						<a class="right" href="gallery.php?delete=<?php echo $id; ?>">Delete</a>
					</div>
				</div>

						<?php
						$count++;
					} else {

					?>

				<div class="card">
					<div class="content">
						<p>ID: <?php echo $id." count: ".$count ?></p>
						<img src="<?php echo "img/uploads/gallery/".$img; ?>">
						<a class="right" href="gallery.php?delete=<?php echo $id; ?>">Delete</a>
					</div>
				</div>

			</div>

			<div class="img_column">

					<?php
					$count = 1;
					}
				}
				?>

			</div>
		</div>
	</div>
</div>

<?php
include ("../includes/footer.php");
?>

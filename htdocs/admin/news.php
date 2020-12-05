<?php
session_start();

if (!isset($_SESSION["userID"])) {
  require ("../includes/login_tools.php");
  load();
}
?>


<?php
$page_name = "news";
$page_title = "Edit News - ADMIN";
require ("../connect_db.php");
include ("includes/header.html");
?>

<?php
require ("includes/edit_news.php");
?>



<div class="icon-box">
	<a href="">
		<span>&uarr;</span>
	</a>	
</div>











<!-- <form action="" method="post" enctype="multipart/form-data">
<input type="file" name="fileToUpload" id="fileToUpload" />
<input type="submit" name="submit" value="Upload Image" />
</form> -->

<form action="" method="post" enctype="multipart/form-data" id="form">
	<div class="container">
		<div class="content">
			<h1 class="heading">News</h1>

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
				<div class="image" style="background-image: url('<?php echo "img/uploads/news/".$edit_img; ?>');" id="preview">
					<span>Preview</span>
				</div>

				<div class="content">

					<label style="color: red; align-self: flex-end;">*required field</label>

					<label>ID</label>
					<input type="number" placeholder="ID, Auto Increment, Read Only" style="background-color: lightgray;" value="<?php echo $edit_id?>" readonly />

					<label>Title*</label>
					<input type="text" name="title" placeholder="News Title" value="<?php echo $edit_title?>" required />

					<label>Date*</label>
					<input type="date" name="date" value="<?php echo $edit_date ?>" required />

					<label>Content*</label>
					<textarea name="content" placeholder="News Content" required ><?php echo $edit_content?></textarea>

					<label>Image*</label>
					<input type="file" name="fileToUpload" id="fileToUpload" onchange="previewImg()" />

					<div class="button_box">
						<input type="reset" value="Clear" onclick="location.href='news.php'" />
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

<div class="parallax" style="background-image: url('../includes/img/parallax2.jpg'); display: block;"  id="news">
	<div class="container">
		<div class="content">
			<h1 class="heading">News</h1>

			<?php
			$query = "SELECT * FROM news ORDER BY news_date DESC";
			$result = mysqli_query($connection, $query);

			while ($row = mysqli_fetch_array($result)) {
				$id      = $row["news_id"];
				$img 	 = $row["img_name"];
				$title 	 = $row["news_title"];
				$date 	 = $row["news_date"];
				$content = $row["news_content"];
				?>

				<div class="card">
					<div class="image" style="background-image: url('<?php echo "img/uploads/news/".$img; ?>');"></div>
					<div class="content">
						<p>ID: <?php echo $id; ?></p>
						<hr>
						<h1 class="heading"><?php echo $title; ?></h1>
						<p>Date: <?php echo $date; ?></p>
						<p>Content:<br/><?php echo $content; ?></p>

						<a class="right" href="news.php?delete=<?php echo $id; ?>">Delete</a>
						<a class="right" href="news.php?edit=<?php echo $id; ?>">Edit</a>
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

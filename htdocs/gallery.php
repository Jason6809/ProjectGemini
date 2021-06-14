<?php
$page_name = "gallery";
$page_title = "Gallery - GEMINI";

require ("connect_db.php");
include ("includes/header.php");
?>


<style type="text/css">
	#gallery {
		padding-top: 7em;
	}
</style>

<div class="parallax" style="background-image: url('includes/img/parallax7.jpg');" id="gallery">
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

				<div class="card" style="margin:0; box-shadow: none; background-color: transparent;">
					<div class="content" style="background-color: transparent;">
						
							<img style="box-shadow: 5px 5px 2px rgba(0,0,0,0.5);" id="<?php echo 'imageToModal'.$id; ?>" onclick="openModal(<?php echo $id; ?>)" src="<?php echo "admin/img/uploads/gallery/".$img; ?>">
						
					</div>
				</div>

						<?php
						$count++;
					} else {
						
					?>

				<div class="card" style="margin:0; box-shadow: none; background-color: transparent;">
					<div class="content" style="background-color: transparent;">
						
							<img style="box-shadow: 5px 5px 2px rgba(0,0,0,0.5);" id="<?php echo 'imageToModal'.$id; ?>" onclick="openModal(<?php echo $id; ?>)" src="<?php echo "admin/img/uploads/gallery/".$img; ?>">
						
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

<div class="modal" id="modal">
	<a id="closeBtn">X</a>
	<img class="content" id="imageInModal" />
</div>



<?php
include ("includes/footer.php");
?>
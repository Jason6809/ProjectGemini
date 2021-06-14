<?php
$page_name = "location";
$page_title = "Location - GEMINI";
require ("connect_db.php");
include ("includes/header.php");
?>
<style type="text/css">
	#location {
		padding-top: 7em;
	}
</style>


<div class="parallax" style="background-image: url('includes/img/parallax6.jpg');" id="location">
		<div class="container">			
			<div class="row">
				<div class="col-1-12">
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

				<div class="col-1-6 col-m-6 col-s-12" id="location_card">
					<div class="content">
						<div class="card">
							<div class="image" style="background-image: url('<?php echo "admin/img/uploads/location/".$img; ?>');"></div>								
							<div class="content">
								<p>ID: <?php echo $id; ?></p>
								<h1 class="heading"><?php echo $name; ?></h1>
								<p>Contact No: <?php echo $phoneNo; ?></p>
								<p>Address:<br/><?php echo $address; ?></p>
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
include ("includes/footer.php");
?>
<?php
$page_name = "stylist";
$page_title = "Stylist - GEMINI";
require ("connect_db.php");
include ("includes/header.html");
?>

<style type="text/css">
	#stylist {
		padding-top: 7em;
	}
</style>

<div class="parallax" style="background-image: url('includes/img/parallax5.jpg');" id="stylist">
	<div class="container">
		<div class="row">
			<div class="col-l-12">
				<h1 class="heading">Our Top Stylist</h1>
			</div>
		</div>

		<div class="row">
			<?php
			$query = "SELECT
						    *
						FROM
						    stylist
						LEFT JOIN branch ON `stylist`.stylist_branch = `branch`.branch_id
						LEFT JOIN stylist_detail ON `stylist`.stylist_id = `stylist_detail`.stylist_id
					 ";

			$result = mysqli_query($connection, $query);

			while ($row = mysqli_fetch_array($result)) {
				$id = $row["stylist_id"];
				$name = $row["stylist_name"];
				$intro = $row["stylist_intro"];
				$branch = $row["branch_name"];
				$exp = $row["stylist_exp"];
				$fees = $row["stylist_fees"];
				$img = $row["stylist_img"];
			?>

			<div class="col-l-4 col-m-6 col-s-12" id="stylist_card">
				<div class="content center">					
					<div class="card">
						<div class="image" style="background-image: url('<?php echo "admin/img/uploads/stylist/".$img; ?>');"></div>								
						<div class="content">
							<h1 class="heading"><?php echo $name; ?></h1>
							<p><?php echo $exp; ?> Year(s)</p>
							<p><?php echo $branch; ?></p>
							<p><?php echo $intro; ?></p>
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
include ("includes/footer.html");
?>
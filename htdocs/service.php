<?php
$page_name = "service";
$page_title = "Service - GEMINI";
require ('connect_db.php');
include 'includes/header.php';
?>

<div class="parallax" style="background-image: url('includes/img/parallax4.jpg'); padding-top: 7em; " id="service_list">

	<div class="container">

		<div class="row">
			<div class="col-l-12">
				<h1 class="heading">Services</h1>
			</div>
		</div>

		<div class="row">
			<?php
				$getServiceTypeQuery = "SELECT * FROM service_type";
				$getServiceType = mysqli_query($connection, $getServiceTypeQuery);

				while ($row = mysqli_fetch_array($getServiceType)) {
					$id = $row["service_type_id"];
					$name = $row["type_name"];
					?>

					<div class="col-l-6 col-m-6 col-s-12" id="service_list_content">
						<div class="content">
							<div class="card">
								<table cellspacing="0" cellpadding="5">
									<tr>
										<th colspan="2"><?php echo $name; ?></th>
									</tr>

									<!-- <tr>										
										<td>Name</td>
										<td>Price</td>							
									</tr>	 -->

									<?php
									$getServiceQuery = "SELECT * FROM service WHERE service_type = '$id'";

									$getService = mysqli_query($connection, $getServiceQuery);

									while ($row = mysqli_fetch_array($getService)) {

										$id = $row["service_id"];
										$name = $row["service_name"];
										$price = $row["service_price"];
										?>
										

										<tr>									
											<td><?php echo $name; ?></td>
											<td>RM<?php echo $price; ?></td>
										</tr>

										<?php
									}
									?>									
								</table>
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
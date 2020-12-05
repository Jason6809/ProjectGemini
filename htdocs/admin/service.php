<?php
session_start();

if (!isset($_SESSION["userID"])) {
  require ("../includes/login_tools.php");
  load();
}
?>


<?php
$page_name = "service";
$page_title = "Edit Services - ADMIN";
require ("../connect_db.php");
include ("includes/header.html");
?>

<?php
require ("includes/edit_service.php");
?>


<div class="icon-box">
	<a href="">
		<span>&uarr;</span>
	</a>	
</div>




<div class="container full">
	<div class="row">
		<div class="col-l-2">
			<form action="" method="post" id="form">
				<div class="content">
					<h1 class="heading">Add Type</h1>
					<div class="card" style="flex-direction: column; padding-bottom: 25px;">
						<div class="content" style="width: 100%;">
							<label>Service Type</label>
							<input type="text" placeholder="Product Type" name="type">
							<div class="button_box">
								<input type="submit" name="submitType">
							</div>
						</div>
						
						<table border="1" cellspacing="0">
							<?php
							$getTypeQuery = "SELECT * FROM service_type";
							$getType = mysqli_query($connection, $getTypeQuery);
							while ($row = mysqli_fetch_array($getType)) {
								$t_id = $row["service_type_id"];
								$t_name = $row["type_name"];
							?>

							<tr>
								<td><?php echo $t_id; ?></td>
								<td><?php echo $t_name; ?></td>
								<td><a href="service.php?deletetype=<?php echo $t_id; ?>">Delete</a></td>
							</tr>

							<?php
							}
							?>
						</table>
					</div>
				</div>
			</form>
		</div>

		<div class="col-l-8">
			<form action="" method="post" enctype="multipart/form-data" id="form">
				
				<div class="content">
					<h1 class="heading">Services</h1>

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

						<div class="content" style="width: 100%;">

							<label style="color: red; align-self: flex-end;">*required field</label>					

							<label>Service Name*</label>
							<input type="text" name="name" placeholder="Service Name" value="" required />

							<label>Price*</label>
							<input type="number" name="price" step=".01" placeholder="RM0.00" value="" required />

							<label>Type*</label>
							<select name="type" required>
								<option>Select a type</option>
							<?php
								$getServiceTypeQuery = "SELECT * FROM service_type";
								$getService = mysqli_query($connection, $getServiceTypeQuery);

								while ($row = mysqli_fetch_array($getService)) {
									$id = $row["service_type_id"];
									$name = $row["type_name"];
									?>

									<option value="<?php echo $id; ?>"><?php echo $id." - ".$name; ?></option>

									<?php
								}
							?>
							</select>
							

							<div class="button_box">
								<input type="reset" value="Clear" onclick="location.href='service.php'" />
								<!-- <input type="submit" name="update" value="Update" /> -->
								<input type="submit" name="submit" value="Submit" />
							</div>

						</div>
					</div>
				</div>
				
			</form>
		</div>

		<div class="col-l-2">
			
		</div>
	</div>
</div>





<div class="parallax" style="background-image: url('../includes/img/parallax4.jpg');" id="service_list">

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
										<th colspan="4"><?php echo $name; ?></th>
									</tr>

									<tr>
										<td>ID</td>
										<td>Name</td>
										<td>Price</td>
										<td>Action</td>
									</tr>	

									<?php
									$getServiceQuery = "SELECT * FROM service WHERE service_type = '$id'";

									$getService = mysqli_query($connection, $getServiceQuery);

									while ($row = mysqli_fetch_array($getService)) {

										$id = $row["service_id"];
										$name = $row["service_name"];
										$price = $row["service_price"];
										?>
										

										<tr>
											<td><?php echo $id; ?></td>
											<td><?php echo $name; ?></td>
											<td>RM<?php echo $price; ?></td>
											<td>
												<form id="form" method="post" action="" style="padding: 0;">
													<div class="button_box">
														<a href="service.php?delete=<?php echo $id; ?>" style="margin: 0;">Delete</a>
													</div>
												</form>
											</td>
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
include ("../includes/footer.html");
?>
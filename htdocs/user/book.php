<?php
session_start();

if (!isset($_SESSION["userID"])) {
	require ("../includes/login_tools.php");
	load();
}

$page_name = "book";
$page_title = "Book - GEMINI";
require ("../connect_db.php");
include ("includes/header.php");
?>

<?php
$operationDesc = array();
?>

<?php
//DELETE
if (isset($_GET["cancel"])) {
	$id = $_GET["cancel"];	

	$query = "DELETE FROM booking WHERE book_id = '$id'";
	// $query2 = "DELETE FROM stylist_detail WHERE stylist_id = '$id'";
	$result = mysqli_query($connection, $query);
	// $result2 = mysqli_query($connection, $query2);

	if ($result) {

		$operationDesc[] = "Cancel Successful.";		

	} else {

		$operationDesc[] = "Cancel Error.";

	}
}
?>




<?php

$URI = $_SERVER["REQUEST_URI"];

unset($_SESSION["locationID"]);
unset($_SESSION["stylistID"]);
unset($_SESSION["serviceID"]);


if (isset($_GET["location"])) {
	$_SESSION["locationID"] = $_GET["location"];
	$locationID = $_SESSION["locationID"];

	if (isset($_GET["stylist"])) {
		$_SESSION["stylistID"] = $_GET["stylist"];
		$stylistID = $_SESSION["stylistID"];

		if (isset($_GET["service"])) {
			$_SESSION["serviceID"] = $_GET["service"];
			$serviceID = $_SESSION["serviceID"];
		}	
	}
}

// if (isset($_GET["stylist"])) {
// 	$_SESSION["stylistID"] = $_GET["stylist"];
// 	$stylistID = $_SESSION["stylistID"];	
// }

// if (isset($_GET["service"])) {
// 	$_SESSION["serviceID"] = $_GET["service"];
// 	$serviceID = $_SESSION["serviceID"];
// }
?>

<?php
if (isset($_POST["submit"])) {
	$userID = $_SESSION["userID"];
	$bookDateTime = $_POST["bookingDate"]." ".$_POST["bookingTime"];

	$bookQuery = "INSERT INTO booking(
					    user_id,
					    stylist_id,
					    service_id,
					    branch_id,
					    book_status,
					    book_date,
					    request_date
					)
					VALUES(
					    '$userID',
					    '$stylistID',
					    '$serviceID',
					    '$locationID',					    
					    0,
					    '$bookDateTime',
					    NOW())
				  ";

	$result = mysqli_query($connection, $bookQuery);

	if ($result) {
		$operationDesc[] = "Booking Successful.";
		// header("Location: book.php");
		// echo "succesful";
	} else {
		$operationDesc[] = "Booking Failed.".mysqli_error($connection);
		// echo mysqli_error($connection);
	}
}
?>






<div class="notice_box" style="display: <?php if(!empty($operationDesc)){echo "block";}else{echo "none";} ?>">
	<?php
	if (!empty($operationDesc)) {
		?>

		<label style="color: white;">
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




<div class="parallax" style="background-color: lightgray;">
	<?php
	$getBookingQuery = "SELECT
						    *
						FROM
						    booking
						LEFT JOIN stylist ON `booking`.stylist_id = `stylist`.stylist_id
						LEFT JOIN service ON `booking`.service_id = `service`.service_id
						LEFT JOIN service_type ON `service`.service_type = `service_type`.service_type_id
						LEFT JOIN branch ON `booking`.branch_id = `branch`.branch_id 
						WHERE
						    `booking`.user_id = '".$_SESSION["userID"]."'
						";

	$getBooking = mysqli_query($connection, $getBookingQuery);

if (mysqli_num_rows($getBooking) == 0) {
	?>

		<div class="container" style="padding-top: 10em;">
			<div class="row">
				<div class="col-l-2 col-m-12 col-s-12">
					<div class="sidenav" id="">
						<h1 class="heading black">Steps</h1>
						<div class="card">
							<a href="#" class="<?php if(isset($_SESSION["locationID"])){echo "active";}else{echo "";} ?>">Location</a>

							<a href="#" class="<?php if(isset($_SESSION["stylistID"])){echo "active";}else{echo "";} ?>">Stylist</a>

							<a href="#" class="<?php if(isset($_SESSION["serviceID"])){echo "active";}else{echo "";} ?>">Service</a>

							<a href="#" class="<?php if(isset($_SESSION["locationID"])&&isset($_SESSION["stylistID"])&&isset($_SESSION["serviceID"])){echo "block";}else{echo "none";}?>">Confirmation</a>
						</div>
					</div>
				</div>






				<div class="col-l-10 col-m-12 col-s-12">
					<div class="content" id="location" style="display: <?php if(!isset($_SESSION["locationID"])){echo "block";}else{echo "none";}?>;">
						<div class="row">
							<div class="col-l-12">
								<h1 class="heading black">Location</h1>
							</div>
						</div>

						<div class="row">
							
							<?php
							$getBranchQuery = "SELECT * FROM branch";
							$getBranch = mysqli_query($connection, $getBranchQuery);

							while ($row = mysqli_fetch_array($getBranch)) {
								$id      = $row["branch_id"];
								$img 	 = $row["branch_img"];
								$name 	 = $row["branch_name"];
								$phoneNo = $row["branch_phoneNo"];
								$address = $row["branch_address"];
								?>

							<div class="col-1-6 col-m-6 col-s-12" id="location_card">
								<div class="content">
									<div class="card">
										<div class="image" style="background-image: url('<?php echo "../admin/img/uploads/location/".$img; ?>');"></div>								
										<div class="content">
											<h1 class="heading"><?php echo $name; ?></h1>
											<p>Contact No: <?php echo $phoneNo; ?></p>
											<p>Address:<br/><?php echo $address; ?></p>
											<form action="" method="post" id="form" style="padding-top: 0;">
												<div class="button_box">												
													<a href="book.php?location=<?php echo $id; ?>">Select</a>
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>

							<?php
						}
						?>
						</div>
					</div>











					<div class="content" id="stylist" style="display: <?php if(!isset($_SESSION["stylistID"])&&isset($_SESSION["locationID"])){echo "block";}else{echo "none";}?>;">
						<div class="row">
							<div class="col-l-12">
								<h1 class="heading black">Stylist</h1>
							</div>
						</div>

						<div class="row">
							<?php
							$getFullStylistQuery = "SELECT
													    *
													FROM
													    stylist
													LEFT JOIN branch ON `stylist`.stylist_branch = `branch`.branch_id
													LEFT JOIN stylist_detail ON `stylist`.stylist_id = `stylist_detail`.stylist_id
													WHERE `stylist`.stylist_branch = '$locationID'
												 ";

							$getFullStylist = mysqli_query($connection, $getFullStylistQuery);

							while ($row = mysqli_fetch_array($getFullStylist)) {
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
										<div class="image" style="background-image: url('<?php echo "../admin/img/uploads/stylist/".$img; ?>');"></div>								
										<div class="content">
											<h1 class="heading"><?php echo $name; ?></h1>
											<p><?php echo $exp; ?> Year(s)</p>
											<p>RM<?php echo $fees; ?></p>
											<p><?php echo $branch; ?></p>
											<p><?php echo $intro; ?></p>
											<form id="form" method="post" action="" style="padding: 0;">
												<div class="button_box">
													<a href="<?php echo $URI; ?>&stylist=<?php echo $id; ?>">Select</a>
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>

							<?php
							}
							?>
						</div>
					</div>











					<div class="content" id="service_list" style="display: <?php if(!isset($_SESSION["serviceID"])&&isset($_SESSION["stylistID"])){echo "block";}else{echo "none";}?>;">
						<div class="row">
							<div class="col-l-12">
								<h1 class="heading black">Services</h1>
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
														<th colspan="3"><?php echo $name; ?></th>
													</tr>

													<tr>											
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
															<td><?php echo $name; ?></td>
															<td>RM<?php echo $price; ?></td>
															<td>
																<form id="form" method="post" action="" style="padding: 0;">
																	<div class="button_box">
																		<a href="<?php echo $URI; ?>&service=<?php echo $id; ?>" style="margin: 0;">Select</a>
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







					<div class="content" style="display: <?php if(isset($_SESSION["locationID"])&&isset($_SESSION["stylistID"])&&isset($_SESSION["serviceID"])){echo "block";}else{echo "none";}?>">
						<div class="row">
							<div class="col-l-12 col-m-12 col-s-12">
								<h1 class="heading black">Confirmation</h1>
							</div>
						</div>

						<div class="row">
							<div class="col-l-12 col-m-12 col-s-12">
								<div class="content">
									<div class="card">
										<form action="" method="post" id="form" style="padding: 0;">
											<table cellpadding="10" cellspacing="0">
												<tr>
													<?php													
													$getBranchQuery = "SELECT * FROM branch WHERE branch_id='$locationID'";
													$getBranch = mysqli_query($connection, $getBranchQuery);

													while ($row = mysqli_fetch_array($getBranch)) {
														$b_name = $row["branch_name"];
													}
													?>
													<td><?php echo $b_name; ?></td>
													<td class="right">N/A</td>
												</tr>

												<tr>
													<?php
													$getStylistQuery = "SELECT * FROM stylist WHERE stylist_id='$stylistID'";
													$getStylist = mysqli_query($connection, $getStylistQuery);

													while ($row = mysqli_fetch_array($getStylist)) {
														$sy_name = $row["stylist_name"];
														$sy_fees = $row["stylist_fees"];
													}
													?>
													<td><?php echo $sy_name; ?></td>
													<td class="right">RM<?php echo $sy_fees; ?></td>
												</tr>

												<tr>
													<?php
													$getFullServiceQuery = "SELECT * FROM service LEFT JOIN service_type ON `service`.service_type = `service_type`.service_type_id WHERE service_id='$serviceID'";
													$getFullService = mysqli_query($connection, $getFullServiceQuery);

													while ($row = mysqli_fetch_array($getFullService)) {
														$sv_type  = $row["type_name"];
														$sv_name  = $row["service_name"];
														$sv_price = $row["service_price"];
													}
													?>
													<td><?php echo $sv_type." - ".$sv_name; ?></td>
													<td class="right">RM<?php echo $sv_price; ?></td>
												</tr>										
												<tr>
													<th>Total</th>
													<th>RM<?php printf("%.2f", $sy_fees+$sv_price); ?></th>
												</tr>
												<tr>
													<td>
														<div class="card">
															<div class="content" style="width: 100%;">

																<label style="color: red; align-self: flex-end;">*required field</label>

																<label>Booking Date*</label>
																<input type="date" name="bookingDate" min="<?php echo date("Y-m-d"); ?>" max="<?php echo date("Y-m-d", time()+259200); ?>" value="" required />

																<label>Booking Time*</label>
																<input type="time" name="bookingTime" min="11:00" max="20:00" />
															</div>
														</div>
													</td>
													<td>
														<div class="button_box" style="flex-direction: column;">
															<input type="reset" value="Reset" onclick="location.href='book.php'">
															<input type="submit" name="submit" value="Check Out">
														</div>											
													</td>											
												</tr>
											</table>
										</form>									
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	




	<?php
} else {
	?>





		<div class="container" style="padding-top: 10em;">
			<div class="row">
				<div class="col-l-2 col-m-12 col-s-12">
					<div class="sidenav" id="">
						<h1 class="heading black">Steps</h1>
						<div class="card">						
							<a href="#" class="active">Status</a>
						</div>
					</div>
				</div>





				<div class="col-l-10 col-m-12 col-s-12">
					<div class="content" id="">
						<div class="row">
							<div class="col-l-12">
								<h1 class="heading black">Status</h1>
							</div>
						</div>

						<div class="row">
							<div class="col-l-12">
								<div class="content">
									<div class="card">
										<form action="" method="post" id="form" style="padding: 0;">
										<table cellpadding="10" cellspacing="0">

											<?php
											while($row = mysqli_fetch_array($getBooking)) {
												$bookID = $row["book_id"];
												$location = $row["branch_name"];
												$stylist = $row["stylist_name"];
												$sy_fees = $row["stylist_fees"];
												$service = $row["service_name"];
												$serv_type = $row["type_name"];
												$sv_price = $row["service_price"];
												$datetime = $row["book_date"];
												$requestdate = $row["request_date"];

												$status = $row["book_status"];

												?>
												<tr>
													<td>Booking ID</td>
													<td><?php echo $bookID; ?></td>
												</tr>

												<tr>
													<td>Location</td>
													<td><?php echo $location; ?></td>
												</tr>
												<tr>
													<td>Stylist</td>
													<td><?php echo $stylist; ?></td>
												</tr>
												<tr>
													<td>Service</td>
													<td><?php echo $serv_type." - ".$service; ?></td>
												</tr>
												<tr>
													<td>Date and Time</td>
													<td><?php echo $datetime; ?></td>
												</tr>
												<tr>
													<td>Request Date</td>
													<td><?php echo $requestdate; ?></td>
												</tr>

												<tr>
													<td>Price</td>
													<td>RM<?php printf("%.2f", $sy_fees+$sv_price); ?></td>
												</tr>

												<tr>
													<td>Status</td>
													<td>
														<?php
														if ($status == 0) {
															echo "Pending";
														} elseif ($status == 1) {
															echo "Accepted";
														} else {
															echo "Declined";
														}
														?>
													</td>
												</tr>

												<?php
											}
											?>

											<tr>
												<td>
													<div class="card">
														<div class="content" style="width: 100%;">

															<label style="color: red;">*Notice</label>

															<label>1. Cancel is not REFUNDABLE in pending status.</label>
															
															<label>2. The amount will RETURN in 3 working days if the stylist DECLINED your booking.</label>

															<label>3. Please kindly CANCEL the booking after you received refund.</label>

															<label>4. Status will be UPDATE in 3 days.</label>
														</div>
													</div>
												</td>
												<td>
													<div class="button_box">
														<!-- <input type="reset" value="Reset" onclick="location.href='book.php'">
														<input type="submit" name="submit" value="Check Out"> -->
														<a href="book.php?cancel=<?php echo $bookID;?>">Cancel</a>
													</div>											
												</td>											
											</tr>
										</table>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>			
				</div>
			</div>
		</div>
	<?php
}
?>
</div>












<?php
include ("../includes/footer.php");
?>
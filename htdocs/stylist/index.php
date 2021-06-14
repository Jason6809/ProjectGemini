<?php
session_start();

if (!isset($_SESSION["userID"])) {
  require ("../includes/login_tools.php");
  load();
}
?>

<?php
$page_name = "book";
$page_title = "Booking - Stylist";
require ('../connect_db.php');
include ('includes/header.php');
?>

<?php
$operationDesc = array();
?>


<?php
if (isset($_POST["submit"])) {
	$bookID = $_POST["bookID"];
	$status = $_POST["status"];
	$bookAccepted;

	$getFullStylistQuery = "SELECT
							    *
							FROM
								stylist_detail
							WHERE
								stylist_id = '".$_SESSION["userID"]."'
							";
	$getFullStylist = mysqli_query($connection, $getFullStylistQuery);
	while ($row = mysqli_fetch_array($getFullStylist)) {
		$bookAccepted = $row["book_accepted"];
	}

	if ($status == 1) {

		$bookAccepted++;

		$updateQuery = "UPDATE booking SET book_status='$status' WHERE book_id = '$bookID'";
		$updateQuery2 = "UPDATE stylist_detail SET book_accepted='$bookAccepted' WHERE stylist_id = '".$_SESSION["userID"]."'";

		if (mysqli_query($connection, $updateQuery) && mysqli_query($connection, $updateQuery2)) {

			$operationDesc[] = "Update Successful.";

		} else {

			$operationDesc[] = "Update Error. ".mysqli_error($connection);

		}

	} else {

		$updateQuery = "UPDATE booking SET book_status='$status' WHERE book_id = '$bookID'";

		if (mysqli_query($connection, $updateQuery)) {

			$operationDesc[] = "Update Successful.";

		} else {

			$operationDesc[] = "Update Error. ".mysqli_error($connection);

		}
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
	<div class="container" style="padding-top: 10em;">
		<div class="row">
			<div class="col-l-12 col-m-12 col-s-12">
				<div class="content">
					<h1 class="heading black">Booking Orders</h1>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-l-12 col-m-12 col-s-12">
				<div class="content">
						
							

								<?php
								$getBookingQuery = "SELECT
													    *
													FROM
													    booking
													LEFT JOIN user ON `booking`.user_id = `user`.user_id
													LEFT JOIN stylist ON `booking`.stylist_id = `stylist`.stylist_id
													LEFT JOIN service ON `booking`.service_id = `service`.service_id
													LEFT JOIN service_type ON `service`.service_type = `service_type`.service_type_id
													LEFT JOIN branch ON `booking`.branch_id = `branch`.branch_id 
													WHERE
													    `booking`.stylist_id = '".$_SESSION["userID"]."'
													ORDER BY `booking`.book_status ASC
													";

								$getBooking = mysqli_query($connection, $getBookingQuery);

								while($row = mysqli_fetch_array($getBooking)) {
									$userEmail = $row["email"];

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

						<div class="card">
							<form action="" method="post" id="form" style="padding: 0;">
								<table cellpadding="10" cellspacing="0">
									<tr>
										<td>Booking ID</td>
										<td><?php echo $bookID; ?></td>
									</tr>

									<tr>
										<td>User E-mail</td>
										<td><?php echo $userEmail; ?></td>
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
											<select name="status" style="margin: 0;" required>											
												<option value="0" <?php if($status == 0){echo "selected";}else{echo "";} ?>>Pending</option>
												<option value="1" <?php if($status == 1){echo "selected";}else{echo "";} ?>>Accepted</option>
												<option value="2" <?php if($status == 2){echo "selected";}else{echo "";} ?>>Declined</option>
											</select>											
										</td>
									</tr>



									<tr>
										<td style="width: 50%;">
											<div class="card">
												<div class="content" style="width: 100%;">

													<label style="color: red;">*Notice</label>

													<label>1. Think twice before submit.</label>

													<label>2. You are unable to CHANGE it again if an ACCEPTED is submitted</label>
													
													<label>3. Ask for admin to DECLINED.</label>									

													<label>4. Status must be UPDATE within 3 days.</label>
												</div>
											</div>
										</td>
										<td>
											<div class="button_box">

												<input type="hidden" name="bookID" value="<?php echo $bookID ?>">
												<input type="submit" name="submit" value="Submit" style="margin: 0;" <?php if($status == 1){echo "disabled";}else{echo "";} ?>>

											</div>											
										</td>											
									</tr>
								</table>
							</form>
						</div>
					<?php
					}
					?>
				</div>
			</div>
		</div>
	</div>
</div>

<?php
include ("../includes/footer.php");
?>

<?php
session_start();

if (!isset($_SESSION["userID"])) {
	require ("../includes/login_tools.php");
	load();
}

$page_name = "cart";
$page_title = "Cart - GEMINI";
require ("../connect_db.php");
include ("includes/header.php");
?>

<?php
$operationDesc = array();
?>

<?php
if (isset($_GET["delete"])) {
	$itemID = $_GET["delete"];

	$query = "DELETE FROM cart WHERE item_id = '$itemID'";

	if (mysqli_query($connection, $query)) {
		$operationDesc[] = "Delete Successful.";
	} else {
		$operationDesc[] = "Delete Error.";
	}
}
?>





<?php
if (isset($_POST["submit"])) {
	if ($_POST["address"] != "null") {
			$addressID = $_POST["address"];

			$getProductQuery = "SELECT
								    *
								FROM
								    cart
								LEFT JOIN product ON `cart`.product_id = `product`.product_id
								LEFT JOIN product_brand ON `product`.product_brand = `product_brand`.product_brand_id
								LEFT JOIN product_type ON `product`.product_type = `product_type`.product_type_id
								LEFT JOIN product_detail ON `product`.product_id = `product_detail`.product_id
								WHERE
									`cart`.user_id = '".$_SESSION["userID"]."'
								";

			$getProduct = mysqli_query($connection, $getProductQuery);

			while ($row = mysqli_fetch_array($getProduct)) {
				// $datetime = date('Y M d H:i:s');
				$userID = $_SESSION["userID"];
				$productID = $row["product_id"];
				$productName = $row["product_name"];
				$productQuantity = $row["product_quantity"];

				$insertTransactionQuery = "INSERT INTO transaction(transaction_time, user_id, product_id, address_id) VALUES(now(), '$userID', '$productID', '$addressID')";				

				if(mysqli_query($connection, $insertTransactionQuery)) {

					// $productQuantity--;
					$updateProductQuantity = "UPDATE product SET product_quantity=GREATEST(0, product_quantity-1) WHERE product_id='$productID'";					
					
					if(mysqli_query($connection, $updateProductQuantity)){						

						if (mysqli_query($connection, "DELETE FROM cart WHERE user_id = '$userID'")) {

							$operationDesc[] = "Purchase Successful.";
							header("Location: transaction.php");

						} else {

							$operationDesc[] = "Transaction successful but error occur to empty cart. Please check your <a href='transaction.php'>transaction history</a> immediately.";

						}
						
					} else {
						
						$operationDesc[] = "Transaction successful but error occur to modify quantity. Please call customer service immediately.";
					}			

				} else {

					$operationDesc[] = $productID.": ".$productName.". Submit Error.".mysqli_error($connection);

				}
			}

	} else {

		$operationDesc[] = "Please select a shipping address.".mysqli_error($connection);

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







<div class="icon-box">
	<a href="">
		<span>&uarr;</span>
	</a>	
</div>


<div class="parallax" style="background-color: lightgray;">
	<div class="container" id="product" style="padding-top: 10em;">		
		<div class="row">
			<div class="col-l-12 col-m-12 col-s-12">
				<div class="content" style="">
					<h1 class="heading black">My Items</h1>

					<?php
					$getProductQuery = "SELECT
										    *
										FROM
										    cart
										LEFT JOIN product ON `cart`.product_id = `product`.product_id
										LEFT JOIN product_brand ON `product`.product_brand = `product_brand`.product_brand_id
										LEFT JOIN product_type ON `product`.product_type = `product_type`.product_type_id
										LEFT JOIN product_detail ON `product`.product_id = `product_detail`.product_id
										WHERE
											`cart`.user_id = '".$_SESSION["userID"]."'
										";

						$getProduct = mysqli_query($connection, $getProductQuery);

						if (mysqli_num_rows($getProduct) > 0) {
							while ($row = mysqli_fetch_array($getProduct)) {
							$itemID    = $row["item_id"];

							$id 	   = $row["product_id"];
							$name 	   = $row["product_name"];
							$brand     = $row["brand_name"];
							$type 	   = $row["type_name"];
							$desc	   = $row["product_desc"];
							$price     = $row["product_price"];
							$quantity  = $row["product_quantity"];
							$img 	   = $row["product_img"];

							$purchaseDate  = $row["purchase_date"];
							$cost 		   = $row["cost"];
						?>

						<div class="card" id="product_item">
							<div class="image" style="background-image: url('<?php echo "../admin/img/uploads/product/".$img; ?>');"></div>

							<div class="content">
								<p><?php echo $brand; ?></p>
								<h1 class="heading"><?php echo $name; ?></h1>
								<p class="hidden"><?php echo $type; ?></p>
								<h1 class="heading">RM<?php echo $price; ?></h1>		

								<p><?php echo $desc; ?></p>
							</div>

							<form action="" method="post" id="form">
								<div class="button_box">
									<!-- <input type="hidden" name="productID" value="<?php //echo $id; ?>">
									<input type="submit" name="addToCart" value="Add to Cart" /> -->
									<!-- <a href="shop.php?edit=<?php //echo $id; ?>" style="width: 100%;">Edit</a> -->
									<a href="cart.php?delete=<?php echo $itemID; ?>" style="width: 100%;">Delete</a>
								</div>								
							</form>
						</div>

						<?php
						}
					?>

					<?php
					} else {
					?>

					<div class="card" id="product_item">
						<table>
							<tr>
								<td>No Product.</td>
							</tr>
						</table>
					</div>

					<?php
					}
					?>
				</div>
			</div>
		</div>
	</div>
</div>







<div class="parallax" style="background-color: lightgray; padding: 0;">
	<div class="container" style="padding: 0;">
		<div class="row">
			<div class="col-l-12 col-m-12 col-s-12">
				
					<form id="form" style="padding: 0;">
						<div class="content">
							<h1 class="heading black">Choose Shipping Address</h1>

							<div class="card">
							<div class="content" style="width: 100%;">
								<label style="color: red; align-self: flex-end;">*required field</label>

								<label>Address*</label>
								<select id="addressID" onchange="passValue()" style="width: 100%;" required>
									<option value="null" selected>Choose a shipping address</option>
									<?php
									$getAddressQuery = "SELECT
									    *
									FROM
									    user
									LEFT JOIN user_address ON `user`.user_id = `user_address`.user_id
									LEFT JOIN address ON `user_address`.address_id = `address`.address_id
									WHERE
									    `user_address`.user_id = '".$_SESSION["userID"]."'
									";

									$getAddress = mysqli_query($connection, $getAddressQuery);
									while ($row = mysqli_fetch_array($getAddress)) {
										$addressID = $row["address_id"];
										$plateNo = $row["plate_no"];
										$street1 = $row["street_1"];
										$street2 = $row["street_2"];
										$postcode = $row["postcode"];
										$city = $row["city"];
										$state = $row["state"];
										$phoneNo = $row["phone_no"];
									?>

									<option value="<?php echo $addressID; ?>"><?php echo $plateNo.", ".$street1.", ".$street2.", ".$postcode.", ".$city.", ".$state; ?></option>

									<?php
									}
									?>
								</select>
							</div>
							</div>
						</div>
					</form>	
					
			</div>
		</div>
	</div>
</div>












<div class="parallax" id="checkoutBox">
	<div class="container">
		<div class="checkout-box">
			<div class="row">
				<div class="col-l-3 col-m-3 hidden-s">
					<?php
					$getTotalItemQuery = "SELECT * FROM cart WHERE user_id = '".$_SESSION["userID"]."'";
					$getTotalItem = mysqli_query($connection, $getTotalItemQuery);
					$totalItem = mysqli_num_rows($getTotalItem);
					?>
					<h1 class="heading">Total Item: <?php echo $totalItem; ?></h1>
				</div>

				<div class="col-l-6 col-m-6 col-s-6">
					<?php
					$getTotalPriceQuery = "SELECT
											    ROUND(SUM(`product`.product_price * 1.06), 2) AS amount
											FROM
											    cart
											LEFT JOIN product ON `cart`.product_id = `product`.product_id
											WHERE
											    `cart`.user_id = '".$_SESSION["userID"]."'
										   ";
					$getTotalPrice = mysqli_query($connection, $getTotalPriceQuery);
					while($row = mysqli_fetch_array($getTotalPrice)) {
						$totalPrice = $row["amount"];
					}
					?>
					<h1 class="heading">Total Price: RM<?php echo $totalPrice; ?></h1>
				</div>

				<div class="col-l-3 col-m-3 col-s-6">
					<form action="" method="post" id="form">
						<div class="card">
							<input type="hidden" name="address" value="null" id="addressInput">
							<input type="submit" name="submit" value="Check Out">
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>



<?php
include ("../includes/footer.php");
?>

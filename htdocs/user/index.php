<?php
session_start();

if (!isset($_SESSION["userID"])) {
	require ("../includes/login_tools.php");
	load();
}

$page_name = "shop";
$page_title = "Shop - GEMINI";
require ("../connect_db.php");
include ("includes/header.php");
?>



<?php
$operationDesc = array();
if (isset($_POST["addToCart"])) {
	$id = $_POST["productID"];

	$addToCartQuery = "INSERT INTO cart(user_id, product_id) VALUES('".$_SESSION["userID"]."', '$id')";

	if (mysqli_query($connection, $addToCartQuery)) {
		$operationDesc[] = "Successfully added to cart.";
	} else {
		$operationDesc[] = "Failed to add. ".mysqli_error($connection);
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

	<?php
	$getTotalItemQuery = "SELECT * FROM cart WHERE user_id = '".$_SESSION["userID"]."'";
	$getTotalItem = mysqli_query($connection, $getTotalItemQuery);
	$totalItem = mysqli_num_rows($getTotalItem);
	?>
	<a href="cart.php">
		<span class="material-icons">shopping_cart</span>
		<span style="margin-left: -0.5em;"><?php echo $totalItem; ?></span>
	</a>
</div>

<div class="parallax" style="background-color: lightgray;">
	<div class="container" style="padding-top: 10em;">
		<div class="row">		
			<div class="col-l-2 col-m-12 col-s-12">
				<div class="sidenav" id="">
					<h1 class="heading black">Category</h1>
					<div class="card">

						<a class="<?php if(empty($_GET['brand'])){echo "active";} ?>" href="index.php">All</a>

						<?php
						$getBrandQuery = "SELECT * FROM product_brand";
						$getBrand = mysqli_query($connection, $getBrandQuery);

						while ($brand = mysqli_fetch_array($getBrand)) {
							$b_id = $brand["product_brand_id"];
							$brandName = $brand["brand_name"];
							?>

							<a onclick="openInnerSideNav(<?php echo $b_id; ?>)"><?php echo $brandName; ?></a>
							<div class="inner <?php if($_GET['brand']==$b_id){echo "active";} ?>" id="innerSideNav<?php echo $b_id; ?>">

							<?php
							$getTypeQuery = "SELECT * FROM product_type";
							$getType = mysqli_query($connection, $getTypeQuery);

							while ($type = mysqli_fetch_array($getType)) {
								$t_id = $type["product_type_id"];
								$typeName = $type["type_name"];
								?>
								
								<a class="<?php if($_GET['brand']==$b_id) {if($_GET['type']==$t_id){echo "active";}} ?>" href="index.php?brand=<?php echo $b_id; ?>&type=<?php echo $t_id; ?>"><?php echo $typeName; ?></a>

								<?php
							}
							?>

							</div>
							<?php
						}
						?>
					</div>
				</div>
			</div>

			<div class="col-l-10 col-m-12 col-s-12">
				<div class="content" id="product">
					<h1 class="heading black" id="">Shiseido</h1>

					<?php
					if (isset($_GET["brand"])) {
						if (isset($_GET["type"])) {
							$brandID = $_GET["brand"];
							$typeID = $_GET["type"];

							$getProductQuery = "SELECT
												    *
												FROM
												    product
												LEFT JOIN product_brand ON `product`.product_brand = `product_brand`.product_brand_id
												LEFT JOIN product_type ON `product`.product_type = `product_type`.product_type_id
												LEFT JOIN product_detail ON `product`.product_id = `product_detail`.product_id
												WHERE
													`product`.product_brand = $brandID AND `product`.product_type = $typeID
												";

							$getProduct = mysqli_query($connection, $getProductQuery);
							while ($row = mysqli_fetch_array($getProduct)) {
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
										<p><?php echo $type; ?></p>
										<p>RM<?php echo $price; ?></p>						
										<p>Quantity: <?php echo $quantity; ?></p>
										<p><?php echo $desc; ?></p>
									</div>

									<form action="" method="post" id="form">
										<div class="button_box">
											<input type="hidden" name="productID" value="<?php echo $id; ?>">
											<input type="submit" name="addToCart" value="Add to Cart" />
											<!-- <a href="shop.php?edit=<?php //echo $id; ?>" style="width: 100%;">Edit</a>
											<a href="shop.php?delete=<?php //echo $id; ?>" style="width: 100%;">Delete</a> -->
										</div>
									</form>
								</div>

								<?php
							}		
						}	
					} else {
						$getProductQuery = "SELECT
										    *
										FROM
										    product
										LEFT JOIN product_brand ON `product`.product_brand = `product_brand`.product_brand_id
										LEFT JOIN product_type ON `product`.product_type = `product_type`.product_type_id
										LEFT JOIN product_detail ON `product`.product_id = `product_detail`.product_id
										WHERE `product`.product_quantity > 0
										";

						$getProduct = mysqli_query($connection, $getProductQuery);
						while ($row = mysqli_fetch_array($getProduct)) {
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
								<p class="hidden"><?php echo $brand; ?></p>
								<h1 class="heading"><?php echo $name; ?></h1>
								<p class="hidden"><?php echo $type; ?></p>
								<p>RM<?php echo $price; ?></p>						
								<p>Quantity: <?php echo $quantity; ?></p>
								<p><?php echo $desc; ?></p>
							</div>

							<form action="" method="post" id="form">
								<div class="button_box">
									<input type="hidden" name="productID" value="<?php echo $id; ?>">
									<input type="submit" name="addToCart" value="Add to Cart" />
									<!-- <a href="shop.php?edit=<?php //echo $id; ?>" style="width: 100%;">Edit</a>
									<a href="shop.php?delete=<?php //echo $id; ?>" style="width: 100%;">Delete</a> -->
								</div>
							</form>
						</div>

						<?php
						}
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


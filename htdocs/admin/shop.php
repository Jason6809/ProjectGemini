<?php
session_start();

if (!isset($_SESSION["userID"])) {
  require ("../includes/login_tools.php");
  load();
}

$page_name = "shop";
$page_title = "Shop - ADMIN";
require ("../connect_db.php");
include ("includes/header.php");
?>

<?php
require ("includes/edit_product.php");
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
							<label>Product Type</label>
							<input type="text" placeholder="Product Type" name="type">
							<div class="button_box">
								<input type="submit" name="submitType">
							</div>
						</div>
						
						<table border="1" cellspacing="0">
							<?php
							$getTypeQuery = "SELECT * FROM product_type";
							$getType = mysqli_query($connection, $getTypeQuery);
							while ($row = mysqli_fetch_array($getType)) {
								$t_id = $row["product_type_id"];
								$t_name = $row["type_name"];
							?>

							<tr>
								<td><?php echo $t_id; ?></td>
								<td><?php echo $t_name; ?></td>
								<td><a href="shop.php?deletetype=<?php echo $t_id; ?>">Delete</a></td>
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
					<h1 class="heading">Shop</h1>

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
						<div class="image" style="background-image: url('<?php echo "img/uploads/product/".$edit_img; ?>');" id="preview">
							<span>Preview</span>
						</div>

						<div class="content">

							<label style="color: red; align-self: flex-end;">*required field</label>

							<label>ID</label>
							<input type="number" placeholder="ID, Auto Increment, Read Only" style="background-color: lightgray;" value="<?php echo $edit_id?>" readonly />

							<label>Name*</label>
							<input type="text" name="name" placeholder="Product Name" value="<?php echo $edit_name; ?>" required />

							<label>Brand*</label>
							<select name="brand" required>
								<option>Select a Brand</option>
								<?php
								$getBrandQuery = "SELECT * FROM product_brand";
								$getBrand = mysqli_query($connection, $getBrandQuery);
								while ($row = mysqli_fetch_array($getBrand)) {
									$b_id = $row["product_brand_id"];
									$b_name = $row["brand_name"];
									?>

									<option value="<?php echo $b_id ?>" <?php if($edit_brand == $b_id){echo "selected";} ?> >
										<?php echo $b_id." - ".$b_name; ?>									
									</option>

									<?php
								}
								?>
							</select>

							<label>Type*</label>
							<select name="type" required>
								<option>Select a Type</option>
								<?php
								$getTypeQuery = "SELECT * FROM product_type";
								$getType = mysqli_query($connection, $getTypeQuery);
								while ($row = mysqli_fetch_array($getType)) {
									$t_id = $row["product_type_id"];
									$t_name = $row["type_name"];
									?>

									<option value="<?php echo $t_id ?>" <?php if($edit_type == $t_id){echo "selected";} ?> >
										<?php echo $t_id." - ".$t_name; ?>									
									</option>

									<?php
								}
								?>
							</select>

							<label>Description*</label>
							<textarea name="desc" placeholder="Product Description" required><?php echo $edit_desc; ?></textarea>

							<label>Price*</label>
							<input type="number" name="price" step=".01" placeholder="Selling Price in RM0.00" value="<?php echo $edit_price;?>" required />

							<label>Quantity*</label>
							<input type="number" name="quantity" placeholder="Total Quantity" value="<?php echo $edit_quantity;?>" required />

							<hr>

							<label>Purchase Date*</label>
							<input type="date" name="purchaseDate" placeholder="Product Purchase Date" value="<?php echo $edit_purchaseDate; ?>" required />

							<label>Costing*</label>
							<input type="number" name="cost" step=".01" placeholder="Product Cost in RM0.00" value="<?php echo $edit_cost; ?>" required />

							<label>Image*</label>
							<input type="file" name="fileToUpload" id="fileToUpload" onchange="previewImg()" />

							<div class="button_box">
								<input type="reset" value="Clear" onclick="location.href='shop.php'" />
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
			</form>
		</div>

		<div class="col-l-2">
			<form action="" method="post" id="form">
				<div class="content">
					<h1 class="heading">Add Brand</h1>
					<div class="card" style="flex-direction: column; padding-bottom: 25px;">
						<div class="content" style="width: 100%;">
							<label>Product Brand</label>
							<input type="text" placeholder="Product Brand" name="brand">
							<div class="button_box">
								<input type="submit" name="submitBrand">
							</div>
						</div>

						
						<table border="1" cellspacing="0"">
							<?php
							$getBrandQuery = "SELECT * FROM product_brand";
							$getBrand = mysqli_query($connection, $getBrandQuery);
							while ($row = mysqli_fetch_array($getBrand)) {
								$b_id = $row["product_brand_id"];
								$b_name = $row["brand_name"];
							?>

							<tr>
								<td><?php echo $b_id; ?></td>
								<td><?php echo $b_name; ?></td>
								<td><a href="shop.php?deletebrand=<?php echo $b_id; ?>">Delete</a></td>
							</tr>

							<?php
							}
							?>
						</table>					
					</div>
				</div>
			</form>	
		</div>
	</div>
</div>

















<div class="parallax" style="background-color: lightgray;">
	<div class="container" id="product" style="">
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
								<p>ID:<?php echo $id; ?></p>
								<p>Brand: <?php echo $brand; ?></p>
								<h1 class="heading"><?php echo $name; ?></h1>
								<p>Type: <?php echo $type; ?></p>
								<p>Price: RM<?php echo $price; ?></p>

								<hr>
								<p>Cost: <?php echo $cost; ?></p>
								<p>Purchase date: <?php echo $purchaseDate; ?></p>

								<hr>

								<p>Quantity: <?php echo $quantity; ?></p>
								<p><?php echo $desc; ?></p>
							</div>

							<form action="" method="post" id="form">
								<div class="button_box">
									<!-- <input type="hidden" name="productID" value="<?php //echo $id; ?>">
									<input type="submit" name="addToCart" value="Add to Cart" /> -->
									<a href="shop.php?edit=<?php echo $id; ?>" style="width: 100%;">Edit</a>
									<a href="shop.php?delete=<?php echo $id; ?>" style="width: 100%;">Delete</a>
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

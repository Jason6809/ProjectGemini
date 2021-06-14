<?php
session_start();

if (!isset($_SESSION["userID"])) {
  require ("../includes/login_tools.php");
  load();
}
?>







<?php
$page_name = "stylist";
$page_title = "Edit Stylist - ADMIN";
require ("../connect_db.php");
include ("includes/header.php");
?>

<?php
require ("includes/edit_stylist.php");
?>


<div class="icon-box">
	<a href="">
		<span>&uarr;</span>
	</a>	
</div>







<!-- <form action="" method="post" enctype="multipart/form-data">
	<input type="file" name="fileToUpload" id="fileToUpload" />
	<input type="submit" name="submit" value="Upload Image" />
</form> -->

<form action="" method="post" enctype="multipart/form-data" id="form">
	<div class="container">
		<div class="content">
			<h1 class="heading">Stylist</h1>
			<div class="card">
				<div class="content">
					<label>Operation Description:</label>
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
				<div class="image" style="background-image: url('<?php echo "img/uploads/stylist/".$edit_img; ?>');" id="preview">
					<span>Preview</span>
				</div>

				<div class="content">

					<label style="color: red; align-self: flex-end;">*required field</label>

					<label class="left">ID</label>
					<input type="number" placeholder="ID, Auto Increment, Read Only" style="background-color: lightgray;" value="<?php echo $edit_id?>" readonly />

					<label>Name*</label>
					<input type="text" name="name" placeholder="Name" value="<?php echo $edit_name ?>" required />

					<hr>

					<label>IC NO*</label>
					<input type="text" name="ic" placeholder="IC NO" value="<?php echo $edit_ic; ?>" required />

					<label>Phone Number*</label>
					<input type="text" name="phoneNo" placeholder="010-1112222" value="<?php echo $edit_phoneNo; ?>" required />

					<hr>

					<label>School*</label>
					<input type="text" name="school" placeholder="School" value="<?php echo $edit_school; ?>" required />

					<label>Working Branch*</label>
					<select name="branch" required>
						<option>Select a Branch</option>
						<?php
						$get_branch_query = "SELECT * FROM branch";
						$get_branch = mysqli_query($connection, $get_branch_query);

						while ($row = mysqli_fetch_array($get_branch)) {
							$b_id   = $row["branch_id"];
							$b_name = $row["branch_name"];
							?>

							<option value="<?php echo $b_id; ?>" <?php if($edit_branch == $b_id){echo "selected";} ?> >
								<?php echo $b_id." - ".$b_name; ?>
							</option>

							<?php
						}
						?>

					</select>

					<label>Introduction*</label>
					<textarea name="intro" placeholder="Introduction" required><?php echo $edit_intro; ?></textarea>

					<!-- <label>Branch</label>
					<input type="" name="branch"> -->

					<label>Experience (Year)*</label>
					<input type="number" name="exp" placeholder="Year" value="<?php echo $edit_exp; ?>" required />

					<label>Fees (RM)*</label>
					<input type="number" name="fees" placeholder="RM 0.00" step=".01" value="<?php echo $edit_fees; ?>" required />

					<hr>

					<label>Start Working Date*</label>
					<input type="date" name="startDate" value="<?php echo $edit_startDate; ?>" required />					

					<label>Basic Salary (RM/Month)*</label>
					<input type="number" name="salary" placeholder="RM 0.00" step=".01" value="<?php echo $edit_salary; ?>" required />

					<hr>

					<label>Email*</label>
					<input type="email" name="email" placeholder="XXXXXX@stylist.com" value="<?php echo $edit_email; ?>" required />

					<label>Password*</label>
					<input type="text" name="password" mixlength="8" placeholder="Password" value="<?php echo $edit_password; ?>" required />

					<hr>

					<!-- <label>Other Detail</label>
					<textarea name="detail"></textarea> -->

					<label>Image*</label>
					<input type="file" name="fileToUpload" id="fileToUpload" onchange="previewImg()" />

					<div class="button_box">
						<input type="reset" onclick="location.href='stylist.php'" value="Clear" />
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
	</div>
</form>


<div class="parallax" style="background-image: url('../includes/img/parallax5.jpg');" id="stylist">
	<div class="container">
		<div class="row">
			<div class="col-l-12">
				<h1 class="heading">Stylist</h1>
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
						LEFT JOIN user ON `stylist`.stylist_id = `user`.stylist_id;
					 ";

			$result = mysqli_query($connection, $query);

			while ($row = mysqli_fetch_array($result)) {
				$id 	= $row["stylist_id"];
				$ic 	= $row["stylist_ic"];
				$name 	= $row["stylist_name"];
				$school = $row["stylist_school"];
				$exp 	= $row["stylist_exp"];
				$intro 	= $row["stylist_intro"];
				$branch = $row["branch_name"];
				$fees 	= $row["stylist_fees"];
				$img 	= $row["stylist_img"];

				$phoneNo   = $row["phone_no"];
				$startDate = $row["start_date"];
				$salary    = $row["salary"];
				$bookAccepted = $row["book_accepted"];

				$email = $row["email"];
				$password = $row["stylist_pass"];
			?>

			<div class="col-l-4 col-m-6 col-s-12" id="stylist_card">
				<div class="content center">
					<div class="card">
						<div class="image" style="background-image: url('<?php echo "img/uploads/stylist/".$img; ?>');"></div>
						<div class="content">
							<hr>

							<p>ID: <?php echo $id; ?></p>

							<hr>

							<h1 class="heading"><?php echo $name; ?></h1>

							<hr>

							<p>IC: <?php echo $ic; ?></p>
							<p>Phone Number:<br/><?php echo $phoneNo; ?></p>

							<hr>

							<p>School:<br/><?php echo $school; ?></p>
							<p>Working Branch:<br/><?php echo $branch; ?></p>
							<p>Booking Fees:<br/> RM <?php echo $fees?></p>
							<p>EXP: <?php echo $exp; ?> year(s)</p>

							<hr>

							<p>Start Working Date:<br/><?php echo $startDate; ?></p>
							<p>Book Accepted:<br/> <?php echo $bookAccepted; ?></p>
							<p>Salary:<br/> RM <?php echo $salary; ?></p>

							<hr>

							<p>Email:<br/><?php echo $email; ?></p>
							<p>Password:<br/><?php echo $password; ?></p>

							<hr>

							<p>INTRO:<br/><?php echo $intro; ?></p>

							<hr>
							<a href="stylist.php?edit=<?php echo $id; ?>">Edit</a>
							<br/>
							<a href="stylist.php?delete=<?php echo $id; ?>">Delete</a>
							<br/>
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
include ("../includes/footer.php");
?>

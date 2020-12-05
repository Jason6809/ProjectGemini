<?php
session_start();

if (!isset($_SESSION["userID"])) {
	require ("../includes/login_tools.php");
	load();
}

$page_name = "home";
$page_title = "Home - ADMIN";
require ('../connect_db.php');
include ('includes/header.html');
?>



<div class="icon-box">
	<a href="">
		<span>&uarr;</span>
	</a>	
</div>




<div class="parallax fill"  style="background-image: url('../includes/img/parallax.jpg');">
	<div class="container center">
		<div class="banner">
			<img src="../includes/img/logo_wh.png" />
			<h1 class="">
				Welcome Admin<br/>
			</h1>
		</div>
	</div>
</div>














<div class="parallax fill" style="background-image: url('../includes/img/parallax2.jpg');" id="carousel_news"> 
	<div class="container full">

		<div class="carousel">
			<div class="leftarrow">
				<a onclick="changeContent(-1)"><</a>
			</div>

			<div class="content" id="content">
				<a href="news.php"><h1 class="heading">News</h1></a>

				<?php
				$query = "SELECT * FROM news ORDER BY news_date DESC LIMIT 5";
				$result = mysqli_query($connection, $query);

				while ($row = mysqli_fetch_array($result)) {						
					$img 	 = $row["img_name"];
					$title 	 = $row["news_title"];
					$date 	 = $row["news_date"];
					$content = $row["news_content"];
					?>

					<div class="carousel card">
						<div class="image" style="background-image: url('<?php echo "img/uploads/news/".$img; ?>');"></div>								
						<div class="content">
							<h1 class="heading"><?php echo $title; ?></h1>
							<p style="font-size: 1em;"><?php echo $date; ?></p>
							<p class="paragraph"><?php echo $content; ?></p>
							<a class="right" href="news.php">Learn More</a>
						</div>								
					</div>

					<?php
				}
				?>
			</div>
			<div class="rightarrow">
				<a onclick="changeContent(1)">></a>
			</div>

			<div class="carousel-indicator" id="indicator" >
				<?php
				$numberOfRows = mysqli_num_rows($result);
				for ($i=0; $i < $numberOfRows; $i++) {								
					?>

					<span class="indicator" onclick="currentContent(<?php echo $i+1; ?>)"></span>

					<?php
				}						
				?>
			</div>
		</div>
	</div>
</div>














<!--special content for small screen device-->
<div class="parallax" style="background-image: url('../includes/img/parallax2.jpg');"  id="news">
	<div class="container">
		<div class="content">
			<h1 class="heading">News</h1>

			<?php
			$query = "SELECT * FROM news ORDER BY news_id DESC LIMIT 5";
			$result = mysqli_query($connection, $query);

			while ($row = mysqli_fetch_array($result)) {						
				$img 	 = $row["img_name"];
				$title 	 = $row["news_title"];
				$content = $row["news_content"];
				?>

				<div class="card">
					<div class="image" style="background-image: url('<?php echo "img/uploads/news/".$img; ?>');"></div>								
					<div class="content">
						<h1 class="heading"><?php echo $title; ?></h1>
						<p><?php echo $content; ?></p>
						<a class="right" href="news.php">Learn More</a>
					</div>								
				</div>

				<?php
			}
			?>
		</div>
	</div>
</div>













<div class="parallax" style="background-image: url('../includes/img/parallax3.jpg');" id="user_service">
	<div class="container">
		<div class="row">
			<div class="col-l-6 col-m-6 col-s-12">
				<h1 class="heading">Online Shopping</h1>
				<div class="card" id="shop">					
					<div class="content center">
						<p>Sign Up Now and Shop Our Genuine Exclusive Products</p>
						<a class="" href="useraccess.php">SHOP NOW</a>
					</div>
				</div>
			</div>

			<div class="col-l-6 col-m-6 col-s-12">
				<h1 class="heading">Online Booking</h1>
				<div class="card" id="book">					
					<div class="content center">
						<p>Sign Up Now and Book Your Favorite Stylists Instantaneously</p>
						<a class="" href="useraccess.php">BOOK NOW</a>
					</div>				
				</div>
			</div>
		</div>
	</div>
</div>












<div class="parallax" style="background-image: url('../includes/img/parallax4.jpg'); " id="service">
	<div class="container">
		<div class="row">
			<div class="col-l-12 col-m-12 col-s-12">
				<div class="content">
					<h1 class="heading">Services - Our Proud Partner</h1>
					<div class="card">
						<div class="image" style="background-image: url('../includes/img/shiseido.jpg');"></div>

						<div class="content">
							<h1 class="heading">Shiseido Professional</h1>
							<p>
								Shiseido for professionals.<br/><br/>

								Shiseido Professional is a brand catering exclusively to hair salons.<br/><br/>

								To allow salon professionals to maximize their freedom of performance and satisfaction, Shiseido Professional develops premium-spec products infused with state-of-the-art technology.<br/><br/>

								While rooted firmly in Shiseido's OMOTENASHI, the traditional spirit of hospitality, Shiseido Professional makes a commitment to offer top-level techniques and service menus that support all aspects of salon work and business success.<br/><br/>

								Progressing hand-in-hand with the world's leading salons. Shiseido Professional.<br/><br/>
							</p>
						</div>
					</div>

					<div class="card">
						<div class="image" style="background-image: url('../includes/img/loreal.jpg');"></div>

						<div class="content">
							<h1 class="heading">L'Oréal Paris</h1>
							<p>
								The L'Oréal Paris Brand Division of L’Oréal USA, Inc. is a total beauty care company that combines the latest in technology with the highest in quality for the ultimate in luxury beauty at mass.<br/><br/>

								L'Oréal Paris is a truly global beauty brand with many internationally renowned products. For most, the name “L'Oréal” is immediately evocative of the brand’s signature phrase, "Because I'm Worth It.”— the concept behind the legendary advertising campaign for the Superior Preference® hair color launch in 1973. Today, it represents the essence of the L'Oréal Paris brand as a whole, a spirit which is about helping every woman embrace her unique beauty while reinforcing her innate sense of self-worth.<br/><br/>

								As the biggest beauty brand in the world, L'Oréal Paris has an unparalleled commitment to technology, research and innovation, providing groundbreaking, high-quality products for women, men, and children of all ages and ethnicities. L'Oréal Paris is notably dedicated to celebrating the diversity of beauty – the company’s broad range of spokespeople include Andie MacDowell, Diane Keaton, Jennifer Lopez, Julianna Margulies, Eva Longoria, Doutzen Kroes, Julianne Moore, and Karlie Kloss.<br/><br/>

								The L’Oréal Paris brand encompasses the four major beauty categories – hair color, cosmetics, hair care, and skin care – and includes such well-known brands as Superior Preference®, Excellence and Couleur Experte® hair colors; EverPure, EverStrong, EverSleek, EverCreme and EverStyle; skin care brands including Revitalift®, Youth Code, Age Perfect®, Men’s Expert, Sublime Sun and L'Oréal Paris Cosmetics, including Colour Riche®, True Match™ and Studio Secrets™ Professional collections, Voluminous®, Double Extend®, Telescopic® mascaras, among many others.<br/><br/>
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>










<div class="parallax" style="background-image: url('../includes/img/parallax5.jpg');" id="stylist">
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
						ORDER BY RAND()
						LIMIT 6
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
						<div class="image" style="background-image: url('<?php echo "img/uploads/stylist/".$img; ?>');"></div>								
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










<div class="parallax" style="background-image: url('../includes/img/parallax6.jpg');" id="location">
		<div class="container">			
			<div class="row">
				<div class="col-1-12">
					<h1 class="heading">Location</h1>
				</div>
			</div>

			<div class="row">	

				<?php
				$query = "SELECT * FROM branch ORDER BY RAND() LIMIT 4";
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
							<div class="image" style="background-image: url('<?php echo "img/uploads/location/".$img; ?>');"></div>								
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










<div class="parallax" style="background-image: url('../includes/img/parallax7.jpg');" id="gallery">
	<div class="container">
		<div class="row">
			<div class="col-l-12">
				<div class="content">
					<h1 class="heading">Gallery</h1>
				</div>
			</div>
		</div>


		<div class="img_row">
			<div class="img_column">

				<?php
				$count = 1;
				$query = "SELECT * FROM gallery ORDER BY gallery_id DESC LIMIT 12";
				$result = mysqli_query($connection, $query);

				while ($row = mysqli_fetch_array($result)) {
					$id = $row["gallery_id"];
					$img = $row["img_name"];

					

					if ($count <  3) {							
						?>

				<div class="card" style="margin:0; box-shadow: none; background-color: transparent;">
					<div class="content" style="background-color: transparent;">
						
							<img style="box-shadow: 5px 5px 2px rgba(0,0,0,0.5);" id="<?php echo 'imageToModal'.$id; ?>" onclick="openModal(<?php echo $id; ?>)" src="<?php echo "img/uploads/gallery/".$img; ?>">
						
					</div>
				</div>

						<?php
						$count++;
					} else {
						
					?>

				<div class="card" style="margin:0; box-shadow: none; background-color: transparent;">
					<div class="content" style="background-color: transparent;">
						
							<img style="box-shadow: 5px 5px 2px rgba(0,0,0,0.5);" id="<?php echo 'imageToModal'.$id; ?>" onclick="openModal(<?php echo $id; ?>)" src="<?php echo "img/uploads/gallery/".$img; ?>">
						
					</div>
				</div>
			</div>			
			<div class="img_column">

					<?php
					$count = 1;
					}						
				}
				?>

			</div>
		</div>
	</div>
</div>

<div class="modal" id="modal">
	<a id="closeBtn">X</a>
	<img class="content" id="imageInModal" />
</div>



<?php
include ("../includes/footer.html");
?>
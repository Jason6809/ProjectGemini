<?php
$page_name = "career";
$page_title = "Career - GEMINI";
require ("connect_db.php");
include ("includes/header.php");
?>

<style type="text/css">
	p {
		color: white;
	}

	li {
		color: white;
	}

	.card {

	}

	.card .content {
		background-color: black;
		margin: 15px 0px;
		box-shadow: 5px 5px 2px rgba(0,0,0,0.5);
	}
</style>

<div class="parallax" style="background-image: url('includes/img/parallax.jpg');">
	<div class="container" style="padding-top: 10em;">
		<div class="row">
			<div class="col-l-12 col-m-12 col-s-12">
				<div class="content">
					<h1 class="heading">Career</h1>
				</div>

				<div class="content">
					<div class="card">
						<div class="content">
							<h1 class="heading">Expand Our Business</h1>
							<p>
								We are searching partners for expanding our business together. Join our powerful team now and earn together. We have,
								<ul>
									<li>Ambitious leaders.</li>
									<li>United and cooperative management.</li>
									<li>Creative and hardworking stylist.</li>
									<li>Fashion leaders.</li>
									<li>Up to date technologies.</li>
								</ul>
							</p>
							<p>
								Feel free to chat to us for detail at our headquarter in Mid Valley.
							</p>
						</div>
					</div>

					
					<div class="card">
						<div class="content">					
							<h1 class="heading">Become Our Stylist</h1>
							<p>
								Interested to become one of ours professional team? Don't hesitate to join us now. We wanted you so much! We provide you undeniable benefits,
								<ul>
									<li>Attractive salary package</li>
									<li>Cross-cultural working environment & experience</li>
									<li>On-the-job training provided</li>
									<li>Staff bonding time</li>
									<li>Career growth Opportunities</li>
									<li>Japanese hospitality service standard</li>
									<li>Latest fashion & hair trends from Japan</li>
								</ul>
							</p>
							<p>
								Feel free to submit your resume to "gemini_salon@mail.com".
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<?php
include ("includes/footer.php");
?>
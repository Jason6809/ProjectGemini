<?php
$page_name = "news";
$page_title = "News - GEMINI";

require ("connect_db.php");
include ("includes/header.html");
?>


<style type="text/css">
	#news {
		padding-top: 7em;
	}
</style>

<div class="parallax" style="background-image: url('includes/img/parallax2.jpg'); display: block;"  id="news">
	<div class="container">
		<div class="content">
			<h1 class="heading">News</h1>

			<?php
			$query = "SELECT * FROM news ORDER BY news_date DESC";
			$result = mysqli_query($connection, $query);

			while ($row = mysqli_fetch_array($result)) {						
				$img 	 = $row["img_name"];
				$title 	 = $row["news_title"];
				$content = $row["news_content"];
				?>

				<div class="card">
					<div class="image" style="background-image: url('<?php echo "admin/img/uploads/news/".$img; ?>');"></div>								
					<div class="content">
						<h1 class="heading"><?php echo $title; ?></h1>
						<p><?php echo $content; ?></p>
					</div>								
				</div>

				<?php
			}
			?>
		</div>
	</div>
</div>



<?php
include ("includes/footer.html");
?>

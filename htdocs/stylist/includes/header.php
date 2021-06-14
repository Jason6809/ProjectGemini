<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<meta http-equiv="Content-type" content="text/html; charset=UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title><?php echo $page_title; ?></title>
	<link rel="icon" type="image/png" href="../includes/img/tab_logo.png" sizes="32x32" />
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet" />
	<link rel="stylesheet" type="text/css" href="../includes/css/style.css" />	
	<style type="text/css">
	</style>
</head>
<body>

	<div class="navbar" id="navbar">
		<div class="logo">
			<div class="row">
				<div class="col-l-4 col-m-6 col-s-9">
					<a href="index.php">
						<img src="../includes/img/logo.png" />
					</a>
				</div>


				<div class="col-l-8 col-m-6 col-s-3">
					<div class="navlink right">						
						<a href="../includes/logout.php"><span></span>LOG OUT</a>

						<style type="text/css">
						/*for php*/
						.navlink .active {
							background-color: transparent;
						}
						</style>
					</div>
				</div>
			</div>
		</div>

		<div class="subnav center" id="subnav">			
			<a <?php echo ($page_name == "book") ? "class='active'" : "" ; ?> href="book.php">Book</a>

			<style type="text/css">
			/*for php*/
			.subnav .active {
				border-bottom: 3px solid black;
			}
			#subnav.small .active {
				border-bottom: 3px solid white;
			}
			</style>
		</div>
	</div>

	<div class="smallnav">
		<div class="logo">
			<div class="row">
				<div class="col-m-6 col-s-6">
					<a href="index.php"><img src="../includes/img/logo_sm.png"></a>
				</div>
			

				<div class="col-m-6 col-s-6">
					<div class="navlink right">
						<a class="material-icons" onclick="toggleSidenav()" id="sidenavToggle">menu</a>

						<style type="text/css">
							#sidenavToggle.active {
								color: white;
								background-color: black;
							}
						</style>
					</div>
				</div>
			</div>
		</div>

		<div class="sidenav " id="sidenav">			
			<a <?php echo ($page_name == "book") ? "class='active'" : "" ; ?> href="book.php">Book</a>
			<a href="../includes/logout.php"><span></span>LOG OUT</a>

			<style type="text/css">
			/*for php*/
			.sidenav a.active {
				color: white;
				background-color: black;
			}
			</style>		
		</div>
	</div>

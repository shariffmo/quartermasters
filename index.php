<!-- HOME PAGE-->
<?php
session_start();
include ('connection.php'); 
?>


<html>
	<head>
	<script src="slideshow.js"></script> 
	<link rel="stylesheet" type="text/css" href="QMDB_01.css">
	<link rel="stylesheet" type="text/css" href="slideshowstyles.css">
		<title>QM Homepage</title>
		<header>
		<div id="header">
			<img id="headerImage" src="pictures/header.jpg" alt="2806 Logo" >

			<div id="navbar">
				<ul style="list-style-type:none;margin:0;padding:0;">
					<li><a href="index.php">HOME</a></li>
					<li><a href="equipment.php">EQUIPMENT</a></li>
					

					<div id="rightmostElements">
					<?php
						if(isset($_SESSION['userLogged'])){
							print('	<li><a href="cart.php"><img id="cartlogo" src="pictures/cartlogo.png"/></a></li>
							<li><a href="myaccount.php">MY ACCOUNT</a></li>
							<li><a href="logout.php">SIGN OUT</a></li>');
						}
						else{
							print('	<li><a href="cart.php"><img id="cartlogo" src="pictures/cartlogo.png"/></a></li>
							<li><a href="login.php">MY ACCOUNT</a></li>');
						}
					?>
					</div>
				</ul>
			</div>
		</div>
		</header>
	</head>
	<body>
		<div id="welcomeMessage">
			<p>Welcome to the Quartermaster's online warehouse</p>
			<p>We offer a variety of different army wear. Scroll through to find what fits you best. </P>
		</div>
		 <div id="slideShow">

			<img src="pictures/equipmentPictures/img1.jpg" id="image" >
			<div class="left_holder"><img onClick="photo(-1)" class="leftArrow" src="pictures/arrow_left.png"></div>
			<div class="right_holder"><img onClick="photo(1)" class="rightArrow" src="pictures/arrow_right.png"></div>
  
		</div>
	</body>
	<footer id="footer">
		<p>For more information contact us:</p>
		<P>- By TEL: 978-9596-0596 - By Email: quartermasters@mail.com</p>
	</footer>
</html>
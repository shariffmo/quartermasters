<!-- HOME PAGE-->
<?php
session_start();
include ('connection.php'); 
include('display_equipment_statements.php');
$equipmentDisplayer = new Equipment($DBH);

if(!isset($_SESSION['userLogged'])){
	header("Location: login.php");
}
$id = $_COOKIE['anonId'];
?>


<html>
	<head>
	<script src="slideshow.js"></script> 
	<link rel="stylesheet" type="text/css" href="QMDB_01.css">
	<link rel="stylesheet" type="text/css" href="orderTable.css">
		<title>QM Homepage</title>
		<header>
		<div id="header">
			<img id="headerImage" src="pictures/header.jpg" alt="2806 Logo" >

			<div id="navbar">
				<ul style="list-style-type:none;margin:0;padding:0;">
					<li><a href="index.php">HOME</a></li>
					<li><a href="equipment.php">EQUIPMENT</a></li>
				

					<div id="rightmostElements">
						<li><a href="cart.php"><img id="cartlogo" src="pictures/cartlogo.png"></a></li>
						<li><a href="myaccount.php">MY ACCOUNT</a></li>
						<li><a href="logout.php">SIGN OUT</a></li>
					</div>
				</ul>
			</div>
		</div>
		</header>
	</head>
	<body id="main ">
			<span id="personalInfo">Order Details</span>
			<div id="orders">
				<?php
					$equipmentDisplayer->orderDetail($_SESSION['currentOrder']);
					unset($_SESSION['currentOrder']);
				?>
			</div>
	</body>
	<footer id="footer">
		<p>For more information contact us:</p>
		<P>- By TEL: 978-9596-0596 - By Email: quartermasters@mail.com</p>
	</footer>
</html>
<!-- HOME PAGE-->
<?php
session_start();
include ('connection.php'); 
include('display_equipment_statements.php');
$equipmentDisplayer = new Equipment($DBH);

if(isset($_POST['removeProduct']) && !empty($_POST['quantityToRemove'])){
	$equipmentDisplayer->removeItemFromCart($_POST['removeProduct'], $_POST['quantityToRemove']);
}
?>


<html>
	<head>
	<script src="slideshow.js"></script> 
	<link rel="stylesheet" type="text/css" href="QMDB_01.css">
	<link rel="stylesheet" type="text/css" href="cart.css">
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
		<div id="scroll">
		<?php
			$total = $equipmentDisplayer->displayCart();
			echo '</div>
				<div id="links">
					<label id="total">TOTAL: $'.$total.'</label>
					<label><a id="checkout" href="checkout.php">checkout</a></label>
					</div>';
		
		?>
	
	</footer>
</html>
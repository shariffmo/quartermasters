
<!-- MESSAGES REPLY -->
<html>


	<head>
	<script src="slideshow.js"></script> 
	<link rel="stylesheet" type="text/css" href="QMDB_01.css">
	<link rel="stylesheet" type="text/css" href="account.css">
	<link rel="stylesheet" type="text/css" href="orderTable.css">
		<title>SEND A MESSAGE</title>
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
						<li><a href="QMDB_PROFILE_MESSAGES.php">MESSAGES</a></li>
					<li><a href="QMDB_MEASUREMENTS.php">MEASUREMENTS</a></li>
					<li><a href="QMDB_CHANGE_PASSWORD.php">CHANGE PASSWORD</a></li>
						<li><a href="logout.php">SIGN OUT</a></li>
					</div>
				</ul>
			</div>
		</div>
		</header>
	</head>
<form action="" method="post">
<?php include ('QMDB_MESSAGES_REPLY_02.php'); ?>

	<label><b><i>Create Message</i></b></label>
	<br/>
	<label>TO: </label>
	<input id="recepient" name="recepient" type="text" >
	<br/>
	
	<label>MESSAGE :</label>
	<br/>
	<textarea id="message" name="message" rows="15" cols="70"></textarea>
	<br/>
	<input name="send" type="submit" value=" SEND ">
	<input name="back" type="submit" value=" BACK ">
</form>

	</html>
<!--QMDB_MEASUREMENT_EDIT.php-->

<?php
include ('connection.php'); 

session_start();
//getting current user name

$ussername = $_SESSION["userLogged"];
$id = $_POST['measurement_id'];
echo "$id";
//getting user contact id

if(isset($_POST["saveChanges"]))
{
	$measurement_id = $_POST['measurement_idEdit'];
	if(!empty($_POST["headSize"]) || !empty($_POST["neckSize"]) 
		|| !empty($_POST["chestSize"]) || !empty($_POST["waistSize"]) 
	|| !empty($_POST["hipSize"]) || !empty($_POST["shoeSize"]) 
	|| !empty($_POST["height"]) || !empty($_POST["handSize"]))
	{
			$headSize = $_POST["headSize"];
			$neckSize = $_POST["neckSize"];
			$chestSize = $_POST["chestSize"];	
			$waistSize = $_POST["waistSize"];
			$hipSize = $_POST["hipSize"];
			$shoeSize = $_POST["shoeSize"];
			$height = $_POST["height"];
			$handSize = $_POST["handSize"];
			$date = date('Y-m-d');
			
		$STH = $DBH->prepare("UPDATE  measurement SET
		 user_height='$height', user_shoeSize='$shoeSize',user_handSize='$headSize',user_headSize='$handSize',user_neckSize='$neckSize',user_chestSize='$chestSize',user_waistSize='$waistSize', user_hipSize='$hipSize',date_measured='$date' WHERE measurement_id='$measurement_id'");
			
			$STH-> execute();
			
	}
	

}
if(isset($_POST["back"]))
	{
		header('Location:QMDB_MEASUREMENTS.php'); 
	}

?>
<!-- MESSAGES REPLY -->
<html>
<head>
	<script src="slideshow.js"></script> 
	<link rel="stylesheet" type="text/css" href="QMDB_01.css">
	<link rel="stylesheet" type="text/css" href="account.css">
	<link rel="stylesheet" type="text/css" href="orderTable.css">
		<title>EDIT MEASUREMENTS</title>
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
	
	<br/><label>Head Size:</label>
			<br/>
			<input id="headSize" name="headSize" type="text">
			<br/>
			<label>Neck Size:</label>
			<br/>
			<input id="neckSize" name="neckSize" type="text">
			<br/>
			<label>Chest Size</label>
			<br/>
			<input id="chestSize" name="chestSize" type="text">
			<br/>
			<label>Waist Size:</label>
			<br/>
			<input id="waistSize" name="waistSize" type="text">
			<br/>
			<label>Hip Size:</label>
			<br/>
			<input id="hipSize" name="hipSize" type="text">
			<br/>
			<label>Shoe Size:</label>
			<br/>
			<input id="shoeSize" name="shoeSize" type="text">
			<br/>
			<label>Height:</label>
			<br/>
			<input id="heigh" name="height" type="text">
			<br/>
			<label>Hand Size:</label>
			<br/>
			<input id="handSize" name="handSize" type="text">
			<br/>
			<br/>
	 <input type="hidden" name="measurement_idEdit" value="<?= $_POST['measurement_id']?>">	
	<input name="saveChanges" type="submit" value=" SAVE CHANGES ">
	<input name="back" type="submit" value=" BACK ">
</form>

	</html>

	
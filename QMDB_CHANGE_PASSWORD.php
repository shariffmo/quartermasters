<!-- QMDB_CHANGE_PASSWORD.php -->
<?php
include ('connection.php'); 
session_start();
$user_id = $_SESSION["user_id"] ;
if(isset($_POST["submit"]))
{
	if(!empty($_POST["cpass"] || !empty($_POST["npassword"])))
	{

		$cpass = $_POST["cpass"];
		$npass = $_POST["npassword"];
		$statement ="SELECT password FROM users WHERE user_id='$user_id'";

		//getting corresponding row from database
		$stmt = $DBH->prepare($statement);
		$stmt->execute();
		$result = $stmt;
		foreach($result as $row)
		{
   			
   			$vpass = $row['password'];
   			
		}
		//verifing password
		if($cpass == $vpass)
		{
		$statement="UPDATE users SET password = '$npass' WHERE user_id = '$user_id'";
		//getting corresponding row from database
		$stmt = $DBH->prepare($statement);
		$stmt->execute();
		
		
			
		}else{
			echo "<br>Enter Correct Login Information<br>";
		}
	}
}

?>

<html>
<head>
	<script src="slideshow.js"></script> 
	<link rel="stylesheet" type="text/css" href="QMDB_01.css">
	<link rel="stylesheet" type="text/css" href="account.css">
	<link rel="stylesheet" type="text/css" href="orderTable.css">
		<title>Change Password</title>
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
<form action="" method="post" style="text-align:center;">
			<label>Current Password :</label>
			<br/>
			<input id="cpass" name="cpass" type="password">
			<br/>
			<br/>
			<label>New Password :</label>
			<br/>
			<input id="npassword" name="npassword" type="password">
			<br/>
			<br/>
			<input name="submit" type="submit" value=" Reset Password ">
			
		</form>
	</div>
	</html>
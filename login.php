<!-- HOME PAGE-->
<?php
session_start();
include ('connection.php'); 
include('display_equipment_statements.php');
$equipmentDisplayer = new Equipment($DBH);

if(isset($_SESSION['userLogged'])){
	header("Location: myaccount.php");
}

if(isset($_POST['submit'])){
	$userId = 0;
	if(isset($_COOKIE['anonId'])){
		$userId = $equipmentDisplayer->login($_POST['username'], $_POST['password'], $_COOKIE['anonId']);
	}
	else{
		$userId = $equipmentDisplayer->login($_POST['username'], $_POST['password'], "");
	}
	$ussername = $_POST['username'];

	if($userId != 0 ){
		if($ussername == "Admin"){
		header("Location: QMDB_ADMIN.php");
		}else{
		$_SESSION['userLogged'] = $userId;
		header("Location: myaccount.php");
		//header('Location: QMDB_PROFILE.php');
	}
	}
}
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
							print('	<li><a href="cart.php"><img id="cartlogo" src="pictures/cartlogo.png"></a></li>
							<li><a href="myaccount.php">MY ACCOUNT</a></li>
							<li><a href="logout.php">SIGN OUT</a></li>');
						}
						else{
							print('	<li><a href="cart.php"><img id="cartlogo" src="pictures/cartlogo.png"></a></li>
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
		<div id="log_in">
		
		<form action="" method="post" style="text-align:center;">
			<label>User Name :</label>
			<br/>
			<input id="name" name="username"  required="required" type="text">
			<br/>
			<br/>
			<label>Password :</label>
			<br/>
			<input id="password" name="password" required="required" type="password">
			<br/>
			<br/>
			<input name="submit" type="submit" value=" Login ">
			<br/>
			<br/>
			<label> <a href="registeration.php">Not registered?</a></label>
		</form>
	</div>
	</body>
	<footer id="footer">
		<p>For more information contact us:</p>
		<P>- By TEL: 978-9596-0596 - By Email: quartermasters@mail.com</p>
	</footer>
</html>
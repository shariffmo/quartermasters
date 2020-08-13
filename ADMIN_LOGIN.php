<!-- HOME PAGE-->
<?php
session_start();
include ('connection.php'); 
$error = "";
if(isset($_POST['submit'])){
	$loginValue = "";
	
	
if($_POST['username'] == "Admin" && $_POST['password'] == "Admin123"){
		$loginValue = 2;
	}
	else{
		$loginValue = -1;
	}
	
	if($loginValue == 2){
		$_SESSION['adminLogged'] = $loginValue;
		header("Location: QMDB_ADMIN.php");
	}
	else{
		$error = "*Login failed";
	}
}	
?>


<html>
	<head>
	<script src="slideshow.js"></script> 
	<link rel="stylesheet" type="text/css" href="QMDB_01.css">

		<title>QM Homepage</title>
		<header>
		<img id="headerImage" src="header.jpg" alt="2806 Logo" >
		<div style="background-color: #0D8FBA; width: 100%; height:20%; display:block; text-align:center; font-size: 30px; margin-bottom: 50px;font-weight: bold; color: #000000;"/>
			<img id="headerImage" src="adminIcon.png" alt="2806 Logo" style="width: 12.5%; height: 100%;"/> 
		</div>
		</header>
		
	</head>
	<body>
		<div id="log_in">
		<br/>
		<form action="" method="post" style="text-align:center;">
			<label>User Name</label>
			<br/>
			<input id="name" name="username" required="required" type="text"> 
			<br/><br/>	
			<label>Password</label>
			<br/>
			<input id="password" name="password" required="required" type="password">
			<br/>
			<input name="submit" type="submit" value="Login">
			<br/><br/>
			<label> <a href="registeration.php">Not registered?</a> </label><br/><br/>
            <label> <a href="index.php">Back to main page</a></label>
			<br/><br/><span style="color: #FC0A0A;"><?php echo "$error"; ?></span>
		</form>
	</div>
	</body>
	<br/>
	<footer id="footer">
		<p>For more information contact us:</p>
		<P>- By TEL: 978-9596-0596 - By Email: quartermasters@mail.com</p>
	</footer>
</html>
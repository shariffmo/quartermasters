<!-- PROFILE PAGE -->
<?php
	session_start();
	if(!(isset($_SESSION['adminLogged'])))
    {
		header("Location: admin_login.php");
	}
?>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="QMDB_01.css">
</head>
    
<body>
    <header>
            <img id="headerImage" src="header.jpg" alt="2806 Logo" >
		<div id="header">
			<div id="navbar">
				<ul style="list-style-type:none;margin:0;padding:0;">
					<li><a href="qmdb_admin.php">HOME</a></li>
					<li><a href="QMDB_INVENTORY.php">INVENTORY</a></li>
					<li><a href="QMDB_ALL_ACCOUNTS.php">ACTIVE ACCOUNTS</a></li>
					<li><a href="ADMIN_ALL_ORDERS.php">ORDERS</a></li>
					<div id="rightmostElements">
					<li><a href="ADMIN_PROFILE.php">YOUR ACCOUNT</a></li>
					<li><a href="logout2.php">LOGOUT</a></li>
					</div>
				</ul>
			</div>
		</div>
   </header>
	</head>
<form action="" method="post">
<?php include ('adminReply2.php'); ?>

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
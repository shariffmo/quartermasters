<!-- ADMIN PAGE -->
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
	<title>ADMIN</title>
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
		
		<center>
		   <h1>Welcome ADMIN!!!</h1>
		</center>
    
    <footer id="footer">

	</footer>
</body>
</html>
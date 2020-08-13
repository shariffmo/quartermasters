<!-- PROFILE PAGE -->

<html>
<head>
	<link rel="stylesheet" type="text/css" href="QMDB_01.css">
	<title>PROFILE</title>
	<header>
		<div id="header">
			<div id="navbar">
				<ul style="list-style-type:none;margin:0;padding:0;">
					<li><img src="logo.png" alt="2806 Logo" ></li>
					<li><a href="QMDB_PROFILE.php">HOME</a></li>
					<li><a href="QMDB_PROFILE_MESSAGES.php">MESSAGES</a></li>
					<li><a href="QMDB_MEASUREMENTS.php">MEASUREMENTS</a></li>
					<li><a href="QMDB_CHANGE_PASSWORD.php">CHANGE PASSWORD</a></li>
					<li><a href="QMDB_LOGOUT.php">LOG OUT</a></li>
				</ul>
			</div>
		</div>
		</header>
</head>
<body>
<?php include 'QMDB_PROFILE_02.php';?>
	<label>Hello, <?php echo $rank." ".$lname ?> </label>
	<br/><br/>
	<label>Here is your info :</label>
	<br/><br/>
	<form action="" method="post">
			<br/>
			<label>Name :</label>
			<br/>
			<input id="fname" name="fname" type="text" value="<?php echo $fname?>">
			<br/>
			<br/>
			<label>Last Name :</label>
			<br/>
			<input id="lname" name="lname" type="text" value="<?php echo $lname?>">
			<br/>
			<br/>
			<label>Rank :</label>
			<br/>
			<input id="rank" name="rank" type="text" value="<?php echo $rank?>">
			<br/>
			<br/>
			<label>Date of birth :</label>
			<br/>
			<input id="DOB" name="DOB" type="date" value="<?php echo $DOB?>">
			<br/>
			<br/>
			<label>Gender :</label>
			<br/>
			<input id="gender" name="gender" type="text" value="<?php echo $gender?>">
			<br/>
			<br/>
			<label>Address :</label>
			<br/>
			<input id="address" name="address" type="text" value="<?php echo $address?>">
			<br/>
			<br/>
			<label>City :</label>
			<br/>
			<input id="city" name="city" type="text" value="<?php echo $city?>">
			<br/>
			<br/>
			<label>Country :</label>
			<br/>
			<input id="country" name="country" type="text" value="<?php echo $country?>">
			<br/>
			<br/>
			<label>Postal Code :</label>
			<br/>
			<input id="postalCode" name="postalCode" type="text" value="<?php echo $postalCode?>">
			<br/>
			<br/>
			<input name="submit" type="submit" value="Save Changes">
			<br/>
			<br/>
			
		</form>
	
	
</body>
</html>
<!-- HOME PAGE-->
<?php
session_start();
include ('connection.php'); 
include('display_equipment_statements.php');
$equipmentDisplayer = new Equipment($DBH);

if(isset($_SESSION['userLogged'])){
	header("Location: myaccount.php");
}
$registrationErr = "";
$username = $password = $fname = $lname = $dob = $email = "";
$usernameErr = $passwordErr = $fnameErr = $lnameErr = $dobErr = $emailErr = "";
if(isset($_POST['registerUser'])){
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		if (empty($_POST["username"])) {
			$usernameErr = "* Username is required";
		} else {
			if($equipmentDisplayer->test_input("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/", $_POST["username"]) && $equipmentDisplayer->test_input("/^.{8,30}$/", $_POST['username']))
			{
				$username = $_POST['username'];		
			}
			else if(!$equipmentDisplayer->test_input("/^.{8,30}$/", $_POST['username'])){
				$usernameErr = "* Username length must be within 8-30 characters. ";
			}
			else{
				$usernameErr = "* Username must contain 1 lowercase, 1 uppercase and 1 digit";
			}
		}
		if(empty($_POST["fname"])){
			$fnameErr = "* First name is required";
		}
		else{
			if($equipmentDisplayer->test_input("/^[a-zA-Z]+$/", $_POST["fname"]))
			{
				$fname = $_POST['fname'];		
			}
			else{
				$fnameErr = "* Please enter a valid first name";
			}
		}
		if(empty($_POST["lname"])){
			$lnameErr = "* Last name is required";
		}
		else{
			if($equipmentDisplayer->test_input("/^[a-zA-Z]+$/", $_POST["lname"]))
			{
				$lname = $_POST['lname'];		
			}
			else{
				$lnameErr = "* Please enter a valid Last name";
			}
		}	

		if(isset($_POST['month']) && isset($_POST['day']) && isset($_POST['year'])){
			$dob = $_POST['month']."/".$_POST['day']."/".$_POST['year'];
		}
		else{
			$dobErr = "Please select a date";
		}

		if($equipmentDisplayer->test_input("/^\S+@\S+$/", $_POST['email'])){
			$email = $_POST['email'];
		}
		else{
			$emailErr = "Please enter a valid email address";
		}
		
		if($_POST['password'] != ""){
			$password = $_POST['password'];
		}
		else{
			$passwordErr = "Please choose a password";
		}

			
		if($username != "" && $fname != "" && $lname != "" && $dob != "" && $email != ""){
			$registrationResult = $equipmentDisplayer->registerUser($username, $password, $fname, $lname, $dob,$_POST['gender'], $email);
			
			if($registrationResult){
				$userId = 0;
				if(isset($_COOKIE['anon_id'])){
					$userId = $equipmentDisplayer->login($username, $password,$_COOKIE['anon_id']);
				}
				else{
					$userId = $equipmentDisplayer->login($username, $password, "");
				}
				if($userId != 0){
					$_SESSION['userLogged'] = $userId;
					header("Location: myaccount.php");
				}
			}
			else{
				$registrationErr = "* Username is already taken!";
			}
		}			
	}	
}
?>


<html>
	<head>
	<script src="slideshow.js"></script> 
	<link rel="stylesheet" type="text/css" href="QMDB_01.css">
	<link rel="stylesheet" type="text/css" href="registeration.css">
	<link rel="stylesheet" type="text/css" href="errors.css">
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
						if(isset($_SESSION['user_logged'])){
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
		<div id="formDiv">
		<form id="registerationForm" action="" method="post">
			<label>Username: </label> <input type="text" name="username" required="required"/><label class="error"><?php echo $usernameErr;?></label><span style="color: #FF0022;"><?php echo "$registrationErr";?> </span>
			<label>Password: </label> <input type="password" name="password" required="required"/><label class="error"><?php echo $passwordErr;?></label>
			<label>First Name: </label> <input type="text" name="fname" required="required" pattern="[a-zA-z]+([ '-][a-zA-Z]+)*"/><label class="error"><?php echo $fnameErr;?></label>
			<label>Last Name: </label> <input type="text" name="lname" required="required" pattern="[a-zA-z]+([ '-][a-zA-Z]+)*"/><label class="error"><?php echo $lnameErr;?></label>
			<label>Date Of Birth: </label> <?php
												$values = array("January","February","March","April","May","June","July","August","September","October","November","December");	
												print"<div id='dobSelection'>"; $equipmentDisplayer->createMonthSelectionList($values);
												 $equipmentDisplayer->createDaySelectionList(1,31);
												 $equipmentDisplayer->createYearSelectionList(2016,1950);
												print "</div>";
												 ?>
												 <label class="error"><?php echo $dobErr;?></label>
				
			<label>Gender: </label> <input id="rButton" type="radio" name="gender" value="Male" checked="checked"><label id="radioOption">Male</label></input></br> <input id="rButton" type="radio" name="gender" value="Female"><label id="radioOption">Female</label></input></br>
			<label>Email: </label> <input type="email" name="email"/>	<label class="error"><?php echo $emailErr;?></label>
			<button type="submit" name="registerUser">Register</button>
		</form>
		</div>
	</body>
	<footer id="footer">
		<p>For more information contact us:</p>
		<P>- By TEL: 978-9596-0596 - By Email: quartermasters@mail.com</p>
	</footer>
</html>
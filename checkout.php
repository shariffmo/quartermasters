<!-- HOME PAGE-->
<?php
session_start();
include ('connection.php'); 
include('display_equipment_statements.php');
$equipmentDisplayer = new Equipment($DBH);
$Errors = "";

if(!isset($_SESSION['userLogged'])){
	header("Location: login.php");
}
$streetAddress = $city = $state = $postalCode = $country = $cardType = $cardNumber = $cardHolder = $securityPin= $expiryDate= "";
$streetAddressErr = $cityErr = $stateErr = $postalCodeErr = $countryErr = $expiryDateErr = $cardTypeErr = $cardNumberErr = $cardHolderErr = $securityPinErr =  "";
if(isset($_POST['checkout'])){
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		if (empty($_POST["streetAddress"])) {
			$streetAddressErr = "* Street Address is required";
		} else {
			$streetAddress = $_POST['streetAddress'];		
		}
		if(empty($_POST["city"])){
			$cityErr = "* City is required";
		}
		else{
			$city = $_POST['city'];		
		}
		if(empty($_POST["state"])){
			$stateErr = "* State is required";
		}
		else{
			$state = $_POST['state'];		
		}	
		
		if(empty($_POST['postalCode'])){
			$postalCodeErr = "POstal code is required";
		}
		else{
			$postalCode = $_POST['postalCode'];
		}
		
		if(empty($_POST['country'])){
			$countryErr = "Please select a country";
		}
		else{
			$country = $_POST['country'];
		}
		
		if(isset($_POST['month']) && isset($_POST['day']) && isset($_POST['year'])){
			$expiryDate = $_POST['month']."/".$_POST['day']."/".$_POST['year'];
		}
		else{
			$expiryDateErr = "Please select a date";
		}

		if(empty($_POST['cardType'])){
			$cardTypeErr = 'Please select a card type';
		}
		else{
			$cardType = $_POST['cardType'];
		}
		if(empty($_POST['cardNumber'])){
			$cardNumberErr = "Please provide a card number";
		}
		else{	
			$regexForCardNumber = "";
			if($cardType == "Visa"){
				$regexForCardNumber = "/^4[0-9]{12}(?:[0-9]{3})?$/";
			}
			else if($cardType = "MasterCard"){
				$regexForCardNumber = "/^5[1-5][0-9]{14}$/";
			}
			else if($cardType = "Discover"){
				$regexForCardNumber = "/^6(?:011|5[0-9]{2})[0-9]{12}$/";
			}
			else{
				$regexForCardNumber = "/^3[47][0-9]{13}$/";
			}
			
			if($equipmentDisplayer->test_input($regexForCardNumber , $_POST['cardNumber'])){
					$cardNumber = $_POST['cardNumber'];
			}
			else{
					$cardNumberErr = "Please enter a valid creadit card number";
			}	
		}
			
		if(empty($_POST['cardHolder'])){
			$cardHolderErr = "Please enter card holder's name";
		}
		else{	
			$cardHolder = $_POST['cardHolder'];
		}

		if(empty($_POST['securityPin'])){
			$securityPinErr = "Please provide the security pin";
		}
		else{	
			if($equipmentDisplayer->test_input("/\d{3}/", $_POST['securityPin'])){
				$securityPin = $_POST['securityPin'];
			}
			else{
			$securityPinErr = "Security Pin is not valid";
			}
		}	
		$Errors = array($streetAddressErr, $cityErr, $stateErr, $postalCodeErr, $countryErr, $cardTypeErr, $cardNumberErr, $cardHolderErr, $securityPinErr, $expiryDateErr);	
	
		if($streetAddress != "" && $city !=  "" && $state != "" && $postalCode != "" && $country != "" && $cardType != "" && $cardNumber != "" && $cardHolder != "" && $securityPin != "" && $expiryDate != ""){
			$_SESSION['currentOrder'] = $equipmentDisplayer->checkout($_SESSION['userLogged'], $streetAddress, $city, $state, $postalCode, $country, $cardType, $cardNumber, $cardHolder, $securityPin, $expiryDate);
				header("Location: orderDetail.php");
		}
	}		
}
?>


<html>
	<head>
	<script src="slideshow.js"></script> 
	<link rel="stylesheet" type="text/css" href="QMDB_01.css">
	<link rel="stylesheet" type="text/css" href="checkout.css">

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
			<span>Proceeding to checkout</span>
					<?php 
						for($i = 0; $i < count($Errors); ++$i){
							if(!empty($Errors[$i])){
								print '<label class="Errors">*'.$Errors[$i].'</label>';
							}
						}
					?>
			<form action="" method="post">
	
				<div id="address">
					<label id="addressTitle">Ship And Bill To:</label>
					<label>Street Address: </label> <input type="text" name="streetAddress" required="required"/>
					<label>City: </label> <input type="text" name="city" required="required"/>
					<label>State: </label> <input type="text" name="state" required="required"/>
					<label>Postal Code: </label> <input type="text" name="postalCode" required="required"/>
					<label>Country: </label> <?php print"<div id='countrySelection'>";  
												   $equipmentDisplayer->createCountrySelectionList(); 
												   print "</div>";?>
				</div>
				<div id="payment">
					<label id="paymentTitle">Pay Via:</label>
					<label>Card type: </label>
											<?php	
												print "<div id='cardSelection'>";
												$equipmentDisplayer->displayCardTypes();
												print "</div>";
											?>
					<label>Card number: </label> <input type="text" name="cardNumber" required="required"/>
					<label>Card holder: </label> <input type="text" name="cardHolder" required="required"/>
					<label>Security pin: </label> <input type="number" name="securityPin" required="required"/>
					<label>Expiration date: </label> <?php
															$values = array("January","February","March","April","May","June","July","August","September","October","November","December");	
															print"<div id='dobSelection'>"; $equipmentDisplayer->createMonthSelectionList($values);
															$equipmentDisplayer->createDaySelectionList(1,31);
															$equipmentDisplayer->createYearSelectionList(2030,2016);
															print "</div>";
														?>
					<button id="nextBtn"type="submit" name="checkout">Next</button>
				</div>
				
			<form>
	</body>
	<footer id="footer">
		<p>For more information contact us:</p>
		<P>- By TEL: 978-9596-0596 - By Email: quartermasters@mail.com</p>
	</footer>
</html>
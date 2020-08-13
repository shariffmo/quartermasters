<!-- HOME PAGE-->
<?php
session_start();
include ('connection.php'); 
include('display_equipment_statements.php');
$equipmentDisplayer = new Equipment($DBH);
if(isset($_POST['addToCart']) && !empty($_POST['quantity'])){
				if(isset($_SESSION['userLogged'])){
					$equipmentDisplayer->addItemToCart("user",$_SESSION['userLogged'] ,$_POST['addToCart'], $_POST['quantity']);
				}
				else{
					if(isset($_COOKIE['anonId'])){
						$anonID = $_COOKIE['anonId'];
					}
					else{
						$anonID =sha1(uniqid());
						$expire = time() + (60 * 60 * 24);
						setcookie('anonId', $anonID, $expire);
					}
				}
			}
?>


<html>
	<head>
	<link rel="stylesheet" type="text/css" href="QMDB_01.css">
	<link rel="stylesheet" type="text/css" href="category_links.css">

		<title>Clothing</title>
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
							print('	<li><a href="#"><img id="cartlogo" src="pictures/cartlogo.png"></a></li>
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
		<div id="categoryDiv">
		<ul id="categoryList"> 
			<li id="listTitle">CATEGORIES</li>
		<?php
			$equipmentDisplayer->displayCategories($DBH);
		?>
		</ul>
		</div>
		
		<div id="productDiv">
		
		<ul id="productElements">
		<?php
			$selectQuery = "SELECT product_id, product_name, product_description, product_price, quantity, product_image from product WHERE category_id = 6";
			$equipmentDisplayer->displayEquipment($selectQuery);
		?>
		</ul>
		</div>
	</body>
	<footer id="footer">
		<p>For more information contact us:</p>
		<P>- By TEL: 978-9596-0596 - By Email: quartermasters@mail.com</p>
	</footer>
</html>
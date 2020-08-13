<?php
include ('connection.php'); 

session_start();
//getting current user name

$ussername = $_SESSION["userLogged"];

//getting user contact id
$measurement_id = $_POST['measurement_idEdit'];
if(isset($_POST["saveChanges"]))
{
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
<?php
//WMDB_MEASUREMENTS_02.php
include ('connection.php'); 
session_start();
//getting current user name
$user_id = $_SESSION["userLogged"] ;
//getting user contact id

if(isset($_POST["Delete"]))
{
	$statement ="DELETE FROM measurement WHERE contact_id = '$user_id'";
		$stmt = $DBH->prepare($statement);
		$stmt->execute();
}
//getting all measurements that belong to user

if(isset($_POST["submit"]))
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
			
		$stmt = $DBH->prepare("SELECT * FROM measurement WHERE contact_id = ?");
		$stmt->bindParam(1, $user_id);
		$stmt->execute();
		$stmt->setFetchMode(PDO::FETCH_OBJ);
		$resultSet = $stmt->fetch();
		if($resultSet){
			echo "updating";
			$STH = $DBH->prepare("UPDATE  measurement SET user_height='$height', user_shoeSize='$shoeSize',user_handSize='$handSize',user_headSize='$headSize',user_neckSize='$neckSize',user_chestSize='$chestSize',user_waistSize='$waistSize', user_hipSize='$hipSize',date_measured='$date' WHERE contact_id='$user_id'");
			
			$STH-> execute();
		}		
		else{
			echo "inserting";
		$STH = $DBH->prepare("INSERT INTO measurement(contact_id, user_height, user_shoeSize,user_handSize,user_headSize,user_neckSize,user_chestSize,user_waistSize, user_hipSize,date_measured) VALUES(?,?,?,?,?,?,?,?,?,?)");
			$STH-> bindParam(1,$user_id);
			$STH-> bindParam(2,$height);
			$STH-> bindParam(3,$shoeSize);
			$STH-> bindParam(4,$handSize);
			$STH-> bindParam(5,$headSize);
			$STH-> bindParam(6,$neckSize);
			$STH-> bindParam(7,$chestSize);
			$STH-> bindParam(8,$waistSize);
			$STH-> bindParam(9,$hipSize);
			$STH-> bindParam(10,$date);
			$STH-> execute();
			
	}
	}
	else{
		
	echo "Enter all measurements";
	}
	
}

$statement2 = "SELECT measurement_id,user_height, user_shoeSize,user_handSize,user_headSize,
user_neckSize,user_chestSize,user_waistSize, user_hipSize,date_measured
 FROM measurement WHERE contact_id=$user_id";
$stmt = $DBH->query($statement2);



?>
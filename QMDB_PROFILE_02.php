<?php
//QMDB_PROFILE_02.php
include ('connection.php'); 
session_start();
$ussername = $_SESSION["ussername"];

$statement ="SELECT contact_id, user_fname, user_lname, user_rank, user_DOB, user_address, user_gender, user_city, user_country,user_postalCode FROM contact INNER JOIN login ON login.login_id=contact.login_id WHERE login_name='$ussername'";

		//getting corresponding row from database
		$stmt = $DBH->prepare($statement);
		$stmt->execute();
		$result = $stmt;
		foreach($result as $row)
		{
			$usserId = $row['contact_id'];
   			$fname = $row['user_fname'];
   			$lname = $row['user_lname'];
   			$rank = $row['user_rank'];
   			$DOB = $row['user_DOB'];
   			$gender = $row['user_gender'];
   			$address = $row['user_address'];
   			$city = $row['user_city'];
   			$country = $row['user_country'];
   			$postalCode = $row['user_postalCode'];

		}


if(isset($_POST["submit"]))
{
	//checking if all values are entered
	if(!empty($_POST["fname"]) || !empty($_POST["lname"]) || !empty($_POST["rank"]) || !empty($_POST["DOB"]) || !empty($_POST["gender"]) || !empty($_POST["address"]) || !empty($_POST["city"]) || !empty($_POST["country"]) || !empty($_POST["postalCode"]))
	{
			$ffname = $_POST["fname"];
			$_SESSION["user_fname"]= $ffname;	
			$llname = $_POST["lname"];
			$_SESSION["user_lname"]= $llname;
			$rrank = $_POST["rank"];	
			$DDOB = $_POST["DOB"];
			$ggender = $_POST["gender"];
			$aaddress = $_POST["address"];
			$ccity = $_POST["city"];
			$ccountry = $_POST["country"];
			$ppostalCode = $_POST["postalCode"];
			

			//inserting contact into database
			$STH = $DBH->prepare("UPDATE contact SET user_fname='$ffname', user_lname='$llname', user_gender='$ggender',user_rank='$rrank', user_DOB='$DDOB', user_address='$aaddress', user_city='$ccity', user_country='$ccountry', user_postalCode='$ppostalCode' WHERE contact_id = '$usserId'");
			
			$STH-> execute();

		


	}
}	
?>
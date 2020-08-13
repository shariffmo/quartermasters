<?php
//QMDB_PROFILE_MESSAGES_02.php
include ('connection.php');
//getting current user name
$user_id = $_SESSION["adminLogged"] ;

//getting user contact id

//if user wants to send a message
if(isset($_POST["send"]))
{
	if(!empty($_POST["recepient"] || !empty($_POST["message"])))
	{

		$to_recepient = $_POST["recepient"];
		$text_to_send = $_POST["message"];
		$date = date('Y-m-d');
		


		//getting new recepients id
		$statement ="SELECT user_id FROM users WHERE user_last_name='$to_recepient'";
		$stmt = $DBH->prepare($statement);
		$stmt->execute();
		$result = $stmt;
		foreach($result as $row)
		{
   			$to_receive_id = $row['user_id'];
		}

		$STH = $DBH->prepare("INSERT INTO message (recepient_id, sender_id, date_sent,message_text) VALUES(?,?,?,?)");
			$STH-> bindParam(1,$to_receive_id);
			$STH-> bindParam(2,$user_id);
			$STH-> bindParam(3,$date);
			$STH-> bindParam(4,$text_to_send);
			$STH-> execute();
			echo "message sent";
			 
	}
	
}
if(isset($_POST["back"]))
	{
		header('Location:admin_profile.php'); 
	}
?>
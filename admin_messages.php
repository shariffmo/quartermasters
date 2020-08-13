<?php
//QMDB_PROFILE_MESSAGES_02.php
include ('connection.php'); 
//getting current user name
$admin_id = $_SESSION["adminLogged"] ;
//getting user contact id

//getting all messages that belong to user
$statement1 = "SELECT message_id, user_first_name, user_last_name, date_sent, message_text FROM message
INNER JOIN users
ON users.user_id = message.sender_id
 WHERE recepient_id='$admin_id'";
$stmt = $DBH->query($statement1);

if(isset($_POST["Reply"]) || isset($_POST["SendMessage"]))
{
	header('Location:adminReply.php'); 
}

if(isset($_POST["Delete"]))
{
	$statement ="DELETE FROM message WHERE message_id='$_POST[message_id]'";
		$stmt = $DBH->prepare($statement);
		$stmt->execute();
		header('Location:admin_profile.php'); 
}

?>
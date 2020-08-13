<?php
//QMDB_PROFILE_MESSAGES_02.php
include ('connection.php'); 
session_start();
//getting current user name
$user_id = $_SESSION['userLogged'];
//getting user contact id

//getting all messages that belong to user
$statement1 = "SELECT message_id, user_first_name, user_last_name, date_sent, message_text FROM message
JOIN users
ON users.user_id = message.sender_id
 WHERE recepient_id='$user_id'";
$stmt = $DBH->query($statement1);

if(isset($_POST["Reply"]) || isset($_POST["SendMessage"]))
{
	header('Location:QMDB_MESSAGES_REPLY.php'); 
}

if(isset($_POST["Delete"]))
{
	$statement ="DELETE FROM message WHERE message_id='$_POST[message_id]'";
		$stmt = $DBH->prepare($statement);
		$stmt->execute();
		header('Location:QMDB_PROFILE_MESSAGES.php'); 
}

?>
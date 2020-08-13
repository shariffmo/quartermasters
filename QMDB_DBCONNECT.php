<?php
	//connect to database
	//print_r(PDO::getAvailableDrivers());
	$host = "localhost";
	$user = "root";
	$pass = "";
	$dbname = 'phpfinal';

    try 
	{   # MySQL with PDO_MYSQL   
	    $DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass); 
    }
	
	catch(PDOException $e) 
	{     
	    echo $e->getMessage(); 
	} 

?>
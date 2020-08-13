<?php include 'library.php'; include 'form.php';
		ShowForm();
		if (isset($_POST['calculate'])) 
			{
					$number1 = $_POST["number1"];
					$number2 = $_POST["number2"];
					$op = $_POST['operators'];		
					$result = Calculate($number1,$op,$number2);
					echo $result;
			}
?>
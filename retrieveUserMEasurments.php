<?php
	session_start();
	if(!(isset($_SESSION['adminLogged'])))
    {
		header("Location: admin_login.php");
	}
?>
<html> 
   <head>
		    <link rel="stylesheet" type="text/css" href="QMDB_01.css">
					    <link rel="stylesheet" type="text/css" href="orderTable.css">

   </head>
   <body>
   <header>
            <img id="headerImage" src="header.jpg" alt="2806 Logo" >
		<div id="header">
			<div id="navbar">
				<ul style="list-style-type:none;margin:0;padding:0;">
					<li><a href="qmdb_admin.php">HOME</a></li>
					<li><a href="QMDB_INVENTORY.php">INVENTORY</a></li>
					<li><a href="QMDB_ALL_ACCOUNTS.php">ACTIVE ACCOUNTS</a></li>
					<li><a href="ADMIN_ALL_ORDERS.php">ORDERS</a></li>
					<div id="rightmostElements">
					<li><a href="ADMIN_PROFILE.php">YOUR ACCOUNT</a></li>
					<li><a href="logout2.php">LOGOUT</a></li>
					</div>
				</ul>
			</div>
		</div>
		</header>
      <h1>Retrieve Measurments</h1>
      
	  <form method="post">
		<label>Enter user id of the customer:</label><input name="user_id" type="number" min="1"/>
													  <input type="submit" name="submit" value="Retrieve"/>	
	  </form>
	  <?php
       
       include ('connection.php'); 
	   if(isset($_POST['submit'])){
		$user_id = $_POST['user_id'];
	    	$STH = $DBH->prepare("SELECT user_first_name, user_height, user_shoeSize, user_handSize, user_headSize, user_neckSize, user_chestSize, user_waistSize, user_hipSize, date_measured from measurement INNER JOIN users on users.user_id = measurement.contact_id WHERE contact_id = ?");
			$STH->bindParam(1,$user_id);
		$STH->execute();
		$STH->setFetchMode(PDO::FETCH_OBJ);
		while($record = $STH->fetch()){
						echo '<label id="orderId">Measurements Of:</label></br>';
			echo '<label id="orderDate">Customer:',$record->user_first_name,'</label></br>';
			echo '<label id="By">As of:',$record->date_measured,'</label></br>';
			
			echo '<table id="order">
					<col width="200">
					<col width="200">
					<tr>
						<th>Body Part</th>
						<th>Measurement</th>
					</tr>';
					
				echo '<tr>
						<td>Height</td>
						<td>',$record->user_height,'</td>
					  </tr>';	
			
				echo '<tr>
						<td>Shoe Size</td>
						<td>',$record->user_shoeSize,'</td>
					  </tr>';				

				echo '<tr>
						<td>Hand Size</td>
						<td>',$record->user_handSize,'</td>
					  </tr>';						

				echo '<tr>
						<td>Head Size</td>
						<td>',$record->user_headSize,'</td>
					  </tr>';	
					  
				echo '<tr>
						<td>Neck Size</td>
						<td>',$record->user_neckSize,'</td>
					  </tr>';						

				echo '<tr>
						<td>Chest Size</td>
						<td>',$record->user_chestSize,'</td>
					  </tr>';						  
					  
				echo '<tr>
						<td>Waist Size</td>
						<td>',$record->user_waistSize,'</td>
					  </tr>';						  
					  
				echo '<tr>
						<td>Hip SIze</td>
						<td>',$record->user_hipSize,'</td>
					  </tr>';						

					  
			echo '</table></br></br>';
	   }}
	
    ?>   
             
                         

    <?php
             
	     
	  ?>
        </form>
      </table>
       <a href="QMDB_ADMIN.php">Return to homepage</a>
   </body>
</html>

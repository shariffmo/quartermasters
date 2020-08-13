<html>

	<head>
	<script src="slideshow.js"></script> 
	<link rel="stylesheet" type="text/css" href="QMDB_01.css">
	<link rel="stylesheet" type="text/css" href="account.css">
	<link rel="stylesheet" type="text/css" href="orderTable.css">
		<title>MEASUREMENTS</title>
		<header>
		<div id="header">
			<img id="headerImage" src="pictures/header.jpg" alt="2806 Logo" >

			<div id="navbar">
				<ul style="list-style-type:none;margin:0;padding:0;">
					<li><a href="index.php">HOME</a></li>
					<li><a href="equipment.php">EQUIPMENT</a></li>
				

					<div id="rightmostElements">
						<li><a href="cart.php"><img id="cartlogo" src="pictures/cartlogo.png"></a></li>
						<li><a href="myaccount.php">MY ACCOUNT</a></li>
						<li><a href="QMDB_PROFILE_MESSAGES.php">MESSAGES</a></li>
					<li><a href="QMDB_MEASUREMENTS.php">MEASUREMENTS</a></li>
					<li><a href="QMDB_CHANGE_PASSWORD.php">CHANGE PASSWORD</a></li>
						<li><a href="logout.php">SIGN OUT</a></li>
					</div>
				</ul>
			</div>
		</div>
		</header>
	</head>
		<form method="post">
			<label>Enter your measurements:</label>
			<br/>
			<br/>
			<label>Head Size:</label>
			<br/>
			<input id="headSize" name="headSize" type="text">
			<br/>
			<label>Neck Size:</label>
			<br/>
			<input id="neckSize" name="neckSize" type="text">
			<br/>
			<label>Chest Size</label>
			<br/>
			<input id="chestSize" name="chestSize" type="text">
			<br/>
			<label>Waist Size:</label>
			<br/>
			<input id="waistSize" name="waistSize" type="text">
			<br/>
			<label>Hip Size:</label>
			<br/>
			<input id="hipSize" name="hipSize" type="text">
			<br/>
			<label>Shoe Size:</label>
			<br/>
			<input id="shoeSize" name="shoeSize" type="text">
			<br/>
			<label>Height:</label>
			<br/>
			<input id="heigh" name="height" type="text">
			<br/>
			<label>Hand Size:</label>
			<br/>
			<input id="handSize" name="handSize" type="text">
			<br/>
			<br/>
			<input id="submit" name="submit" value="Add / Update" type="submit">
			
		</form>
<table>
		
	<tr>
		<th>Head Size</th>
		<th>Neck Size</th>
		<th>Chest Size</th>
		<th>Waist Size</th>
		<th>Hip Size</th>
		<th>Shoe Size</th>
		<th>Height</th>
		<th>Hand Size</th>
		<th>Date Measured</th>
	</tr>

        <?php

include ('QMDB_MEASUREMENTS_02.php');


        while($row = $stmt->fetch())
        {
            ?>
            <tr>
                
               <td> <?=$row['user_headSize'] ?></td>
				<td><?=$row['user_neckSize']?></td>
				<td><?= $row['user_chestSize']?></td>
				<td><?= $row['user_waistSize']?></td>
				<td><?= $row['user_hipSize']?></td>
				<td><?= $row['user_shoeSize']?></td>
				<td><?= $row['user_height']?></td>
				<td><?= $row['user_handSize']?></td>
				<td><?= $row['date_measured']?></td>

				<td>
                   
                    <form method="post" action='QMDB_MEASUREMENTS.php'>
                        <button type="submit" value="Delete" name="Delete">Delete</button>
                        <input type="hidden" name="measurement_id" value="<?= $row['measurement_id'] ?>">
                    </form>
                </td>

                
				
            </tr>

            <?php
        }
		

        ?>
	
	
	

</table>
			
</head>

</html>
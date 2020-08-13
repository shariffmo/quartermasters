
<!--PROFILE MESSAGES -->
<html>
<head>
    <script src="slideshow.js"></script> 
    <link rel="stylesheet" type="text/css" href="QMDB_01.css">
    <link rel="stylesheet" type="text/css" href="account.css">
    <link rel="stylesheet" type="text/css" href="orderTable.css">
        <title>MESSAGES</title>
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
<br/>
<label>Search Messages : </label>
 <input type="search" name="messageSearch">
 <br/>
 <br/>
<button  type="submit" value="SendMessage" name="SendMessage">Send Message</button>
<br/>
<table >
	<tr>
		<th> SENT FROM </th>
		<th> SENT ON </th>
		<th> MESSAGE </th>	
	</tr>

        <?php

include ('QMDB_PROFILE_MESSAGES_02.php');


        while($row = $stmt->fetch())
        {
            ?>
            <tr>
                <td>
                    <?=$row['user_first_name']. " ". $row['user_last_name']?>
                </td>

                <td>
                    <?=$row['date_sent']?>
                </td>

                <td>
                    <?=$row['message_text']?>
                </td>

                <td>
                    <form method="post" action=''>
                        <button type="submit" value="Delete" name="Delete">Delete</button>
                        <input type="hidden" name="message_id" value="<?= $row['message_id'] ?>">
                    </form>
                </td>

                <td>
                    <form method="post" action=''>
                        <input type="hidden" name="message_id" value="<?= $row['message_id'] ?>">
                        <button  type="submit" value="Reply" name="Reply">Reply</button>
                    </form>
                </td>
            </tr>

            <?php
        }
        ?>
	
	
	

</table>
</form>

</html>
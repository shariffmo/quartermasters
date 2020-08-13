<!-- PROFILE PAGE -->
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
   <h1>Your messages</h1>
 
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

include ('admin_messages.php');


        while($row = $stmt->fetch())
        {
            ?>
            <tr>
                <td>
                    <?=$row['user_first_name']." ". $row['user_last_name']?>
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
</body>
</html>
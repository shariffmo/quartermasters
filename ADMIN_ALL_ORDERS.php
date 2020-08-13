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
    <style>
       <style>
          #order {
        font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
        }

        #order td, #customers th {
        border: 1px solid #ddd;
        text-align: left;
        padding: 8px;
        }

        #order tr:nth-child(even){background-color: #f2f2f2}

        #order tr:hover {background-color: #ddd;}

        #order th {
        padding-top: 12px;
        padding-bottom: 12px;
        background-color: #0D8FBA;
        color: white;
        }
    </style>

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
      <h1 style="font-size: 50px;">LIST OF ORDERS</h1
      
	  <?php
       
       include ('connection.php'); 
	    $STH = $DBH->prepare("SELECT order_id, order_date, user_first_name  FROM orders INNER JOIN users using(user_id)");
		$STH->execute();
		$STH->setFetchMode(PDO::FETCH_OBJ);
		
		while($row = $STH->fetch()){
			echo '<label id="orderId" style="font-weight: bold;">ORDER ID:',$row->order_id,'</label></br>';
			echo '<label id="orderDate" style="font-weight: bold;">Placed On:',$row->order_date,'</label></br>';
			echo '<label id="By" style="font-weight: bold;">By:',$row->user_first_name,'</label></br>';
			
			
			$stmt = $DBH->prepare("SELECT product.product_name, product.product_price, order_detail.quantity FROM order_detail
														INNER JOIN orders USING (order_id)
														INNER JOIN product USING (product_id)
													WHERE order_id = ?");
			$stmt->bindParam(1,$row->order_id);
			$stmt->execute();
			$stmt->setFetchMode(PDO::FETCH_OBJ);
			echo '<table id="order">
					<col width="200">
					<col width="200">
					<col width="200">
					<tr>
						<th>Product</th>
						<th>Unitary Price</th>
						<th>Quantity</th>
					</tr>';
			while($record = $stmt->fetch()){
				echo '<tr>
						<td>',$record->product_name,'</td>
						<td>',$record->product_price,'</td>
						<td>',$record->quantity,'</td>
					  </tr>';	
			}
			echo '</table></br></br>';
		}
	
    ?>   
            
        </form>
      </table>
       <a style="font-weight: bold; color: #000000; font-size: 25px;" href="QMDB_ADMIN.php" id="return" href="QMDB_ADMIN.php">Return to homepage</a>
   </body>
</html>

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
       <style>
          #description {
          font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
          border-collapse: collapse;
          width: 100%;
          }

          #description td, #customers th {
          border: 1px solid #ddd;
          text-align: left;
          padding: 8px;
          }

          #description tr:nth-child(even){background-color: #f2f2f2}

          #description tr:hover {background-color: #ddd;}

          #description th {
          padding-top: 12px;
          padding-bottom: 12px;
          background-color: #0D8FBA;
          color: white;
          }
           
          input[type=submit] 
          {
            border : solid 1px #e6e6e6;
	        border-radius : 3px;
	        -webkit-box-shadow : 0px 0px 2px rgba(0,0,0,1.0);
	        -moz-box-shadow : 0px 0px 2px rgba(0,0,0,1.0);
	        box-shadow : 0px 0px 2px rgba(0,0,0,1.0);
	        font-size : 15px;
	        color : #696869;
	        padding : 1px 17px;
	        background : #ffffff;
	        background : -webkit-gradient(linear, left top, left bottom, color-stop(0%,#ffffff), color-stop(49%,#f1f1f1), color-stop(51%,#e1e1e1), color-stop(100%,#f6f6f6));
	        background : -moz-linear-gradient(top, #ffffff 0%, #f1f1f1 49%, #e1e1e1 51%, #f6f6f6 100%);
	        background : -webkit-linear-gradient(top, #ffffff 0%, #f1f1f1 49%, #e1e1e1 51%, #f6f6f6 100%);
	        background : -o-linear-gradient(top, #ffffff 0%, #f1f1f1 49%, #e1e1e1 51%, #f6f6f6 100%);
	        background : -ms-linear-gradient(top, #ffffff 0%, #f1f1f1 49%, #e1e1e1 51%, #f6f6f6 100%);
	        background : linear-gradient(top, #ffffff 0%, #f1f1f1 49%, #e1e1e1 51%, #f6f6f6 100%);
	        filter : progid:DXImageTransform.Microsoft.gradient( startColorstr='#ffffff', endColorstr='#f6f6f6',GradientType=0 );
           }
       </style>
   </head>
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
					<li><a href="logout.php">LOGOUT</a></li>
					</div>
				</ul>
			</div>
		</div>
		</header>
   <body>
     
       <form action="" method="post">
        <table border="1" id="description">  
       <thead>
          <tr>
             <th>Product Description</th>
             <th>Price</th>
          </tr>
       </thead>
<?php
    include('connection.php');  
    $id = 0;
    $id = $_GET['product_id'];
    $_SESSION['id'] = $id;

            
    $STH = $DBH->prepare("SELECT * FROM product WHERE product_id = '$id'");
    $STH->execute(); 
    
    while($row = $STH->fetch()) 
    {  
        $product_name = $row['product_name'];
        $product_description = $row['product_description'];
        $product_price = $row['product_price'];
?>
       <h1 style="font-size: 50px;"><?php echo"$product_name"?></h1>    
       <tbody>
           
		  <tr>
		      <td> <?php echo $product_description; ?> </td>                                  
		      <td> <?php echo $product_price; ?> </td>      
		  </tr>
	   </tbody>
<?php
    }
?>
      </table>
      <input type="submit" name="submit_delete" onclick="return confirm('Are you sure?');" value="Delete"/>
      <input type="submit" name="submit_update" onclick="return confirm('Update item?');" value="Update"/>
     <?php
           if(isset($_POST["submit_delete"]))
           {
              include('connection.php');
              $STH = $DBH->prepare("DELETE FROM product WHERE product_id = '$id'");
              $STH->execute();
               
              header("Location: QMDB_INVENTORY.php");
           }
           
           if(isset($_POST["submit_update"]))
           {
              
              header("Location: UPDATE_PRODUCT.php?product_id=".$_SESSION['id']);
           }
     ?>
     <br/><br/>    
     <a style="font-weight: bold; color: #000000; font-size: 25px;" href="QMDB_INVENTORY.php">Back to inventory</a>
     </form>
       
   </body>
</html>
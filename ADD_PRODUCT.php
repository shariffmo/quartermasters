<?php
	session_start();
	if(!(isset($_SESSION['adminLogged'])))
    {
		header("Location: admin_login.php");
	}

    if(isset($_POST['submit_add']))
        {
           include('connection.php');
           $STH = $DBH->prepare("INSERT INTO product(product_name, product_description, product_price, quantity, category_id) VALUES (:product_name, :product_description, :product_price, :quantity, :category_id)");
           $data = array("product_name"=> $_POST['prodName'], "product_description"=>$_POST['prodDesc'], "product_price"=>$_POST['prodPrice'], "quantity"=>$_POST['prodQuantity'], "category_id"=>$_POST['catID']); 
           $STH->execute($data);
           header("Location: QMDB_INVENTORY.php");
        }
?>
<html>
  <head>
     <link rel="stylesheet" type="text/css" href="QMDB_01.css">
     <style>
           
        #legend {
        font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 30%;
        }
        
        #legend td, #customers th {
        border: 1px solid #ddd;
        text-align: left;
        padding: 8px;
        }
          
        #legend tr:nth-child(even){background-color: #f2f2f2}
          
        #legend tr:hover {background-color: #ddd;}

        #legend th {
        padding-top: 12px;
        padding-bottom: 12px;
        background-color: #0D8FBA;
        color: white;
        }  
           
        #addForm {
        font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 70%;
        }

        #addForm td, #customers th {
        border: 1px solid #ddd;
        text-align: left;
        padding: 8px;
        }

        #addForm tr:nth-child(even){background-color: #f2f2f2}

        #addForm tr:hover {background-color: #ddd;}

        #addForm th {
        padding-top: 12px;
        padding-bottom: 12px;
        background-color: #0D8FBA;
        color: white;
        }
           
        table.one {
        position:relative;
        float:right;
        }

        table.two {
        position:relative;
        float:left;
        margin-top: 18px;
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
            margin-left: 5px;
            margin-top: 5px;
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
					<li><a href="logout.php">LOGOUT</a></li>
					</div>
				</ul>
			</div>
		</div>
		</header>
    <h1 style="font-size: 50px;">Add Product</h1>
    <table border="1" id="legend" class=two>
       <thead>
           <tr>
             <th>Category ID</th>
             <th>Category Name</th>
           </tr>
       </thead>
     <?php
        include('connection.php');
        $STH = $DBH->prepare("SELECT * FROM category");
        $STH->execute();
        while($row = $STH->fetch()) 
		 {  
            $category_id = $row['category_id'];
            $category_name = $row['category_name'];
            
     ?>
       <tbody>
           <tr>
             <td>
                 <?php echo"$category_id"?>
             </td>
             <td><?php echo"$category_name"?></td>
           </tr>
       </tbody>
    <?php
        }
    ?>
    </table>
    <br/>
    <form action="" method="post">
        <table border="1" id="addForm" class="one">
          <thead>
             <tr>
                 <th>Add an Item</th>
             </tr>
          </thead>
            
          <tbody>
              <tr><td>Product Name: <input type="text" name="prodName"/></td></tr>
              <tr><td>Product Description: <input type="text" name="prodDesc"/></td></tr>
              <tr><td>Product Price: <input type="text" name="prodPrice"/></td></tr>
              <tr><td>Quantity: <input type="text" name="prodQuantity"/></td></tr>
              <tr><td>Category ID: <input type="text" name="catID"/></td></tr>
          </tbody>
        </table>
        <input type="submit" name="submit_add" value="Add"/>
     </form>  
    <br/><br/>
    <a style="font-weight: bold; color: #000000; font-size: 25px;" href="QMDB_INVENTORY.php">Go back to shop</a>
  </body>
</html>
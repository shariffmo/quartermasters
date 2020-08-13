<?php
	session_start();
	if(!(isset($_SESSION['adminLogged']))){
		header("Location: admin_login.php");
	}
?>
<html>
   <head>
    <link rel="stylesheet" type="text/css" href="QMDB_01.css">
      <style>
        #legend {
        font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
        border-collapse: collapse;
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
          
        #inventory {
        font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
        }

        #inventory td, #customers th {
        border: 1px solid #ddd;
        text-align: left;
        padding: 8px;
        }

        #inventory tr:nth-child(even){background-color: #f2f2f2}

        #inventory tr:hover {background-color: #ddd;}

        #inventory th {
        padding-top: 12px;
        padding-bottom: 12px;
        background-color: #0D8FBA;
        color: white;
        }
          
        A:link {text-decoration: none}
        A:visited {text-decoration: none}
        A:active {text-decoration: none}
        A:hover {font-size:24; font-weight:bold; color: red;}
          
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
       <h1 style="font-size: 50px;">Quarter Master Military Shop</h1>
      
       <table border="1" id="legend">
           <thead>
              <tr>
                  <th>Legend</th>
              </tr>
           </thead>
           <tbody>
              <tr>
                  <td><input style='color: green' type="text" value="In stock" disabled/></td>
              </tr>
              <tr>
                  <td><input style='color: gold' type="text" value="Limited stock" disabled/></td>
              </tr>
              <tr>
                  <td><input style='color: red' type="text" value="Running out of stock" disabled/></td>
              </tr>
           </tbody>
       </table>
       <br/>
          <form action="QMDB_INVENTORY.php" method="post" id="sort">
            <label style="font-weight: bold; color: #000000; font-size: 20px;">Sort by:</label> <select id="sortBy" name="sortBy">
              <?php $sortBy = $_POST["sortBy"]; ?>
              <option value="0" <?php if($sortBy == "0") { ?>selected <?php } ?> >--</option>
              <option value="1" <?php if($sortBy == "1") { ?>selected <?php } ?> >NAME</option>
              <option value="2" <?php if($sortBy == "2") { ?>selected <?php } ?> >CATEGORY (A-Z)</option>
              <option value="7" <?php if($sortBy == "2") { ?>selected <?php } ?> >CATEGORY (Z-A)</option>
              <option value="3" <?php if($sortBy == "3") { ?>selected <?php } ?> >QUANTITY (LOW TO HIGH</option>
              <option value="6" <?php if($sortBy == "5") { ?>selected <?php } ?> >QUANTITY (HIGH TO LOW)</option>
              <option value="4" <?php if($sortBy == "4") { ?>selected <?php } ?> >PRICE (LOW TO HIGH)</option>
              <option value="5" <?php if($sortBy == "5") { ?>selected <?php } ?> >PRICE (HIGH TO LOW)</option>
            </select>
            <input type="submit" name="sort" value="Sort">
          </form>
       
       <form action="QMDB_INVENTORY.php" method="post">
        <table border="1" id="inventory">
       <thead>
          <tr>
             <th>Product Name</th>  
             <th>Category Name</th>
             <th>Price</th>
             <th>Quantity</th>
          </tr>
       </thead>
	
	   <tbody>
            <?php
               if(isset($_POST['sort']))
               {
                  $sortBy = $_POST['sortBy'];
                  if($sortBy == "1")
                  {
                     include('connection.php');
                     $STH = $DBH->prepare("SELECT product_id, product_name, quantity, category_name, product_price FROM product INNER JOIN category USING (category_id) ORDER BY product_name ASC");
		             $STH->execute(); 
                      
                     while($row = $STH->fetch()) 
		             {  
                       $product_id = $row['product_id'];
                       $product_name = $row['product_name'];
                       $quantity = $row['quantity'];
                       $category_name = $row['category_name'];
                       $product_price = $row['product_price'];
                         
                       echo "<tr>";
                       echo "<td><a href='SELECTED_PRODUCT.php?product_id=$product_id'>$product_name</a></td>";
                       echo "<td>$category_name</td>";
                       echo "<td>$product_price</td>";
              
                       if($quantity < 50)
                       {
                          echo "<td style='color: red'>$quantity</td>";
                       }
                         
                       if($quantity >= 50 && $quantity < 100)
                       {
                          echo "<td style='color: gold'>$quantity</td>";
                       }
                         
                       if($quantity >= 100)
                       {
                          echo "<td style='color: green'>$quantity</td>";
                       }
                       echo "</tr>";
                    }
                  }
                   
                  if($sortBy == "2")
                  {
                     include('connection.php');
                     $STH = $DBH->prepare("SELECT product_id, product_name, quantity, category_name, product_price FROM product INNER JOIN category USING (category_id) ORDER BY category_name ASC");
		             $STH->execute(); 
                      
                     while($row = $STH->fetch()) 
		             {  
                       $product_id = $row['product_id'];
                       $product_name = $row['product_name'];
                       $quantity = $row['quantity'];
                       $category_name = $row['category_name'];
                       $product_price = $row['product_price'];
                         
                       echo "<tr>";
                       echo "<td><a name='product' href='SELECTED_PRODUCT.php?product_id=$product_id'>$product_name</a></td>";
                       echo "<td>$category_name</td>";
                       echo "<td>$product_price</td>";
                         
                       if($quantity < 50)
                       {
                          echo "<td style='color: red'>$quantity</td>";
                       }
                         
                       if($quantity >= 50 && $quantity < 100)
                       {
                          echo "<td style='color: gold'>$quantity</td>";
                       }
                         
                       if($quantity >= 100)
                       {
                          echo "<td style='color: green'>$quantity</td>";
                       }
                       echo "</tr>";
                    }
                  }
                   
                  if($sortBy == "3")
                  {
                     include('connection.php');
                     $STH = $DBH->prepare("SELECT product_id, product_name, quantity, category_name, product_price FROM product INNER JOIN category USING (category_id) ORDER BY quantity ASC");
		             $STH->execute(); 
                      
                     while($row = $STH->fetch()) 
		             {  
                       $product_id = $row['product_id'];
                       $product_name = $row['product_name'];
                       $quantity = $row['quantity'];
                       $category_name = $row['category_name'];
                       $product_price = $row['product_price'];
                         
                       echo "<tr>";
                       echo "<td><a href='SELECTED_PRODUCT.php?product_id=$product_id'>$product_name</a></td>";
                       echo "<td>$category_name</td>";
                       echo "<td>$product_price</td>";
                       if($quantity < 50)
                       {
                          echo "<td style='color: red'>$quantity</td>";
                       }
                         
                       if($quantity >= 50 && $quantity < 100)
                       {
                          echo "<td style='color: gold'>$quantity</td>";
                       }
                         
                       if($quantity >= 100)
                       {
                          echo "<td style='color: green'>$quantity</td>";
                       }
                       echo "</tr>";
                    }
                  }
                  
                  
                  if($sortBy == "4")
                  {
                     include('connection.php');
                     $STH = $DBH->prepare("SELECT product_id, product_name, quantity, category_name, product_price FROM product INNER JOIN category USING (category_id) ORDER BY product_price ASC");
		             $STH->execute(); 
                      
                     while($row = $STH->fetch()) 
		             {  
                       $product_id = $row['product_id'];
                       $product_name = $row['product_name'];
                       $quantity = $row['quantity'];
                       $category_name = $row['category_name'];
                       $product_price = $row['product_price'];
                         
                       echo "<tr>";
                       echo "<td><a href='SELECTED_PRODUCT.php?product_id=$product_id'>$product_name</a></td>";
                       echo "<td>$category_name</td>";
                       echo "<td>$product_price</td>";
                       if($quantity < 50)
                       {
                          echo "<td style='color: red'>$quantity</td>";
                       }
                         
                       if($quantity >= 50 && $quantity < 100)
                       {
                          echo "<td style='color: gold'>$quantity</td>";
                       }
                         
                       if($quantity >= 100)
                       {
                          echo "<td style='color: green'>$quantity</td>";
                       }
                       echo "</tr>";
                    }
                  }
                  
                  if($sortBy == "5")
                  {
                     include('connection.php');
                     $STH = $DBH->prepare("SELECT product_id, product_name, quantity, category_name, product_price FROM product INNER JOIN category USING (category_id) ORDER BY product_price DESC");
		             $STH->execute(); 
                      
                     while($row = $STH->fetch()) 
		             {  
                       $product_id = $row['product_id'];
                       $product_name = $row['product_name'];
                       $quantity = $row['quantity'];
                       $category_name = $row['category_name'];
                       $product_price = $row['product_price'];
                         
                       echo "<tr>";
                       echo "<td><a href='SELECTED_PRODUCT.php?product_id=$product_id'>$product_name</a></td>";
                       echo "<td>$category_name</td>";
                       echo "<td>$product_price</td>";
                       if($quantity < 50)
                       {
                          echo "<td style='color: red'>$quantity</td>";
                       }
                         
                       if($quantity >= 50 && $quantity < 100)
                       {
                          echo "<td style='color: gold'>$quantity</td>";
                       }
                         
                       if($quantity >= 100)
                       {
                          echo "<td style='color: green'>$quantity</td>";
                       }
                       echo "</tr>";
                    }
                  }
                   
                  if($sortBy == "6")
                  {
                     include('connection.php');
                     $STH = $DBH->prepare("SELECT product_id, product_name, quantity, category_name, product_price FROM product INNER JOIN category USING (category_id) ORDER BY quantity DESC");
		             $STH->execute(); 
                      
                     while($row = $STH->fetch()) 
		             {  
                       $product_id = $row['product_id'];
                       $product_name = $row['product_name'];
                       $quantity = $row['quantity'];
                       $category_name = $row['category_name'];
                       $product_price = $row['product_price'];
                         
                       echo "<tr>";
                       echo "<td><a href='SELECTED_PRODUCT.php?product_id=$product_id'>$product_name</a></td>";
                       echo "<td>$category_name</td>";
                       echo "<td>$product_price</td>";
                       if($quantity < 50)
                       {
                          echo "<td style='color: red'>$quantity</td>";
                       }
                         
                       if($quantity >= 50 && $quantity < 100)
                       {
                          echo "<td style='color: gold'>$quantity</td>";
                       }
                         
                       if($quantity >= 100)
                       {
                          echo "<td style='color: green'>$quantity</td>";
                       }
                       echo "</tr>";
                    }
                  }
                   
                  if($sortBy == "7")
                  {
                     include('connection.php');
                     $STH = $DBH->prepare("SELECT product_id, product_name, quantity, category_name, product_price FROM product INNER JOIN category USING (category_id) ORDER BY category_name DESC");
		             $STH->execute(); 
                      
                     while($row = $STH->fetch()) 
		             {  
                       $product_id = $row['product_id'];
                       $product_name = $row['product_name'];
                       $quantity = $row['quantity'];
                       $category_name = $row['category_name'];
                       $product_price = $row['product_price'];
                         
                       echo "<tr>";
                       echo "<td><a name='product' href='SELECTED_PRODUCT.php?product_id=$product_id'>$product_name</a></td>";
                       echo "<td>$category_name</td>";
                       echo "<td>$product_price</td>";
                         
                       if($quantity < 50)
                       {
                          echo "<td style='color: red'>$quantity</td>";
                       }
                         
                       if($quantity >= 50 && $quantity < 100)
                       {
                          echo "<td style='color: gold'>$quantity</td>";
                       }
                         
                       if($quantity >= 100)
                       {
                          echo "<td style='color: green'>$quantity</td>";
                       }
                       echo "</tr>";
                    }
                  }
                  
                  if($sortBy == "0")
                  {
                     include('connection.php');
                     $STH = $DBH->prepare("SELECT product_id, product_name, quantity, category_name, product_price FROM product INNER JOIN category USING (category_id)");
		             $STH->execute(); 
                      
                     while($row = $STH->fetch()) 
		             {  
                       $product_id = $row['product_id'];
                       $product_name = $row['product_name'];
                       $quantity = $row['quantity'];
                       $category_name = $row['category_name'];
                       $product_price = $row['product_price'];
                         
                       echo "<tr>";
                       echo "<td><a href='SELECTED_PRODUCT.php?product_id=$product_id'>$product_name</a></td>";
                       echo "<td>$category_name</td>";
                       echo "<td>$product_price</td>";
                       if($quantity < 50)
                       {
                          echo "<td style='color: red'>$quantity</td>";
                       }
                         
                       if($quantity >= 50 && $quantity < 100)
                       {
                          echo "<td style='color: gold'>$quantity</td>";
                       }
                         
                       if($quantity >= 100)
                       {
                          echo "<td style='color: green'>$quantity</td>";
                       }
                       echo "</tr>";
                    }
                  }
               }
           
               else
               {
                  include('connection.php');
                  $STH = $DBH->prepare("SELECT product_id, product_name, quantity, category_id, category_name, product_price  FROM product INNER JOIN category USING (category_id)");
		          $STH->execute();
                   
                  while($row = $STH->fetch()) 
		          {  
                    $product_id = $row['product_id'];
                    $product_name = $row['product_name'];
                    $quantity = $row['quantity'];
                    $category_name = $row['category_name'];
                    $product_price = $row['product_price'];
                    echo "<tr>";
                    echo "<td><a href='SELECTED_PRODUCT.php?product_id=$product_id'>$product_name</a></td>";
                    echo "<td>$category_name</td>";
                    echo "<td>$product_price</td>";
                    if($quantity < 50)
                    {
                      echo "<td style='color: red'>$quantity</td>";
                    }
                         
                    if($quantity >= 50 && $quantity < 100)
                    {
                      echo "<td style='color: gold'>$quantity</td>";
                    }
                         
                    if($quantity >= 100)
                    {
                      echo "<td style='color: green'>$quantity</td>";
                    }
                    echo "</tr>";  
                  }
            
               }
            ?>
	   </tbody>
      </table>
     </form>
     <br/> 
     <footer>
       <a style="font-weight: bold; color: #000000; font-size: 25px;" href="ADD_PRODUCT.php" id="add">Add Product</a><br/>
     <a style="font-weight: bold; color: #000000; font-size: 25px;" href="QMDB_ADMIN.php" id="return">Return to homepage</a>
    </footer>
     
 
   </body>
</html>
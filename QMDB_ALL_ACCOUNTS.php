<?php
	session_start();
    include('connection.php');
	if(!(isset($_SESSION['adminLogged'])))
    {
		header("Location: admin_login.php");
	}

    if(isset($_POST['submit_suspend']) && isset($_POST['userID']) && isset($_POST['time']))
    {
        $val = $_POST['time'];
        $time = (int)$val;
           
        
        $STH = $DBH->prepare("UPDATE users SET banned_until = DATE_ADD(NOW(), INTERVAL $val DAY) WHERE user_id='".$_POST['userID']."'");
        $STH->execute();
        header("Location: QMDB_ALL_ACCOUNTS.php");
    }
    
    if(isset($_POST['remove_suspend']) && isset($_POST['userID']))
    {
        $STH = $DBH->prepare("UPDATE users SET banned_until = null WHERE user_id='".$_POST['userID']."'");
        $STH->execute();
        header("Location: QMDB_ALL_ACCOUNTS.php");
    }

    if(isset($_POST["submit_delete"]))
    {
        $STH = $DBH->prepare("DELETE FROM users WHERE user_id = '$user_id'");
        $STH->execute();
        header("Location: QMDB_ALL_ACCOUNTS.php");
    }
?>

<html> 
   <head>
		    <link rel="stylesheet" type="text/css" href="QMDB_01.css">
      <style>
         #user {
        font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
        }

        #user td, #customers th {
        border: 1px solid #ddd;
        text-align: left;
        padding: 8px;
        }

        #user tr:nth-child(even){background-color: #f2f2f2}

        #user tr:hover {background-color: #ddd;}

        #user th {
        padding-top: 12px;
        padding-bottom: 12px;
        background-color: #0D8FBA;
        color: white;
        }
          
        #suspend {
        font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 35%;
        }
        
        #suspend td, #customers th {
        border: 1px solid #ddd;
        text-align: left;
        padding: 8px;
        }
          
        #suspend tr:nth-child(even){background-color: #f2f2f2}
          
        #suspend tr:hover {background-color: #ddd;}

        #suspend th {
        padding-top: 12px;
        padding-bottom: 12px;
        background-color: #0D8FBA;
        color: white;
        }  
           
        #remove {
        font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 35%;
        }

        #remove td, #customers th {
        border: 1px solid #ddd;
        text-align: left;
        padding: 8px;
        }

        #remove tr:nth-child(even){background-color: #f2f2f2}

        #remove tr:hover {background-color: #ddd;}

        #remove th {
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
       <h1 style="font-size: 50px;">LIST OF ALL EXISTING ACCOUNTS</h1>
       
       <!--Sort-->
       <form action="QMDB_ALL_ACCOUNTS.php" method="post" id="sort">
            <label style="font-weight: bold; color: #000000; font-size: 20px;">Sort by:</label> <select id="sortBy" name="sortBy">
              <?php $sortBy = $_POST["sortBy"]; ?>
              <option value="0" <?php if($sortBy == "0") { ?>selected <?php } ?> >--</option>
              <option value="1" <?php if($sortBy == "1") { ?>selected <?php } ?> >BANNED ACCOUNTS</option>
              <option value="2" <?php if($sortBy == "2") { ?>selected <?php } ?> >NON-BANNED ACCOUNTS</option>
            </select>
            <input type="submit" name="sort" value="Sort">
          </form>
       
      <!--Retrieve user table-->
      <form action="" method="post">
                <table border="1" id="user">
                <thead>
                    <tr>
                        <th>User ID</th>
                        <th>Username</th>
						<th>Role</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Date of Birth</th>
                        <th>Gender</th>
                        <th>Email</th>
                        <th>Banned until</th>
                        <th></th>
                    </tr>
                </thead>
 <?php
       if(isset($_POST['sort']))
       {
           $sortBy = $_POST['sortBy'];
                  if($sortBy == "1")
                  {
                     include('connection.php');
					$STH = $DBH->prepare("SELECT user_id, username, user_first_name, user_last_name, user_dob, user_gender, user_email, banned_until, role_name FROM users INNER JOIN role USING (role_id) WHERE banned_until IS NOT NULL");
					$STH->execute();  
					while($row = $STH->fetch()) 
					{  
						$user_id = $row['user_id'];
						$username = $row['username'];
						$f_name = $row['user_first_name'];
						$l_name = $row['user_last_name'];
						$dob = $row['user_dob'];
						$gender = $row['user_gender'];
						$email = $row['user_email'];
						$banned_until = $row['banned_until'];
						$role = $row['role_name'];
			
						echo "<tbody>";
						echo "<tr>";
						echo "<td>$user_id</td>";
						echo "<td>$username</td>";    
						echo "<td>$role</td>";			
						echo "<td>$f_name</td>";          
						echo "<td>$l_name;</td>";          
						echo "<td>$dob</td>";          
						echo "<td>$gender</td>";          
						echo "<td>$email</td>";          
						echo "<td>$banned_until</td>";          
						echo "<td><input type='submit' onclick='return confirm('Delete this account?');' name='submit_delete' value='Delete'/></td>"; 
					}
                      
                  }
                   
                  if($sortBy == "2")
                  {
                      include('connection.php');
					$STH = $DBH->prepare("SELECT user_id, username, user_first_name, user_last_name, user_dob, user_gender, user_email, banned_until, role_name FROM users INNER JOIN role USING (role_id) WHERE banned_until IS NULL");
					$STH->execute();  
					while($row = $STH->fetch()) 
					{  
						$user_id = $row['user_id'];
						$username = $row['username'];
						$f_name = $row['user_first_name'];
						$l_name = $row['user_last_name'];
						$dob = $row['user_dob'];
						$gender = $row['user_gender'];
						$email = $row['user_email'];
						$banned_until = $row['banned_until'];
						$role = $row['role_name'];
			
						echo "<tbody>";
						echo "<tr>";
						echo "<td>$user_id</td>";
						echo "<td>$username</td>";    
						echo "<td>$role</td>";			
						echo "<td>$f_name</td>";          
						echo "<td>$l_name;</td>";          
						echo "<td>$dob</td>";          
						echo "<td>$gender</td>";          
						echo "<td>$email</td>";          
						echo "<td>$banned_until</td>";          
						echo "<td><input type='submit' onclick='return confirm('Delete this account?');' name='submit_delete' value='Delete'/></td>"; 
					}
                  }
                   
                  if($sortBy == "0")
                  {
                     include('connection.php');
					$STH = $DBH->prepare("SELECT user_id, username, user_first_name, user_last_name, user_dob, user_gender, user_email, banned_until, role_name FROM users INNER JOIN role USING (role_id)");
					$STH->execute();  
					while($row = $STH->fetch()) 
					{  
						$user_id = $row['user_id'];
						$username = $row['username'];
						$f_name = $row['user_first_name'];
						$l_name = $row['user_last_name'];
						$dob = $row['user_dob'];
						$gender = $row['user_gender'];
						$email = $row['user_email'];
						$banned_until = $row['banned_until'];
						$role = $row['role_name'];
			
						echo "<tbody>";
						echo "<tr>";
						echo "<td>$user_id</td>";
						echo "<td>$username</td>";    
						echo "<td>$role</td>";			
						echo "<td>$f_name</td>";          
						echo "<td>$l_name;</td>";          
						echo "<td>$dob</td>";          
						echo "<td>$gender</td>";          
						echo "<td>$email</td>";          
						echo "<td>$banned_until</td>";          
						echo "<td><input type='submit' onclick='return confirm('Delete this account?');' name='submit_delete' value='Delete'/></td>"; 
					}
           
                  }
         }
                    
       else
       {
         include('connection.php');
         $STH = $DBH->prepare("SELECT user_id, username, user_first_name, user_last_name, user_dob, user_gender, user_email, banned_until, role_name FROM users INNER JOIN role USING (role_id)");
         $STH->execute();  
		 while($row = $STH->fetch()) 
		 {  
            $user_id = $row['user_id'];
            $username = $row['username'];
            $f_name = $row['user_first_name'];
            $l_name = $row['user_last_name'];
            $dob = $row['user_dob'];
            $gender = $row['user_gender'];
            $email = $row['user_email'];
            $banned_until = $row['banned_until'];
            $role = $row['role_name'];
			
            echo "<tbody>";
            echo "<tr>";
            echo "<td>$user_id</td>";
            echo "<td>$username</td>";    
            echo "<td>$role</td>";			
            echo "<td>$f_name</td>";          
            echo "<td>$l_name;</td>";          
            echo "<td>$dob</td>";          
            echo "<td>$gender</td>";          
            echo "<td>$email</td>";          
            echo "<td>$banned_until</td>";          
            echo "<td><input type='submit' onclick='return confirm('Delete this account?');' name='submit_delete' value='Delete'/></td>"; 
	     }
           
         if(isset($_POST["submit_delete"]))
         {
                $STH = $DBH->prepare("DELETE FROM users WHERE user_id = '$user_id'");
                $STH->execute();
                header("Location: QMDB_INVENTORY.php");
         }
       }
 ?>     
                  
                  </tr>
                </tbody>
        </form>
      </table><br/>
       
    <!--Suspend an account-->
    <form action="" method="post">
        <table border="1" id="suspend" class="one">
          <thead>
             <tr>
                 <th>Suspend an account</th>
             </tr>
          </thead>
            
          <tbody>
              <tr>
                  <td>User ID: <input type="text" name="userID"/></td>
              </tr>
              
              <tr>
                  <td>Time(days): <input type="text" name="time"/></td>
              </tr>
              <tr>
                  <td><input type="submit" name="submit_suspend" value="Suspend"/></td>
                  
              </tr>
        </table>
    
     </form>
     <br/>
       
     <!--Remove Suspension-->
     <form action="" method="post">
        <table border="1" id="remove" class="two">
          <thead>
             <tr>
                 <th>Remove Suspension</th>
             </tr>
          </thead>
            
          <tbody>
              <tr>
                  <td>User ID: <input type="text" name="userID"/></td>
              </tr>
              <tr>
                 <td>
                   <input type="submit" name="remove_suspend" value="Remove"/>
                 </td>
              </tr>
        </table>
        
      <?php
        
      ?>
       </form>
       <a style="font-weight: bold; color: #000000; font-size: 25px;" href="QMDB_ADMIN.php" id="return" href="QMDB_ADMIN.php">Return to homepage</a>
    
   </body>
</html>
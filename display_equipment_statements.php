<?php
class Equipment{
	private $orderTotal = 0;
	function __construct($db){
		$this->db = $db;
	}
	function displayEquipment($query){
		# creating the statement
			$STH = $this->db->query($query);
 
			# setting the fetch mode
			$STH->setFetchMode(PDO::FETCH_OBJ);
			
		
			while($row = $STH->fetch()) {
				print('<li id="productUnit"><img id="productImage" src="data:image/jpeg;base64,'.base64_encode($row->product_image).'"/>
						<ul id="productul"><li id="nameli">'.$row->product_name.'</li>
						<li>'.$row->product_description.'</li>
						<li>Price: $'.$row->product_price.'</li>
						<li>In stock: '.$row->quantity.'</li></ul>
						<form id="addForm" action="equipment.php" method="post">
							<input type="number" min="1" value="1" name="quantity"/>
							<button type="submit" name="addToCart" value='.$row->product_id.'>Add To Cart</button>
						</form></li>');
			}
			
			
	}
	
	function displayCart(){
		# creating the statement
		if((isset($_SESSION['userLogged'])) || (isset($_COOKIE['anonId']))){
			if(isset($_SESSION['userLogged'])){
				$STH = $this->db->prepare("SELECT cart_id, product_image, product_name, product_price, cart.quantity FROM cart
																INNER JOIN product USING(product_id) WHERE user_id = ?");
				$STH->bindParam(1,$_SESSION['userLogged']);
			}
			else{
				$STH = $this->db->prepare("SELECT cart_id, product_image, product_name, product_price, cart.quantity FROM cart
																INNER JOIN product USING(product_id) WHERE anon_id = ?");
				$STH->bindParam(1,$_COOKIE['anonId']);
			}
			# setting the fetch mode
			$STH->execute();
			$STH->setFetchMode(PDO::FETCH_OBJ);
			echo "<ul>";
			while($row = $STH->fetch()) {
				print('<li><img id="productImage" src="data:image/jpeg;base64,'.base64_encode($row->product_image).'">
						<span>'.$row->product_name.'</span>
						<span>Price: $'.$row->product_price.'</span>
						<span>Quantity: '.$row->quantity.'</span>
						<span><form id="deleteForm" action="cart.php" method="post">
							<input type="number" min="1" max="'.$row->quantity.'" value="1" name="quantityToRemove"/>
							<button type="submit" name="removeProduct" value='.$row->cart_id.'>Remove</button>
						</form></span></a></li>');
			
				$this->orderTotal += ($row->product_price * $row->quantity);
			}

			echo '</ul>';
			if($this->orderTotal == 0){
			echo "<div id='empty'>
						<span>Cart is empty</span></br></br>
						<span><a id='backToShop' style='color: #2161EB;'href='equipment.php'>GetBack To Shopping</a></span>
					   </div>";
			}		   
			return $this->orderTotal;
			
		}
			
	}
 
	function displayCategories(){
		# creating the statement
		$STH = $this->db->query('SELECT category_name, category_url from category');
 
		# setting the fetch mode
		$STH->setFetchMode(PDO::FETCH_OBJ);
			
		while($row = $STH->fetch()) {
			print("<li><a id='links' href='$row->category_url'> $row->category_name</a></li>");
		}
	}
	
	function addItemToCart($user, $Id, $productId, $quantity){
		$stmt = $this->db->prepare("SELECT cart_id, quantity from cart WHERE (user_id = ? OR anon_id = ?) AND product_id = ?");
		$stmt->bindParam(1,$Id);
		$stmt->bindParam(2,$Id);
		$stmt->bindParam(3,$productId);
		$stmt->execute();
		$stmt->setFetchMode(PDO::FETCH_OBJ);
		$resultSet = $stmt->fetch();
			
		if($resultSet){
			$newQuantity = ($resultSet->quantity + $quantity);
			$STH = $this->db->prepare('UPDATE cart SET quantity = ? WHERE cart_id = ?');
			$STH->bindParam(1,$newQuantity);
			$STH->bindParam(2,$resultSet->cart_id);
			$STH->execute();
		}
		else{
			if($user == "anon"){
				$STH = $this->db->prepare('INSERT INTO cart (anon_id, product_id, quantity) values (?, ?, ?)');	
				$STH->execute(array($Id, $productId, $quantity));
			}
			else{
				$STH = $this->db->prepare("INSERT INTO cart (user_id, product_id, quantity) values (?, ?, ?)");
				$STH->execute(array($Id, $productId, $quantity));
			}
		}	
	}
	
		function removeItemFromCart($cartId, $quantityToRemove){
		$stmt = $this->db->prepare("SELECT quantity from cart WHERE cart_id = ?");
		$stmt->bindParam(1,$cartId);
		$stmt->execute();
		$stmt->setFetchMode(PDO::FETCH_OBJ);
		$resultSet = $stmt->fetch();
			
		if($resultSet){
			if($quantityToRemove < $resultSet->quantity){
				$newQuantity = ($resultSet->quantity - $quantityToRemove);
				$STH = $this->db->prepare('UPDATE cart SET quantity = ? WHERE cart_id = ?');
				$STH->bindParam(1,$newQuantity);
				$STH->bindParam(2,$cartId);
				$STH->execute();
			}
			else{
				$STH = $this->db->prepare('DELETE FROM cart WHERE cart_id = ?');
				$STH->bindParam(1,$cartId);
				$STH->execute();	
			}
		}
	}
	
	function registerUser($uname, $password, $fname, $lname, $dob, $gender, $email){
			$roleId = 1;
			$dateFormatDob = date('Y-m-d', strtotime($dob));
			$STH = $this->db->prepare("INSERT INTO users (username, password, user_first_name, user_last_name, user_dob, user_gender, user_email, user_role_id) values (?, ?, ?, ?, ?, ?, ?, ?)");
			$STH->bindParam(1, $uname);
			$STH->bindParam(2, $password);
			$STH->bindParam(3, $fname);
			$STH->bindParam(4, $lname);
			$STH->bindParam(5, $dateFormatDob);
			$STH->bindParam(6, $gender);
			$STH->bindParam(7, $email);
			$STH->bindParam(8, $roleId);
			$executeResult = $STH->execute();
			if($executeResult){
				return true;
			}
			else{
				return false;
			}
	}
	
	function login($username, $password, $anon_id){
		
		$STH = $this->db->prepare("SELECT user_id from USERS WHERE username = ? AND password = ?");
		$STH->bindParam(1, $username);
		$STH->bindParam(2, $password);
		$STH->execute();
		$STH->setFetchMode(PDO::FETCH_OBJ);
		$resultSet = $STH->fetch();
		
		if(!$resultSet){
			return 0;
		}
		else{
			$user_id = $resultSet->user_id;
			if($anon_id != ""){
				$nullvalue = NUll;
				$stmt = $this->db->prepare("UPDATE cart SET user_id = ?, anon_id = ? WHERE anon_id = ?");
				$stmt->bindParam(1, $user_id);
				$stmt->bindParam(2, $nullvalue);
				$stmt->bindParam(3, $anon_id);
				$stmt->execute();
				echo "$user_id";
				session_start();
				$_SESSION["user_id"] = $user_id;
			}
			return $user_id;
		}
	}
	
	function checkout($user_id, $address, $city, $state, $zipCode, $country, $cardType, $cardNumber, $cardHolder, $securityPin, $expirationDate){
		$STH = $this->db->prepare("SELECT * from payment_method WHERE user_id = ?");
		$STH->bindParam(1, $user_id);
		$STH->execute();
		$STH->setFetchMode(PDO::FETCH_OBJ);
		$resultSet = $STH->fetch();
		
		$dateFormatexpirationDate = date('Y-m-d', strtotime($expirationDate));
		if($resultSet){
			$stmt = $this->db->prepare("UPDATE payment_method SET card_type = ?, card_number = ?, card_holder = ?, security_pin = ?, expiration_date = ?  WHERE user_id = ?");
			$stmt->bindParam(1, $cardType);
			$stmt->bindParam(2, $cardNumber);
			$stmt->bindParam(3, $cardHolder);
			$stmt->bindParam(4, $securityPin);
			$stmt->bindParam(5, $dateFormatexpirationDate);
			$stmt->bindParam(6, $user_id);
			$stmt->execute();
		}	
		else{
			$stmt = $this->db->prepare('INSERT INTO payment_method (card_type, card_number, card_holder, security_pin, expiration_date, user_id) values (?, ?, ?, ? ,?, ?)');	
			$stmt->execute(array($cardType, $cardNumber, $cardHolder, $securityPin, $dateFormatexpirationDate, $user_id));
		}
		
		$STH = $this->db->prepare("SELECT * from address WHERE user_id = ?");
		$STH->bindParam(1, $user_id);
		$STH->execute();
		$STH->setFetchMode(PDO::FETCH_OBJ);
		$resultSet = $STH->fetch();
		
		if($resultSet){
			$stmt = $this->db->prepare("UPDATE address SET street_address = ?, city = ?, state_province = ?, postal_code = ?, country = ?  WHERE user_id = ?");
			$stmt->bindParam(1, $address);
			$stmt->bindParam(2, $city);
			$stmt->bindParam(3, $state);
			$stmt->bindParam(4, $zipCode);
			$stmt->bindParam(5, $country);
			$stmt->bindParam(6, $user_id);
			$stmt->execute();
		}	
		else{
			$stmt = $this->db->prepare('INSERT INTO address (street_address, city, state_province, postal_code, country, user_id) values (?, ?, ?, ? ,?, ?)');	
			$stmt->execute(array($address, $city, $state, $zipCode, $country, $user_id));
		}
		
		$addressId = "";
		$paymentId = "";
		$STH = $this->db->prepare("SELECT address_id from address WHERE user_id = ?");
		$STH->bindParam(1, $user_id);
		$STH->execute();
		$STH->setFetchMode(PDO::FETCH_OBJ);
		$resultSet = $STH->fetch();		
		if($resultSet){
			$addressId = $resultSet->address_id;
		}
		$STH = $this->db->prepare("SELECT payment_method_id from payment_method WHERE user_id = ?");
		$STH->bindParam(1, $user_id);
		$STH->execute();
		$STH->setFetchMode(PDO::FETCH_OBJ);
		$resultSet = $STH->fetch();		
		if($resultSet){
			$paymentId = $resultSet->payment_method_id;
		}

		$stmt = $this->db->prepare('INSERT INTO orders(order_date, payment_id, user_id, address_id) values (?, ?, ?, ?)');	
		$stmt->execute(array(date('Y-m-d'),$paymentId, $user_id, $addressId));
		
		$orderId = $this->db->lastInsertId();
		echo "$orderId";
		$STH = $this->db->prepare("SELECT cart.product_id, product_price, cart.quantity FROM cart INNER JOIN product ON cart.product_id = product.product_id WHERE user_id = ?");
		$STH->bindParam(1, $user_id);
		$STH->execute();
		$STH->setFetchMode(PDO::FETCH_OBJ);
		while($row = $STH->fetch()){
			$stmt = $this->db->prepare('INSERT INTO order_detail(product_id, item_price, quantity, order_id) values (?, ?, ?, ?)');	
			$stmt->execute(array($row->product_id, $row->product_price, $row->quantity, $orderId));
		}
		
		$stmt = $this->db->prepare("DELETE from cart WHERE user_id = ?");
		$stmt->bindParam(1, $user_id);
		$stmt->execute();
		return $orderId;
	}
	
	function signOut(){
		session_destroy();
	}
	
	function test_input($regex, $input){
		if (!preg_match($regex, $input)) {
			return false; 
		}
		else{
			return true;
		}	
	}

	function createMonthSelectionList($values){
		print '<select required="required" name="month">';
		echo '<option value="" disabled selected>Month</option>';
		for($i = 0; $i < count($values); ++$i){
			echo '<option value="',($i+1),'">',$values[$i],'</option>';
		}
		print "</select>";
	}
	
	function createDaySelectionList($min, $max){
		print '<select required="required" name="day">';
		echo '<option value="" disabled selected>Day</option>';
		while($min <= $max){
			echo '<option value="',$min,'">',$min,'</option>';
			++$min;
		}
		print "</select>";
	}
	
	function createYearSelectionList($max, $min){
		print '<select id="selectYear" required="required" name="year">';
		echo '<option value="" disabled selected>Year</option>';
		while($max >= $min){
			echo '<option value="',$max,'">',$max,'</option>';
			--$max;
		}
		print "</select>";
	}
	
	function createCountrySelectionList(){
		$STH = $this->db->query("SELECT * FROM country");
		$STH->setFetchMode(PDO::FETCH_OBJ);
		
		print '<select id="selectCountry" required="required" name="country">';
		echo '<option value="" disabled selected>--Select Country--</option>';
		
		while($row = $STH->fetch()) {
			echo '<option value="',$row->country,'">',$row->country,'</option>';
		}
		print "</select>";
	}
	
	function displayCardTypes(){
		
		print '<select id="selectCard" required="required" name="cardType">';
		echo '<option value="" disabled selected>--Select Country--</option>';
		$cardTypes = array("Visa", "MasterCard", "Discover", "American Express");
		for($i = 0; $i < count($cardTypes); ++$i) {
			echo '<option value="',$cardTypes[$i],'">',$cardTypes[$i],'</option>';
		}
		print "</select>";
	}
	
	function displayCustomerInfo($userId){
		$STH = $this->db->prepare("SELECT * FROM users WHERE user_id = ?");
		$STH->bindParam(1,$userId);
		$STH->execute();
		$STH->setFetchMode(PDO::FETCH_OBJ);
		
		while($row = $STH->fetch()){
			echo '<label class="identifier">Username</label><label class="value">',$row->username,'</label>
				  <label class="identifier">First Name</label><label class="value">',$row->user_first_name,'</label>
				  <label class="identifier">Last Name</label><label class="value">',$row->user_last_name,'</label>
				  <label class="identifier">Date Of Birth</label><label class="value">',$row->user_dob,'</label>
				  <label class="identifier">Gender</label><label class="value">',$row->user_gender,'</label>
				  <label class="identifier">Email</label><label class="value">',$row->user_email,'</label>';
		}
	}
	
	function displayCustomerOrders($user_Id){
		$STH = $this->db->prepare("SELECT order_id, order_date FROM orders WHERE user_id = ?");
		$STH->bindParam(1,$user_Id);
		$STH->execute();
		$STH->setFetchMode(PDO::FETCH_OBJ);
		
		while($row = $STH->fetch()){
			echo '<label id="orderId">ORDER ID:',$row->order_id,'</label></br>';
			echo '<label id="orderDate">Placed On:',$row->order_date,'</label></br>';
			
			$stmt = $this->db->prepare("SELECT product.product_name, product.product_price, order_detail.quantity FROM order_detail
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
	}
	
	function orderDetail($orderId){
		echo '<label id="orderId">ORDER ID:',$orderId,'</label>';
			$stmt = $this->db->prepare("SELECT product.product_name, product.product_price, order_detail.quantity FROM order_detail
														INNER JOIN product USING (product_id)
													WHERE order_id = ?");
			$stmt->bindParam(1,$orderId);
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
			echo '</table>';
		}
	}
	

		

?>


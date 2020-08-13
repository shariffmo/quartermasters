
<?php
		ShowForm();
			
			if (isset($_POST['calculate'])) 
			{
					$number1 = $_POST["number1"];
					$number2 = $_POST["number2"];
					$op = $_POST['operators'];		
					$result = Calculate($number1,$op,$number2);
					echo $result;
			}
			
			function Calculate($num1, $op, $num2){
				
				if($op == "+"){
					return $num1 + $num2;
				}
				else if($op == "*"){
					return $num1 * $num2;
				}
				else if($op == "-"){
					return $num1 - $num2;
				}
				else{
					return $num1 / $num2;
				}
			}
			
			function ShowForm(){
				 echo "<form action='assignment.php' method='post'>
			<input type='NUMBER' name='number1'>First Number</input>
			<select name='operators'>
			<option value='+'> + </option>
			<option value='*'> * </option>
			<option value='-'> - </option>
			<option value='/'> / </option>
			</select>
			<input type='NUMBER' name='number2'>Second Number</input>
			<input type='submit' name='calculate'/>
		</form> ";
			}
		?>
<?php
		function ShowForm(){
				 echo "<form action='calc.php' method='post'>
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
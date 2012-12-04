<?php session_start(); ?>
<html>
<?php include('header.php'); ?>

			<form method="post" action="saveInstructor.php" name="addInstructor">
			<h2 align="center">Add Instructor</h2>
			
			First Name<br /><input type="text" name="data[instructor][fName]" /><br />

			Last Name<br /><input type="text" name="data[instructor][lName]" /><br />

			Instructor Title<br /><input type="text" name="data[instructor][title]" /><br />

			University ID<br /><input type="text" name="data[instructor][dir_id]" /><br />

			Instructor Bio<br />
			<textarea name="data[instructor][bio]" cols="100" rows="15"></textarea><br />

			Instructor Image Link<br /><input type="text" name="data[instructor][image_link]" /><br />
			
			<br />
			<input type="submit" value="Save" /><br />
			
			</form>	
		</div>
	</div>
</div>

	
</body>
</html>
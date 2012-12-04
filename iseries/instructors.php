<?php session_start(); ?>
<html>
<?php include('header.php'); ?>
			<?php
			$getAllInstructorsSql = "select * from iseries_instructors";
			$resultSet = mysql_query($getAllInstructorsSql) or die('Unable to retrieve instructor list');
			
			while ($row = mysql_fetch_array($resultSet, MYSQL_NUM)) {
				printf("ID: %s <br /> First Name: %s<br />", $row[0], $row[1]);  
			}

			mysql_free_result($resultSet);
			
			?>
				
				
			</div>
		</div>
	</div>

	
</body>
</html>
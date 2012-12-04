<?php session_start(); ?>
<html>
<?php include('header.php'); ?>

			<?php
			$getAllCoursesSql = "select * from iseries_courses";
			$resultSet = mysql_query($getAllCoursesSql) or die('Unable to retrieve courses list');
			
			while ($row = mysql_fetch_array($resultSet, MYSQL_NUM)) {
				printf("ID: %s <br /> Title: %s<br />", $row[0], $row[4]);  
			}

			mysql_free_result($resultSet);
			
			?>
				
				
			</div>
		</div>
	</div>

	
</body>
</html>
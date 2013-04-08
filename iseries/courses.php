<?php session_start(); ?>
<html>
<?php include('header.php'); ?>

			<?php
			$getAllCoursesSql = "select * from iseries_courses";
			$resultSet = mysql_query($getAllCoursesSql) or die('Unable to retrieve courses list');
			
			if($resultSet!=null && mysql_num_rows($resultSet)>0){
				$sno = 0;
				echo '<table class="iseriesTbl">';
				echo "<thead><tr><td>S.No.</td><td>Course Number</td><td>Course Title</td></tr></thead>";
				while ($row = mysql_fetch_array($resultSet, MYSQL_NUM)) {
					echo "<tr>";
					echo "<td>".++$sno."</td>";
					echo "<td>".$row[1].$row[2].$row[3]."</td>";
					//addEditCourse.php?courseId=3
					echo "<td><a href=addEditCourse.php?courseId=".$row[0].">".$row[4]."</a></td>";
					//printf("ID: %s <br /> Title: %s<br />", $row[0], $row[4]);  
					echo "</tr>";
				}
				
				echo "</table>";
			}
			mysql_free_result($resultSet);
			?>
			</div>
		</div>
	</div>
</body>
</html>
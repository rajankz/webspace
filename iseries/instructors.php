<?php session_start(); ?>
<html>
<?php include('header.php'); ?>

			<?php
			$getAllInstructorsSql = "select * from iseries_instructors";
			$resultSet = mysql_query($getAllInstructorsSql) or die('Unable to retrieve instructor list');
			
			if($resultSet!=null && mysql_num_rows($resultSet)>0){
				$sno = 0;
				echo '<table class="iseriesTbl">';
				echo "<thead><tr><td>S.No.</td><td>University Id</td><td>Instructor Name</td></tr></thead>";
				while ($row = mysql_fetch_array($resultSet, MYSQL_NUM)) {
					echo "<tr>";
					echo "<td>".++$sno."</td>";
					echo "<td>".$row[4]."</td>";
					//addEditInstructor.php?instId=1
					echo "<td><a href=addEditInstructor.php?instId=".$row[0].">".$row[3]." ".$row[1]." ".$row[2]."</a></td>"; 
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
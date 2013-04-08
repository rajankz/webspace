<?php session_start(); ?>
<html>
<?php include('header.php'); ?>
		<?php
			$editInstId = $_GET['instId'];
			$editInst = false;
			if($editInstId){
				$event = "Edit";
				$editInst=true;
			}
			else
				$event = "Add";
		?>

			<form method="post" action="saveInstructor.php" name="addInstructor">
			<h2 align="center"><?=$event;?> Instructor</h2>
			<?php
			//get instructor values
			$fName="";
			$lName="";
			$title="";
			$dire_id="";
			$bio="";
			$image_link="";
			
			if($editInst){
				echo '<input type="hidden" name="data[inst][id]" value='.$editInstId.' />';
				$selectInstSql = "select * from iseries_instructors where id=".$editInstId;
				$selectCourseInstSql = "select distinct(course_id) from iseries_course_instructors where instructor_id=".$editInstId;
			
			$instResultSet = mysql_query($selectInstSql) or die("Unable to execute query ".$selectInstSql);
			$courseInstResultSet = mysql_query($selectCourseInstSql) or die("Unable to execute query ".$selectCourseInstSql);
	
			$row = mysql_fetch_array($instResultSet, MYSQL_NUM);
			$instFName = "value='".$row[1]."'";
			$instLName="value='".$row[2]."'";
			$instTitle="value='".$row[3]."'";
			$instDirId="value='".$row[4]."'";
			$instBio="".$row[5]."";
			$instImageLink="value='".$row[6]."'";
				
			}
			
			?>
			<br />
			First Name<br /><input type="text" name="data[inst][fName]" <?=$instFName?> /><br />

			Last Name<br /><input type="text" name="data[inst][lName]" <?=$instLName?> /><br />

			Instructor Title<br /><input type="text" name="data[inst][title]" <?=$instTitle?> /><br />

			University ID<br /><input type="text" name="data[inst][dir_id]" <?=$instDirId?> /><br />

			Instructor Bio<br />
			<textarea name="data[inst][bio]" cols="100" rows="15"><?=$instBio?></textarea><br />

			Instructor Image Link<br /><input type="text" name="data[inst][image_link]" <?=$instImageLink?> /><br />

			
			The instructor teaches/taught the following courses: <br />

			<div>

			<?php
				include_once('functions.php');
				$iseries = new ISeries();
				$iseries->createCourseOptions();
				$options = $iseries->getCourseOptions();		
			?>
			<script type="text/javascript">
				function addCourse(tableID) {
				    var table = document.getElementById(tableID);
				    var rowCount = table.rows.length;
				    var row = table.insertRow(rowCount);
				    rowNum = rowCount;
				    
				    var cell1 = row.insertCell(0);
				    var element1 = document.createElement("input");
				    element1.type = "checkbox";
				    cell1.appendChild(element1);
				
				    var cell2 = row.insertCell(1);
				    var oneCourse = document.createElement("select");
				    oneCourse.setAttribute("id", "InstructorCourse"+rowNum);
				    oneCourse.setAttribute("name", "data[inst][course]["+rowNum+"]");
				    oneCourse.innerHTML = '<?=$options;?>';
				    cell2.appendChild(oneCourse);
				}
			</script>
			<table id="courseList">
			<?php
				if($courseInstResultSet!=null && mysql_num_rows($courseInstResultSet)>0){
					$courseOrder = 0;
					echo "<tbody>";
					while($row = mysql_fetch_array($courseInstResultSet, MYSQL_NUM)){
						echo "<tr>";
						echo '<td><input type="checkbox" ></td>';
						echo '<td><select id="InstCourse'.$courseOrder.'" name="data[inst][course]['.$courseOrder.']">';
						
						$selectedCourseOptions = $iseries->createCourseOptionsSelected($row[0]);
						echo $selectedCourseOptions;
						echo '</select></td>';
						echo "</tr>";
						$courseOrder++;
					}					
					echo "</tbody>";
				}
			?>
			</table>
			<input type="button" onclick="addCourse('courseList')" value="Add Course" />
			<input type="button" onclick="removeElement('courseList')" value="Remove Course" />
			<!-- show option for profs and remove them if not needed -->
			</div>
			<br />
			
			
						
			<br />
			<input type="submit" value="Save" /><br />
			
			</form>	
		</div>
	</div>
</div>

	
</body>
</html>



			 
		
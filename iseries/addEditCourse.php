<?php session_start(); ?>
<html>
<?php include('header.php'); ?>

		<?php
			$editCourseId = $_GET['courseId'];
			$editCourse = false;
			$formAction="saveCourse.php";
			$formName="saveCourse";
			if($editCourseId){
				$event = "Edit";
				$editCourse=true;
				//$formAction="updateCourse.php";
				//$formName="updateCourse";
			}
			else
				$event = "Add";
		?>

			<form method="post" action="<?=$formAction?>" name="<?=$formName?>">
			<h2 align="center"><?=$event;?> Course</h2>
			
			<?php
			//get the course values
			
			$coursePrefix = "";
			$courseNum="";
			$courseSuffix="";
			$courseTitle="";
			$courseDesc="";
			$courseLink="";
			$courseIsCore="";				 
			
			if($editCourse){
				echo '<input type="hidden" name="data[course][id]" value='.$editCourseId.' />';
				$selectCourseSql = "select * from iseries_courses where id=".$editCourseId;
			$selectCourseInstSql = "select distinct(instructor_id) from iseries_course_instructors where course_id=".$editCourseId;
			
			$courseResultSet = mysql_query($selectCourseSql) or die("Unable to execute query ".$selectCourseSql);
			$courseInstResultSet = mysql_query($selectCourseInstSql) or die("Unable to execute query ".$selectCourseInstSql);
	
			$row = mysql_fetch_array($courseResultSet, MYSQL_NUM);
			$coursePrefix = "value='".$row[1]."'";
			$courseNum="value='".$row[2]."'";
			$courseSuffix="value='".$row[3]."'";
			$courseTitle="value='".$row[4]."'";
			$courseDesc="".$row[5]."";
			$courseLink="value='".$row[6]."'";
			$courseIsCore="selected=".($row[7]?"selected":"");
				
			}
			?>
			<br />
			Course Prefix<br /><input type="text" name="data[course][prefix]" <?=$coursePrefix?> /><br />

			Course Number<br /><input type="text" name="data[course][num]" <?=$courseNum?> /><br />

			Course Suffix<br /><input type="text" name="data[course][suffix]" <?=$courseSuffix?> /><br />

			Course Title<br /><input type="text" name="data[course][title]" <?=html_entity_decode($courseTitle)?> /><br />

			Course Description<br />
			<textarea name="data[course][description]" cols="100" rows="15" ><?=$courseDesc?></textarea><br />

			Course Link<br /><input type="text" name="data[course][link]" <?=$courseLink?> /><br />

			<label><input type="checkbox" name="data[course][is_core]" <?=$courseIsCore?> /> 
			Is Core Course</label><br />
			
			Instructors who teach/taught this course<br />

			<div>

			<?php
				include_once('functions.php');
				$iseries = new ISeries();
				$iseries->createInstOptions();
				$options = $iseries->getInstOptions();		
			?>
			<script type="text/javascript">
				function addInstructor(tableID) {
				    var table = document.getElementById(tableID);
				    var rowCount = table.rows.length;
				    var row = table.insertRow(rowCount);
				    rowNum = rowCount;
				    
				    var cell1 = row.insertCell(0);
				    var element1 = document.createElement("input");
				    element1.type = "checkbox";
				    cell1.appendChild(element1);
				
				    var cell2 = row.insertCell(1);
				    var oneInst = document.createElement("select");
				    oneInst.setAttribute("id", "InstructorCourse"+rowNum);
				    oneInst.setAttribute("name", "data[course][instructor]["+rowNum+"]");
				    oneInst.innerHTML = '<?=$options;?>';
				    cell2.appendChild(oneInst);
				}
			</script>
			<table id="instructorsList">
			<?php
				if($courseInstResultSet!=null && mysql_num_rows($courseInstResultSet)>0){
					$instOrder = 0;
					echo "<tbody>";
					while($row = mysql_fetch_array($courseInstResultSet, MYSQL_NUM)){
						echo "<tr>";
						echo '<td><input type="checkbox" ></td>';
						echo '<td><select id="InstructorCourse'.$instOrder.'" name="data[course][instructor]['.$instOrder.']">';
						
						$selectedInstOptions = $iseries->createInstOptionsSelected($row[0]);
						echo $selectedInstOptions;
						echo '</select></td>';
						echo "</tr>";
						$instOrder++;
					}					
					echo "</tbody>";
				}
			?>
			</table>
			<input type="button" onclick="addInstructor('instructorsList')" value="Add Instructor" />
			<input type="button" onclick="removeElement('instructorsList')" value="Remove Instructor" />
			<!-- show option for profs and remove them if not needed -->
			</div>
			<br />
			<input type="submit" value="Save" /><br />
			
			</form>	

		</div>
	</div>
</div>

	
</body>
</html>
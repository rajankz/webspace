<?php session_start(); ?>
<?php include('config.inc'); ?>
<?php //print_r($_POST); ?>
<?php
if(isset($_POST['data']['course'])){
	$coursePrefix = $_POST['data']['course']['prefix'];
	$courseNum = $_POST['data']['course']['num'];
	$courseSuffix = $_POST['data']['course']['suffix'];
	$courseTitle = $_POST['data']['course']['title'];
	$courseDescription = $_POST['data']['course']['description'];
	$courseLink = $_POST['data']['course']['link'];
	$courseIsCore = $_POST['data']['course']['is_core']=='on'?1:0;
	
	if($coursePrefix=="" || $courseNum=="" || $courseSuffix=="" || $courseTitle=="" || $courseDescription=="" || $courseLink==""){
		$_SESSION['msg']="All course fields are mandatory";
		$_SESSION['msg_type']="error";
		header("Location: courses.php");
		exit;
	}
	$courseId = $_POST['data']['course']['id'];
	if($courseId){
		$saveCourseSql = "update iseries_courses set 
	prefix='$coursePrefix', num='$courseNum', suffix='$courseSuffix', title='$courseTitle',
	description='$courseDescription', link='$courseLink', is_core='$courseIsCore'
	where id='$courseId'";
	}
	else{
	$saveCourseSql = "insert into iseries_courses(prefix, num, suffix, title, description, link, is_core) values('$coursePrefix', '$courseNum', '$courseSuffix', '$courseTitle', '$courseDescription', '$courseLink', '$courseIsCore')";
	}
	
	$result = mysql_query($saveCourseSql) or die('unable to execute query: '.$saveCourseSql);
	
	if(!$result){
		$_SESSION['msg']="Unable to save the course information. Please try later.";
		$_SESSION['msg_type']="error";
		header("Location: courses.php");
		exit;
	}
	if(!$courseId)
		$courseId = mysql_insert_id();
	$orderNegate = 0;
	
	if(isset($_POST['data']['course']['instructor'])){	
		foreach($_POST['data']['course']['instructor'] as $key=>$instructorId){
			$selectOneCourseInstSql = "select * from iseries_course_instructors where course_id=".$courseId." and ci_order=".($key+$orderNegate);
			$selectCourseInstResult = mysql_query($selectOneCourseInstSql) or die("Unable to perform query ".$selectOneCourseInstSql);
			if(mysql_num_rows($selectCourseInstResult)>0){
				if($instructorId==""){
					$orderNegate-=1;
					continue;
				}else{
					$updateOneCourseInstSql = "update iseries_course_instructors set instructor_id=".$instructorId." where course_id=".$courseId." and ci_order=".($key+$orderNegate);
					$updateCourseInstResult = mysql_query($updateOneCourseInstSql) or die('unable to execute query: '.$updateOneCourseInstSql);
				if(!$updateCourseInstResult){
					$_SESSION['msg']="Unable to update the course-instructor information. Please try later.";
					$_SESSION['msg_type']="error";
					header("Location: courses.php");
					exit;
				}
			  }			
			}else{
				if($instructorId==""){
					$orderNegate-=1;
					continue;
				}
				$order = $key + $orderNegate;
				$saveCourseInstSql = "insert into iseries_course_instructors(course_id, instructor_id, ci_order) values(".$courseId.",".$instructorId.",".$order.")";
				$courseInstResult = mysql_query($saveCourseInstSql) or die('unable to execute query: '.$saveCourseInstSql);
				if(!$courseInstResult){
					$_SESSION['msg']="Unable to save the course information. Please try later.";
					$_SESSION['msg_type']="error";
					header("Location: courses.php");
					exit;
				}
			}		
		}
		//delete removed courses
		$order=$key+$orderNegate;
		$deleteCourseInstSql = "delete from iseries_course_instructors where course_id='$courseId' and ci_order>'$order'";
		$deleteCourseInstResult = mysql_query($deleteCourseInstSql) or die('unable to execute query: '.$deleteCourseInstSql);
		if(!$deleteCourseInstResult){
			$_SESSION['msg']="Unable to delete course-instructor information. Please try later.";
			$_SESSION['msg_type']="error";
			header("Location: courses.php");
			exit;
		}
	}

	header("Location: courses.php");	
}
?>
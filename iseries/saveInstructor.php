<?php session_start(); ?>
<?php include('config.inc'); ?>
<?php
if(isset($_POST['data']['inst'])){
	$fName = $_POST['data']['inst']['fName'];
	$lName = $_POST['data']['inst']['lName'];
	$title = $_POST['data']['inst']['title'];
	$dir_id = $_POST['data']['inst']['dir_id'];
	$bio = $_POST['data']['inst']['bio'];
	$image_link = $_POST['data']['inst']['image_link'];
	
	
	if($fName=="" || $lName=="" || $title=="" || $dir_id=="" || $bio=="" || $image_link==""){
		$_SESSION['msg']="All instructor fields are mandatory";
		$_SESSION['msg_type']="error";
		header("Location: instructors.php");
		exit;
	}
	
	$instId = $_POST['data']['inst']['id'];
	if($instId){
		$saveInstSql = "update iseries_instructors set 
	first_name='$fName', last_name='$lName', title='$title', dir_id='$dir_id',
	bio='$bio', image_link='$image_link' where id='$instId'";
	}
	else{
	$saveInstSql = "insert into iseries_instructors(first_name, last_name, title,dir_id, bio, image_link) values('$fName', '$lName', '$title', '$dir_id', '$bio', '$image_link')";
	}
	
	$result = mysql_query($saveInstSql) or die('unable to execute query: '.$saveInstSql);
	
	if(!$result){
		$_SESSION['msg']="Unable to save the instructor information. Please try later.";
		$_SESSION['msg_type']="error";
		header("Location: instructors.php");
		exit;
	}
	if(!$instId)
		$instId = mysql_insert_id();
	
	$courseIdList = "(";
	if(isset($_POST['data']['inst']['course'])){	
		foreach($_POST['data']['inst']['course'] as $key=>$courseId){
			if($courseId==""){
					continue;
			}else{
				$courseIdList .= $courseId.", ";
			}
			$selectOneInstCourseSql = "select 1 from iseries_course_instructors where course_id=".$courseId." and instructor_id=".$instId;
			$selectInstCourseResult = mysql_query($selectOneInstCourseSql) or die("Unable to perform query ".$selectOneInstCourseSql);
			// if row exists then continue else add it
			if(mysql_num_rows($selectInstCourseResult)>0){	
				continue;
			}else{
				$insertInstCourseSql = "insert into iseries_course_instructors(course_id, instructor_id) values(".$courseId.",".$instId.")";
				$instCourseResult = mysql_query($insertInstCourseSql) or die('unable to execute query: '.$insertInstCourseSql);
				if(!$instCourseResult){
					$_SESSION['msg']="Unable to save the course information. Please try later.";
					$_SESSION['msg_type']="error";
					header("Location: instructors.php");
					exit;
				}
			}
		}
		//delete removed courses
		$courseIdListLen=strlen($courseIdList);
		if($courseIdListLen>1){
			$courseIdList = substr($courseIdList,0, $courseIdList-2);
			$courseIdList.=")";
		}
		if($courseIdListLen>1)
			$deleteInstCourseSql = "delete from iseries_course_instructors where instructor_id='$instId' and course_id not in $courseIdList";
		else
			$deleteInstCourseSql = "delete from iseries_course_instructors where course_id='$courseId'";
			
		$deleteInstCourseResult = mysql_query($deleteInstCourseSql) or die('unable to execute query: '.$deleteInstCourseSql);
		if(!$deleteInstCourseResult){
			$_SESSION['msg']="Unable to delete course-instructor information. Please try later.";
			$_SESSION['msg_type']="error";
			header("Location: instructors.php");
			exit;
		
		}
	}
	header("Location: instructors.php");	
}
?>
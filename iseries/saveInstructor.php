<?php session_start(); ?>
<?php include('config.inc'); ?>
<?php
if(isset($_POST['data']['instructor'])){
	$fName = $_POST['data']['instructor']['fName'];
	$lName = $_POST['data']['instructor']['lName'];
	$title = $_POST['data']['instructor']['title'];
	$dir_id = $_POST['data']['instructor']['dir_id'];
	$bio = $_POST['data']['instructor']['bio'];
	$image_link = $_POST['data']['instructor']['image_link'];
	
	$insertSql = "insert into iseries_instructors(first_name, last_name, title,dir_id, bio, image_link) values('$fName', '$lName', '$title', '$dir_id', '$bio', '$image_link')";
	
	$result = mysql_query($insertSql) or die('unable to execute query: '.$insertSql);
	
	/*if($result){
		$id = mysql_insert_id();		
	}
	else{
		
	}
	*/
	header("Location: instructors.php");	
}



?>
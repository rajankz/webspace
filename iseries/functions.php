<?php session_start(); ?>
<?php

class ISeries{
	
	public static $instOptions = null;
	public static $instResultSet = null;
	public static $courseOptions = null;
	public static $courseResultSet = null;
	
	public function createInstOptions(){
		if(self::$instOptions!=null)
			return self::$instOptions;
		$getAllInstructorsSql = "select * from iseries_instructors";
		$resultSet = mysql_query($getAllInstructorsSql) or die('Unable to retrieve instructor list');
		$instOptions .="<option></option>";
		while ($row = mysql_fetch_array($resultSet, MYSQL_NUM)) {
			$instOptions .= "<option ";
			$instOptions .= "name=";
			$instOptions .= $row[4];
			$instOptions .= " value=".$row[0];
			$instOptions .= ">";
			$name = $row[3]." ".$row[1]." ".$row[2];
			$instOptions .= $name;
			$instOptions .= "</option>"; 
		}
		self::$instOptions = $instOptions;	
	}
	
	public function createCourseOptions(){
		if(self::$courseOptions!=null)
			return self::$courseOptions;
		$getAllCoursesSql = "select * from iseries_courses";
		$resultSet = mysql_query($getAllCoursesSql) or die('Unable to retrieve course list');
		$courseOptions .="<option></option>";
		while ($row = mysql_fetch_array($resultSet, MYSQL_NUM)) {
			$courseOptions .= "<option ";
			$courseOptions .= "name=";
			$courseOptions .= $row[1].$row[2].$row[3];
			$courseOptions .= " value=".$row[0];
			$courseOptions .= ">";
			$name = $row[1].$row[2].$row[3]."-".$row[4];
			$courseOptions .= $name;
			$courseOptions .= "</option>"; 
		}
		self::$courseOptions = $courseOptions;	
	}
	
	//public function setInstOptionSelected($optionSet)
	
	public function createInstOptionsSelected($selected=null){
		//if(self::$instResultSet==null){
			$getAllInstructorsSql = "select * from iseries_instructors";
			$resultSet = mysql_query($getAllInstructorsSql) or die('Unable to retrieve instructor list');
			self::$instResultSet = $resultSet;
		//}
		$resultSet=self::$instResultSet;
		$instOptions .="<option></option>";
		while ($row = mysql_fetch_array($resultSet, MYSQL_NUM)) {
			$instOptions .= "<option ";
			$instOptions .= "name=";
			$instOptions .= $row[4];
			$instOptions .= " value=".$row[0];
			if($selected==$row[0])
				$instOptions .= " selected=selected";
			$instOptions .= ">";
			$name = $row[3]." ".$row[1]." ".$row[2];
			$instOptions .= $name;
			$instOptions .= "</option>"; 
		}
		return $instOptions;	
	}
	
	public function createCourseOptionsSelected($selected=null){
		//if(self::$instResultSet==null){
			$getAllCoursesSql = "select * from iseries_courses";
			$resultSet = mysql_query($getAllCoursesSql) or die('Unable to retrieve instructor list');
			self::$courseResultSet = $resultSet;
		//}
		$resultSet=self::$courseResultSet;
		$courseOptions .="<option></option>";
		while ($row = mysql_fetch_array($resultSet, MYSQL_NUM)) {
			$courseOptions .= "<option ";
			$courseOptions .= "name=";
			$courseOptions .= $row[1].$row[2].$row[3];
			$courseOptions .= " value=".$row[0];
			if($selected==$row[0])
				$courseOptions .= " selected=selected";
			$courseOptions .= ">";
			$name = $row[1].$row[2].$row[3]."-".$row[4];
			$courseOptions .= $name;
			$courseOptions .= "</option>"; 
		}
		return $courseOptions;	
	}
	
	public function getInstOptions(){return self::$instOptions;	}
	public function getCourseOptions(){return self::$courseOptions;	}
	
}
?>
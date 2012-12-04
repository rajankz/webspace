<?php session_start(); ?>
<?php

class ISeries{
	
	public static $instOptions = null;
	public static $instResultSet = null;
	public static $courseOptions = null;
	
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
	
	public function getInstOptions(){
		//echo self::$instOptions;
		return self::$instOptions;
	}
	
}
?>
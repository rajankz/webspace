<?php
/**
 * User: rajankz
 * Date: 8/29/12
 * Time: 11:49 AM
 */

class Review extends AppModel{

	var $name = "Review";
	var $useTable = "reviews";

	
	var $belongsTo = array(
	'Worksheet' => array(
		'className'     => 'Worksheet',
		'foreignKey'    => 'worksheetId',
		'fields'=>array('Worksheet.firstName','Worksheet.lastName')
		)
	); 
	
	
}

?>
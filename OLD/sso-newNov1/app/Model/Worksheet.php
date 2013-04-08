<?php
/**
 * User: rajankz
 * Date: 7/24/12
 * Time: 2:22 PM
 */

class Worksheet extends AppModel{

	var $name = "Worksheet";
	var $useTable = "worksheets";

	public $validate = array(
		'universityId' => array(
			'rule'    => 'notEmpty',
			'message' => 'University ID cannot be left blank'
		),
		'studentName' => array(
			'rule'    => 'notEmpty',
			'message' => 'Student Name cannot be left blank'
		)
	);
	
	var $hasMany = array(
	'Semester'=>array(
		'className'=>'Semester',
		'foreignKey'=>'worksheetId',
		'fields'=>array('Semester.id','Semester.order','Semester.sem','Semester.code')
	),
	'Review'=>array(
		'className'=>'Review',
		'foreignKey'=>'worksheetId'
	),
	'Attachment'=>array(
		'className'=>'Attachment',
		'foreignKey'=>'worksheetId'
	)
	
	); 


}

?>
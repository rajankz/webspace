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
	'Attachment' => array(
		'className'     => 'Attachment',
		'foreignKey'    => 'worksheet_id',
		'fields'=>array('Attachment.file_name','Attachment.description')
		),
	'Semester'=>array(
		'className'=>'Semester',
		'foreignKey'=>'worksheetId',
		'fields'=>array('Semester.order','Semester.sem','Semester.code')
	)
	
	); 


}

?>
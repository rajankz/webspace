<?php
/**
 * User: rajankz
 * Date: 7/24/12
 * Time: 2:24 PM
 */
class WorksheetsController extends AppController {
	var $name = 'Worksheet';
	var $helpers = array('Html','Form');

	function creator_add(){
		return $this->setAction('add_edit');
	}
	function creator_edit(){
		return $this->setAction('add_edit',$this->Worksheet);
	}

	function add_edit($worksheet = null){
		$this->set('worksheet',$worksheet);
	}

}

?>

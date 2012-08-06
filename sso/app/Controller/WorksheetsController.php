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
		$this->loadModelData();
	}

	//public function beforeFilter(){
	//	$this->loadModelData();
	//}

	function loadModelData(){
		$this->loadModel('Roles');
		$this->loadModel('SelectOptions');
		$this->set('roleOptions',$this->Roles->find('list',array('fields'=>array('Roles.role_name','Roles.role_name'))));
		/*$financialBlockOptions = array();
		$financialBlocks = array();
		$financialBlocks = $this->SelectOptions->find('list',array(
			'fields'=>array('SelectOptions.code','SelectOptions.name'),
			'conditions'=>array('SelectOptions.type'=>'block','SelectOptions.subtype'=>'financial')
		));
		foreach ($financialBlocks as $row) {
			$financialBlockOptions["{$row['SelectOptions']['code']}"] = "{$row['SelectOptions']['code']} - {$row['SelectOptions']['name']}";
		}*/
		//$this->set('financialBlockOptions', $financialBlockOptions);


		$this->set('financialBlockOptions',$this->SelectOptions->find('list',array(
			'fields'=>array('SelectOptions.code','SelectOptions.name'),
			'conditions'=>array('SelectOptions.type'=>'block','SelectOptions.subtype'=>'financial')
		)));

		$this->set('judicialBlockOptions',$this->SelectOptions->find('list',array(
			'fields'=>array('SelectOptions.code','SelectOptions.code'.'SelectOptions.name'),
			'conditions'=>array('SelectOptions.type'=>'block','SelectOptions.subtype'=>'judicial')
		)));
	}
	//'SelectOptions.code' .' - '.
	//'SelectOptions.code',
}

?>

<?php
/**
 * User: rajankz
 * Date: 7/24/12
 * Time: 2:24 PM
 */
class WorksheetsController extends AppController {
	var $name = 'Worksheet';
	var $useTable = 'worksheets';
	var $helpers = array('Html','Form');
	
	function admin_index(){}
	function admin_addWorksheet(){
		$this->redirect(array('action'=>'addEdit','admin'=>true));
	}
	
	function admin_addEdit($worksheet = null){
		$this->set('worksheet',$worksheet);
		$this->loadModelData();
	}
	
	function admin_saveWorksheet(){
		$worksheetData = $this->Session->read('worksheetData');
		
		if(empty($worksheetData){
			$this->Session->setFlash('Erro while saving. Empty form found!');
			$this->redirect(array('action'=>'addEdit','admin'=>true));
		}
		if($this->Worksheet->id != null){
			$this->Worksheet->create();
		}
		if($this->Worksheet->save($worksheetData)){
			$this->setflash('Saved Data sucessfully');
			$this->redirect(array('action'=>'index','admin'=>true));
		}
	}
	
	function admin_submitWorksheet(){
		debug('submit');
		exit;
	}
	
	function admin_submitWorksheetForm(){
	$this->Session->write('worksheetData',$this->params['data']['Worksheet']);
		if(isset($this->params['data']['saveButton'])){
			$this->redirect(array('action'=>'saveWorksheet','admin'=>true));
		}else{
			$this->redirect(array('action'=>'submitWorksheet','admin'=>true));
		}
		
	}
	
	function loadModelData(){
		$this->loadModel('Roles');
		$this->loadModel('SelectOptions');
		$this->set('roleOptions',$this->Roles->find('list',array('fields'=>array('Roles.role_name','Roles.role_name'))));

        $financialBlockOptions = array();
		$financialBlocks = $this->SelectOptions->find('all',array(
            'fields'=>array('SelectOptions.code', 'SelectOptions.name'),
			'conditions'=>array('SelectOptions.type'=>'block','SelectOptions.subtype'=>'financial')
		));
		foreach ($financialBlocks as $row) {
			$financialBlockOptions[$row['SelectOptions']['code']] = $row['SelectOptions']['code'] .' - '. $row['SelectOptions']['name'];
		}
		$this->set('financialBlockOptions', $financialBlockOptions);

        $judicialBlockOptions = array();
        $judicialBlocks = $this->SelectOptions->find('all',array(
            'fields'=>array('SelectOptions.code', 'SelectOptions.name'),
            'conditions'=>array('SelectOptions.type'=>'block','SelectOptions.subtype'=>'judicial')
        ));
        foreach ($judicialBlocks as $row) {
            $judicialBlockOptions[$row['SelectOptions']['code']] = $row['SelectOptions']['code'] .' - '. $row['SelectOptions']['name'];
        }
        $this->set('judicialBlockOptions', $judicialBlockOptions);
	}
	
	
	/*

	function creator_add(){
		debug($this);
		exit;
		return $this->setAction('add_edit','creator'=>true);
		//$this->redirect('controller'=>'worksheet','action'=>'add_edit');
	}
	function add(){
		debug($this);exit;
	}
	function creator_edit(){
		return $this->setAction('add_edit',$this->Worksheet);
	}
	
	function admin_add(){
		//debug('here');
		//return $this->setAction('add_edit');
	}
	function admin_edit(){
		return $this->setAction('add_edit',$this->Worksheet);
	}

	function add_edit($worksheet = null){
		$this->set('worksheet',$worksheet);
		$this->loadModelData();
	}
	
	function index(){}
	function creator_index(){}
	

	//public function beforeFilter(){
	//	$this->loadModelData();
	//}

*/
}

?>

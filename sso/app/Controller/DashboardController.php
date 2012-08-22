<?php

class DashboardController extends AppController{

	function admin_index(){
		//$this->redirect(array('controller'=>'dashboard','action'=>'worksheets','admin'=>true));
	}
	
	function admin_preferences(){}
	function admin_userSettings(){
		$this->loadModel('User');
		$this->set('users',$this->User->find('all'));
	}
	function admin_userEdit(){
		$this->loadModel('Users');
		$editUserId = $this->params->named['userId'];
		//debug($editUserId);
		$userEdit = $this->Users->find('first',
		array('conditions'=>array('id'=>$editUserId)));
		$this->set('userEdit',$userEdit);
		//debug($userEdit);		
	}
	
	function admin_worksheets(){
		//debug($this);
		//exit;
		return $this->redirect(array('controller'=>'worksheets','action'=>'index','admin'=>true));		
	}
	
	function admin_addWorksheet(){}
	
	function admin_settings(){}
	
	
	function creator_index(){}
	function creator_worksheets(){}


}



?>
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
	function admin_reviews(){
		$this->redirect(array('controller'=>'reviews', 'action'=>'index'));
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
	function admin_changePwd(){}
	function admin_updatePwd(){}
	function admin_worksheets(){
		$this->redirect(array('controller'=>'worksheets','action'=>'index'));		
	}
	function admin_addWorksheet(){}
	function admin_settings(){}
	function creator_index(){}
	function creator_worksheets(){
		$this->redirect(array('controller'=>'worksheets','action'=>'index'));		
	}
	
	function reviewer_index(){}
	function reviewer_reviews(){
		$this->redirect(array('controller'=>'reviews', 'action'=>'index'));
	}
	
}
?>
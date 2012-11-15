<?php

class DashboardController extends AppController{

	/** ADMIN **/
	function admin_index(){
		$this->redirect(array('controller'=>'dashboard','action'=>'worksheets','admin'=>true));
	}
	function admin_preferences(){}
	function admin_userSettings(){
		$this->loadModel('User');
		$this->set('users',$this->User->find('all'));
	}
	function admin_reviews(){
		$this->redirect(array('controller'=>'reviews', 'action'=>'index'));
	}
	function admin_stats(){
		$this->redirect(array('controller'=>'stats', 'action'=>'index'));
	}
	function admin_userEdit(){
		$this->loadModel('User');
		$editUserId = $this->params->named['userId'];
		$userEdit = $this->User->find('first',
		array('conditions'=>array('id'=>$editUserId)));
		$this->set('userEdit',$userEdit);	
	}
	function admin_changePwd(){}
	function admin_updatePwd(){}
	function admin_worksheets(){
		$this->redirect(array('controller'=>'worksheets','action'=>'index'));		
	}
	function admin_addWorksheet(){}
	function admin_settings(){}
	
	/** CREATOR **/
	function creator_index(){
		$this->redirect(array('controller'=>'dashboard','action'=>'worksheets','creator'=>true));
	}
	function creator_worksheets(){
		$this->redirect(array('controller'=>'worksheets','action'=>'index'));		
	}
	
	/** REVIEWER **/
	function reviewer_index(){
		$this->redirect(array('controller'=>'dashboard','action'=>'reviews','reviewer'=>true));
	}
	function reviewer_reviews(){
		$this->redirect(array('controller'=>'reviews', 'action'=>'index','reviewer'=>true));
	}
	
}
?>
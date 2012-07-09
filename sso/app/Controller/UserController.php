<?php

class UserController extends AppController{
	var $name = 'Users';
	var $helpers = array('Html','Form');
	
	function index(){
		
	}
	
	function beforeFilter(){
		$this->__validateLoginStatus();
	}
	
	function login(){
		if(empty($this->data)==false){
			if($user = $this->User->validateLogin($this->data['User']))==true){
				$this->Session->write('User',$user);
				$this->Session->setFlash('Login Sucessful!');
				$this->redirect('index');
				exit();
			}else{
				$this->Session->setFlash('Incorrect Login!');
				exit();
			}
		}
	}
	
	function logout(){
		$this->Session->destroy('user');
		$this->Session->setFlash('Logout Succcessful');
		$this->redirect('login');
	}
	
	function __validateLoginStatus(){
		if($this->action != 'login' && $this->action != 'logout'){
			if($this->Session->check('User') == false){
				$this->redirect('login');
				$this->Session->setFlash('Please login to continue.');
			}
		}
	}
}

?>
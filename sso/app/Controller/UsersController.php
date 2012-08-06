<?php

class UsersController extends AppController{
	var $name = 'User';
	var $helpers = array('Html','Form');


    function login(){
        if (!$this->request->is('post'))
            return;

        if($this->Auth->loggedIn())
            $this->Auth->logout();

        if($this->Auth->login()){
            $this->redirect(array('action'=>'index'));
        } else {
            $this->Auth->authError = 'Invalid username / password combination';
            $this->Session->setFlash($this->Auth->authError);
        }
    }

    function admin_login(){
        $this->redirect(array('action'=>'login','admin'=>false));
    }

    function creator_login(){
        $this->redirect(array('action'=>'login','creator'=>false));
    }

    function index($user = null){
	    $this->loadModel('Roles');
	    $this->Roles->id = $this->Auth->user('role');
	    $this->Roles->read();
        switch($this->Roles->field('role_name')){
            case 'admin':
                $this->redirect(array('controller'=>'users','action'=>'dashboard','admin'=>true));
                break 1;
            case 'reviewer':
                $this->redirect(array('controller'=>'users','action'=>'dashboard','admin'=>false));
                break 1;
	        case 'creator':
		        $this->redirect(array('controller'=>'users','action'=>'dashboard','creator'=>true));
		        break 1;
            default:
                $this->redirect(array('controller'=>'users','action'=>'login','admin'=>false));
        }
    }

	function admin_dashboard(){}
	function creator_dashboard(){}
	function dashboard(){}
	
	function beforeFilter(){
        parent::beforeFilter();
	}

    function admin_register() {
        $this->loadModel('Roles');
        $this->set('roles',$this->Roles->find('list',array('fields'=>array('role_name'))));
        if (!empty($this->data)) {
            $this->convertPasswords();
            if ($this->data['User']['password'] == $this->data['User']['confirm_password']) {
                $this->User->create();
                if($this->User->save($this->data)){
                    $this->flash('Your new user has been created.','/users/index' );
                }else {
                    $this->data['User']['password'] = null;
                    $this->data['User']['confirm_password'] = null;
                }
                $this->redirect(array('action' => 'login'));
            }
        }
    }

    private function convertPasswords() {
        if(!empty( $this->data['User']['password'] ) ){
                $this->request->data['User']['password'] = $this->Auth->password($this->data['User']['password'] );
        }
        if(!empty( $this->data['User']['confirm_password'] ) ){
            $this->request->data['User']['confirm_password'] = $this->Auth->password( $this->data['User']['confirm_password'] );
        }
    }

    function logout(){
        $this->redirect($this->Auth->logout());
    }

	function admin_logout(){
		$this->redirect($this->Auth->logout());
	}

	function creator_logout(){
		$this->redirect($this->Auth->logout());
	}




}

?>
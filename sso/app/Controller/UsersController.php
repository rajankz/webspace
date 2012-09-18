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
        	//debug($this->Auth->authenticate['all']['scope']['User.is_active']);
            $this->Auth->loginError = 'Invalid username / password combination.';
            $this->Auth->authError = 'Your account has been diabled. Please contact Administrator.';
            $this->Session->setFlash($this->Auth->authError);
        }
    }

    function admin_login(){
        $this->redirect(array('action'=>'login','admin'=>false));
    }

    function creator_login(){
        $this->redirect(array('action'=>'login','creator'=>false));
    }
    
    function reviewer_login(){
        $this->redirect(array('action'=>'login','reviewer'=>false));
    }

    function index(){
        switch($this->Auth->user('role')){
            case 'admin':
                $this->redirect(array('controller'=>'dashboard','action'=>'index','admin'=>true));
                break 1;
            case 'reviewer':
                $this->redirect(array('controller'=>'dashboard','action'=>'index','reviewer'=>true));
                break 1;
	        case 'creator':
		        $this->redirect(array('controller'=>'dashboard','action'=>'index','creator'=>true));
		        break 1;
            default:
                $this->redirect(array('controller'=>'users','action'=>'login','admin'=>false,'creator'=>false,'reviewer'=>false));
        }
    }

	function creator_dashboard(){}

	function dashboard(){}
	
	function beforeFilter(){
        parent::beforeFilter();
	}
	
	function admin_updatePwd(){
		if(empty($this->data['User']['newPassword'])||empty($this->data['User']['confirmNewPassword'])){
			$this->Session->setFlash('Fields cannot be empty','flashInformation');
			$this->redirect(array('controller'=>'dashboard','action'=>'changePwd','userId'=>$this->data['User']['id']));
		}
		//else
//		$userData = $this->User->findById(
	
	}

    function admin_register() {
        $this->loadModel('Roles');
        $this->set('roles',$this->Roles->find('list',array('fields'=>array('role_name'))));
        if (!empty($this->data)) {
            $this->convertPasswords();
            if ($this->data['User']['password'] == $this->data['User']['confirm_password']) {
                $this->User->create();
                if($this->User->save($this->data)){
                    $this->Session->setFlash('New user added sucessfully.','flashSuccess' );
                }else {
                	//$this->Session->setFlash('Unable to create user.','flashError' );
                    $this->data['User']['password'] = null;
                    $this->data['User']['confirm_password'] = null;
                }
                $this->redirect(array('controller'=>'dashboard','action' => 'userSettings'));
            }  
        }else{
        	//$this->Session->setFlash('You need to fill all fields.','flashError' );
        	//$this->redirect(array('action' => 'register'));
        }        
    }

    private function convertPasswords() {
        if(!empty( $this->data['User']['newPassword'] ) ){
                $this->request->data['User']['newPassword'] = $this->Auth->password($this->data['User']['newPassword'] );
        }
        if(!empty( $this->data['User']['confirmNewPassword'] ) ){
            $this->request->data['User']['confirmNewPassword'] = $this->Auth->password( $this->data['User']['confirmNewPassword'] );
        }
    }
    
    /*   PASSWORD
    $this->convertPasswords();
    if ($this->request->data['User']['password'] == $this->request->data['User']['confirm_password']) {
    
    }else {
        $this->data['User']['password'] = null;
        $this->data['User']['confirm_password'] = null;
        $this->flash('Passwords do not match.');
    }
    
    */
    
    function admin_updateUser() {
        $this->loadModel('Roles');
        $this->set('roles',$this->Roles->find('list',array('fields'=>array('role_name'))));
        if (!empty($this->data)){
        	//debug($this->User);exit;
        	//$userData = $this->User->findById($this->data['User']['id']);
        	
        	//$form = $this->User->read(null, $this->data['User']['id']);
        	
        	//$this->User->id = $this->data['User']['id'];
        	//debug($this->data['User']);exit;
        	//unset($this->User->password);
			//debug($this->User);exit;
        	if($this->User->save($this->data)){
	            $this->Session->setFlash('User data has been saved.','flashSuccess');
    	    }else{
        		$this->Session->setFlash('User data NOT saved.','flashError');
        	}
        }
        $this->redirect(array('controller'=>'dashboard','action'=>'userSettings'));
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
	
	function reviewer_logout(){
		$this->redirect($this->Auth->logout());
	}




}

?>
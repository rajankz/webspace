<?php

class UsersController extends AppController{
	var $name = 'User';
	var $helpers = array('Html','Form');


    function login(){
        //debug($this->isAdmin());exit;
        //$this->redirect(array('action'=>'index'));
        
        if (!$this->request->is('post'))
            return;
        //debug($this);exit;
        if($this->Auth->loggedIn())
            $this->Auth->logout();
            
        $this->redirect(array('action'=>'index'));

        if($this->Auth->login()){
            $this->redirect(array('action'=>'index'));
        } else {
        	//debug($this->Auth->authenticate['all']['scope']['User.is_active']);
            $this->Auth->loginError = 'Invalid username / password combination.';
            $this->Auth->authError = 'Your account has been diabled. Please contact Administrator.';
            $this->Session->setFlash($this->Auth->authError,'flashError');
        }
    }

    function admin_login(){$this->redirect(array('action'=>'login','admin'=>false));}
    function creator_login(){$this->redirect(array('action'=>'login','creator'=>false));}
    function reviewer_login(){$this->redirect(array('action'=>'login','reviewer'=>false));}
    
    function logout(){$this->redirect($this->Auth->logout());}
    function admin_logout(){$this->redirect($this->Auth->logout());}
    function creator_logout(){$this->redirect($this->Auth->logout());}
    function reviewer_logout(){$this->redirect($this->Auth->logout());}

    function index(){
    	//debug($this);exit;
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
		//debug($this);
        parent::beforeFilter();
	}
	
	function admin_updatePwd(){
		$this->User->id = $this->data['User']['id'];
	
		//check for empty passwords
		/*
		if(empty($this->data['User']['password']) && empty($this->data['User']['confirm_password'])){
			$this->Session->setFlash('You cannot set a blank pasword.','flashInformation');
			$this->redirect(array('controller'=>'dashboard','action'=>'changePwd','userId'=>$this->User->id,'username'=>$this->data['User']['username']));
		}
		*/
		//check if password matches
		if ($this->data['User']['password'] != $this->data['User']['confirm_password']) {
			$this->request->data['User']['password'] = null;
			$this->request->data['User']['confirm_password'] = null;
			$this->Session->setFlash('Passwords do not match.','flashInformation');
			$this->redirect(array('controller'=>'dashboard','action'=>'changePwd','userId'=>$this->User->id,'username'=>$this->data['User']['username']));
		}
		
		//debug($this->data);exit;
		
		$this->convertPasswords();
		
		//try to save password
		if($this->User->saveField('password',$this->request->data['User']['password'])){
			$this->Session->setFlash('Password changed successfully.','flashSuccess');
		}else{
			$this->Session->setFlash('There was an error changing the password. Please contact webmaster.','flashError');
		}
		
		$this->redirect(array('controller'=>'dashboard','action'=>'userEdit','userId'=>$this->User->id,'username'=>$this->data['User']['username']));

	}

    function admin_register() {
        $this->loadModel('Roles');
        $this->set('roles',$this->Roles->find('list',array('fields'=>array('role_name'))));
        if (!empty($this->data)) {
            $this->convertPasswords();
            debug($this->data);exit;
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
        //if(!empty( $this->data['User']['password'] ) ){
                $this->request->data['User']['password'] = $this->Auth->password($this->data['User']['password'] );
               //debug($this->request->data['User']['password']);exit;
        //}
        //if(!empty( $this->data['User']['confirm_password'] ) ){
            $this->request->data['User']['confirm_password'] = $this->Auth->password( $this->data['User']['confirm_password'] );
        //}
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
        	if($this->User->save($this->data)){
	            $this->Session->setFlash('User data has been saved.','flashSuccess');
    	    }else{
        		$this->Session->setFlash('User data NOT saved.','flashError');
        	}
        }
        $this->redirect(array('controller'=>'dashboard','action'=>'userSettings'));
    }






}

?>
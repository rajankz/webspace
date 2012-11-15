<?php

class UsersController extends AppController{
	var $helpers = array('Html','Form');


	/** Common **/
	function login(){
        //if (!$this->request->is('post'))
        //    return;
        //debug($this);exit;
        if($this->CasAuth->loggedIn()){
            $this->CasAuth->logout();
            $this->redirect(array('action'=>'index'));
        }
        if($this->CasAuth->login()){
            $this->redirect(array('action'=>'index'));
        } else {
            $this->CasAuth->authError = 'You do not have access to this system.<br /><br />Please contact coordinator.';
            $this->Session->setFlash($this->CasAuth->authError,'flashError');
        }
    }
	function logout(){$this->redirect($this->CasAuth->logout());}
	function dashboard(){}
	function beforeFilter(){
        parent::beforeFilter();
	}
	function index(){
        switch($this->CasAuth->user('role')){
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
	private function convertPasswords() {
    	$this->request->data['User']['password'] = $this->CasAuth->password($this->data['User']['password'] );
        $this->request->data['User']['confirm_password'] = $this->CasAuth->password( $this->data['User']['confirm_password'] );
    }
	
	/** Admin **/
    function admin_login(){$this->redirect(array('action'=>'login','admin'=>false));}
    function admin_logout(){$this->redirect($this->CasAuth->logout());}
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

		
		$this->convertPasswords();
		
		//try to save password
		if($this->User->saveField('password',$this->request->data['User']['password'])){
			$this->Session->setFlash('Password changed successfully.','flashSuccess');
		}else{
			$this->Session->setFlash('There was an error changing the password. Please contact webmaster.','flashError');
		}
		
		$this->redirect(array('controller'=>'dashboard','action'=>'userEdit','userId'=>$this->User->id,'username'=>$this->data['User']['username']));

	}
    function admin_addUser(){}
    function admin_register() {
    	//debug($this->data);exit;
        $this->loadModel('Roles');
        $this->set('roles',$this->Roles->find('list',array('fields'=>array('role_name'))));
        if (!empty($this->data)) {
        	//debug($this);exit;
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
    function admin_updateUser() {
        $this->loadModel('Roles');
        $this->set('roles',$this->Roles->find('list',array('fields'=>array('role_name'))));
        //debug($this->data);debug($this->User->id);exit;
        if (!empty($this->data)){
        	if($this->User->save($this->data)){
	            $this->Session->setFlash('User data has been saved.','flashSuccess');
    	    }else{
        		$this->Session->setFlash('User data NOT saved.','flashError');
        	}
        }
        $this->redirect(array('controller'=>'dashboard','action'=>'userSettings'));
    }
    
    /** Creator **/    
    function creator_login(){$this->redirect(array('action'=>'login','creator'=>false));}
    function creator_logout(){$this->redirect($this->CasAuth->logout());}
    function creator_dashboard(){}
    
    /** Reviewer **/
    function reviewer_login(){$this->redirect(array('action'=>'login','reviewer'=>false));}    
    function reviewer_logout(){$this->redirect($this->CasAuth->logout());}
   


    







}

?>
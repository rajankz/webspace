<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

    var $components = array('Session','Auth');
    //var $uses = array('Auth');
	var $helpers = array('Html', 'Form', 'Js', 'Session', 'Paginator');

	//global $loaded = false;
    var $financialBlock;

    public function loadData(){
	    if($this->isAuthorized($this->User))
	    	$this->loadModelData();
    }
    
	private function loadModelData(){
		//debug($this->loaded);
		if($this->loaded)
			return;
		//debug($this);//exit;
		$this->loadModel('Roles');
		
		$this->loadModel('Users');
		$this->set('userOptions',$this->Users->find('list',array('fields'=>array('Users.id','Users.fullName'))));
		
		$this->loadModel('SelectOptions');
		$this->set('roleOptions',$this->Roles->find('list',array('fields'=>array('Roles.role_name','Roles.role_name'))));
		
		$this->set('semOptions',$this->SelectOptions->find('list',	array(
		'fields'=>array('SelectOptions.code', 'SelectOptions.name'),
		'conditions'=>array('SelectOptions.type'=>'worksheet', 'SelectOptions.subtype'=>'semester')
		)));
		
		$this->loadModel('StatusCodes');
		$this->set('reviewSC',$this->StatusCodes->find('list', array('fields'=>array('StatusCodes.order','StatusCodes.status'),
				'conditions'=>array('StatusCodes.type'=>'review')
		)));
		$this->set('worksheetSC',$this->StatusCodes->find('list', array('fields'=>array('StatusCodes.order','StatusCodes.status'),
				'conditions'=>array('StatusCodes.type'=>'worksheet')
		)));
		
		$this->loadReviewerDecisionCodes();

		$this->loaded = true;
		//debug($this);
	}
	 function loadReviewerDecisionCodes(){
		$this->loadModel('SelectOptions');
		$reviewerDecisionCodeOptions = array();
		$reviewerDecisionCodes = $this->SelectOptions->find('all',array(
		    'fields'=>array('SelectOptions.code', 'SelectOptions.name'),
			'conditions'=>array('SelectOptions.type'=>'decision')
		));
		foreach ($reviewerDecisionCodes as $row) {
			$reviewerDecisionCodeOptions[$row['SelectOptions']['code']] = $row['SelectOptions']['code'] .' - '. $row['SelectOptions']['name'];
		}
		$this->set('reviewerDecisionCodeOptions', $reviewerDecisionCodeOptions);
	}

	 function pa($arr) {
	echo '<pre>';
	print_r($arr);
	echo '< /pre>';
}

	public function index(){
		//debug($this);exit;
		if($this->Auth->loggedIn()){
			$this->redirect(array('controller'=>'users', 'action'=>'index',$this->User));
		}else{
			$this->redirect(array('controller'=>'users', 'action'=>'login'));
		}
	}

    public function beforeFilter(){
        $this->Auth->allow('login');
        //debug($this->isAdmin());
        $this->Auth->authorize = array('Controller');
        //debug($this);exit;
        $this->Auth->authenticate = array(
            'all' => array(
                'scope' => array('User.is_active' => 1)
            ),
            'Form'
        );
	    $this->Auth->logoutRedirect = array('controller' => 'users', 'action' => 'login','admin'=>false,'creator'=>false,'reviewer'=>false);
	    $this->loadModelData();
    }
    
    
    
    function isAdmin(){
		if($this->params['prefix']=='admin' && ($this->Auth->user('role')!='admin')){
            return false;
        }    
        return true;
    }

    function isAuthorized($user){
        if($this->params['prefix']=='admin' && ($user['role']!='admin')){
            return false;
        }
	    if($this->params['prefix']=='creator' && ($user['role']!='creator')){
		    return false;
	    }
	    if($this->params['prefix']=='reviewer' && ($user['role']!='reviewer')){
	        return false;
	    }
        return true;
    }
    
    public function beforeRender(){
	    $this->set('base_url', 'http://'.$_SERVER['SERVER_NAME'].Router::url('/'));
    }
}

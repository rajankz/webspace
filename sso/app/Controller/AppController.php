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

    var $components = array('Session','Auth' );
	var $helpers = array('Html', 'Form', 'Js');

	public function index(){
		if($this->Auth->loggedIn()){
			$this->redirect(array('controller'=>'users', 'action'=>'index',$this->User));
		}else{
			$this->redirect(array('controller'=>'users', 'action'=>'login'));
		}
	}

    public function beforeFilter(){
        $this->Auth->allow('login');
        $this->Auth->authorize = array('controller');
        $this->Auth->authenticate = array(
            'all' => array(
                'scope' => array('User.is_active' => 1)
            ),
            'Form'
        );
	    $this->Auth->logoutRedirect = array('controller' => 'users', 'action' => 'login','admin'=>false,'creator'=>false);
    }

    function isAuthorized($user){
        if($this->params['prefix']=='admin' && ($user['role']!=1)){
            return false;
        }
	    if($this->params['prefix']=='creator' && ($user['role']!=3)){
		    return false;
	    }
        return true;
    }
}

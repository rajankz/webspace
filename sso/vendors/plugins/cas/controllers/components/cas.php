<?php
include_once('CAS.php');
App::import('Component', 'Auth');
/**
* CAS Component for CakePHP
* @author Eric Simmerman <eric.simmerman @nospam pascalmetrics.com>
* @copyright Pascal Metrics
* @link http://www.cakephp.org CakePHP
* @link http://www.pascalmetrics.com Pascal Metrics, Inc.
*
*  Permission is hereby granted, free of charge, to any person obtaining
*  a copy of this software and associated documentation files (the
*  "Software"), to deal in the Software without restriction, including
*  without limitation the rights to use, copy, modify, merge, publish,
*  distribute, sublicense, and/or sell copies of the Software, and to
*  permit persons to whom the Software is furnished to do so, subject to
*  the following conditions:
*
*  The above copyright notice and this permission notice shall be
*  included in all copies or substantial portions of the Software.
*
*  THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
*  EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
*  MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
*  NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE
*  LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION
*  OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION
*  WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
*/
class CasComponent extends AuthComponent {

 function initialize(&$controller) {
  parent::initialize($controller);
     //phpCAS::setDebug();                    
     phpCAS::client(CAS_VERSION_2_0,'secure.yourdomain.com',443,'/cas/',false);           
     phpCAS::setNoCasServerValidation();
 }

function logout() {
phpCAS::logout();
parent::logout();
}

 function startup(&$controller) {
     $methods = array_flip($controller->methods);
     $isErrorOrTests = (
         strtolower($controller->name) == 'cakeerror' ||
         (strtolower($controller->name) == 'tests' && Configure::read() > 0)
     );
     if ($isErrorOrTests) {
         return true;
     }

     $isMissingAction = (
         $controller->scaffold === false &&
         !isset($methods[strtolower($controller->params['action'])])
     );

     if ($isMissingAction) {
         return true;
     }

     if (!$this->__setDefaults()) {
         return false;
     }

     $this->data = $controller->data = $this->hashPasswords($controller->data);
     $url = '';

     if (isset($controller->params['url']['url'])) {
         $url = $controller->params['url']['url'];
     }
     $url = Router::normalize($url);
     $loginAction = Router::normalize($this->loginAction);

     $isAllowed = (
         $this->allowedActions == array('*') ||
         in_array($controller->params['action'], $this->allowedActions)
     );

     if ($loginAction != $url && $isAllowed) {
         return true;
     }
 
     if (!$this->user()) { //We are processing a secured page and Cake does not hold Authenticated Session
        if(phpCAS::isAuthenticated()){ // CAS does hold authenticated session - use it to authenticate for Cake
         $username = phpCAS::getUser();
            $model =& $this->getModel();
            $conditions = array( $this->userModel.'.'.$this->fields['username'] => $username );
             pr($conditions);
             $data = $model->find($conditions, null, null, 0);
             if (empty($data)) {
                 // CAS return authenticated true, but username [{$username}] was not found. Load dummy user                                                         
                 $data = $model->findById(-1);
             }          
             $this->Session->write($this->sessionKey, $data[$this->userModel]);
             $this->_loggedIn = true;          
        }else{ // Force CAS authentication
        phpCAS::forceAuthentication();
        }           
     }
  

     if (!$this->authorize) {
         return true;
     }

     extract($this->__authType());
     switch ($type) {
         case 'controller':
             $this->object =& $controller;
         break;
         case 'crud':
         case 'actions':
             if (isset($controller->Acl)) {
                 $this->Acl =& $controller->Acl;
             } else {
                 $err = 'Could not find AclComponent. Please include Acl in ';
                 $err .= 'Controller::$components.';
                 trigger_error(__($err, true), E_USER_WARNING);
             }
         break;
         case 'model':
             if (!isset($object)) {
                 $hasModel = (
                     isset($controller->{$controller->modelClass}) &&
                     is_object($controller->{$controller->modelClass})
                 );
                 $isUses = (
                     !empty($controller->uses) && isset($controller->{$controller->uses[0]}) &&
                     is_object($controller->{$controller->uses[0]})
                 );

                 if ($hasModel) {
                     $object = $controller->modelClass;
                 } elseif ($isUses) {
                     $object = $controller->uses[0];
                 }
             }
             $type = array('model' => $object);
         break;
     }

     if ($this->isAuthorized($type)) {
         return true;
     }

     $this->Session->setFlash($this->authError, 'default', array(), 'auth');
     $controller->redirect($controller->referer(), null, true);
     return false;
 }
}
?>
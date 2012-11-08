<?php  

App::import('Vendor', 'CAS/CAS'); 
App::import('Component', 'Auth'); 

/** 
 * CasAuthComponent by Pietro Brignola. 
 * 
 * Extend CakePHP AuthComponent providing authentication against CAS service. 
 * 
 * PHP versions 4 and 5 
 * 
 * Comments and bug reports welcome at pietro.brignola AT unipa DOT it 
 * 
 * Licensed under The MIT License 
 * 
 * @writtenby      Pietro Brignola 
 * @lastmodified   Date: October 12, 2010 
 * @license        http://www.opensource.org/licenses/mit-license.php The MIT License 
 */  
class CasAuthComponent extends AuthComponent { 
    
    var $use = array('User');
    
     function initialize(&$controller) {
	     parent::initialize($controller);
	     phpCAS::setDebug(false);                    
	     	 }
     
    /** 
     * Main execution method.  Initializes CAS client and force authentication if required before passing user to parent startup method.
     * 
     * @param object $controller A reference to the instantiating controller object 
     * @return boolean 
     * @access public 
     */ 
    function startup(&$controller) { 
        // CAS authentication required if user is not logged in 
        //debug($this->request->data);exit; 
        
        //if(!isset($this->request->query['ticket'])){
        if(empty($this->request->data)){
        //debug($this->user());	
            // Set debug mode 
            //phpCAS::setDebug(false); 
            //if(!empty(phpCAS::getUser()))
	        //    debug($this);
            //Initialize phpCAS 
            //debug(isset($this->request->query['ticket']));
            //phpCAS::client(CAS_VERSION_2_0, Configure::read('CAS.hostname'), Configure::read('CAS.port'), Configure::read('CAS.uri'));     
            
            phpCAS::client(CAS_VERSION_2_0, Configure::read('CAS.hostname'), Configure::read('CAS.port'), Configure::read('CAS.uri'));           
	     phpCAS::setNoCasServerValidation();

                  
            // No SSL validation for the CAS server 
            //phpCAS::setNoCasServerValidation(); 
            // Force CAS authentication if required 
            phpCAS::forceAuthentication(); //debug(phpCAS::getUser());exit; 
            //debug();exit;
            //$model =& $this->getModel(); 
            $controller->loadModel('User');
            $model = $controller->User;
            $controller->request->data['User']['username'] = phpCAS::getUser(); 
            $controller->request->data['User']['password'] ='a'; 
            
            //debug($this);exit;
            //$this->request->data->User['username']=phpCAS::getUser();
            //$this->request->data->User['password']='a';      
            //debug($this->request);exit;      
        } 
        //debug(phpCAS::getUser());exit;
        return parent::startup($controller); 
        //$this->redirect(array('controller'=>'User','action'=>'login'));
    } 
     
    /** 
     * Logout execution method.  Initializes CAS client and force logout if required before returning to parent logout method.
     * 
     * @param mixed $url Optional URL to redirect the user to after logout 
     * @return string AuthComponent::$loginAction 
     * @see AuthComponent::$loginAction 
     * @access public 
     */ 
    function logout() { 
    	//debug($this);exit;
        // Set debug mode 
        phpCAS::setDebug(false); 
        //Initialize phpCAS 
        //phpCAS::client(CAS_VERSION_2_0, Configure::read('CAS.hostname'), Configure::read('CAS.port'), Configure::read('CAS.uri'), true);
        // No SSL validation for the CAS server 
        phpCAS::setNoCasServerValidation(); 
        // Force CAS logout if required 
        if (phpCAS::isAuthenticated()) { 
            phpCAS::logout(array('url'=>'https://login.umd.edu/cas/logout')); // Provide login url for your application 
        } 
        return parent::logout(); 
    } 
     
} 

?>
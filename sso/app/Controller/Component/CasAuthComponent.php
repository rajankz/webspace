<?php  

App::import('Vendor', 'CAS/CAS/CAS'); 
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
     
    /** 
     * Main execution method.  Initializes CAS client and force authentication if required before passing user to parent startup method.
     * 
     * @param object $controller A reference to the instantiating controller object 
     * @return boolean 
     * @access public 
     */ 
    function startup(&$controller) { 
        // CAS authentication required if user is not logged in  
        if (!$this->user()) { 
            // Set debug mode 
            phpCAS::setDebug(false); 
            //Initialize phpCAS 
            phpCAS::client(CAS_VERSION_2_0, Configure::read('CAS.hostname'), Configure::read('CAS.port'), Configure::read('CAS.uri'));            
            // No SSL validation for the CAS server 
            phpCAS::setNoCasServerValidation(); 
            // Force CAS authentication if required 
            phpCAS::forceAuthentication(); 
            debug(phpCAS::getUser());exit;
            $model =& $this->getModel(); 
            $controller->data[$model->alias][$this->fields['username']] = phpCAS::getUser(); 
            $controller->data[$model->alias][$this->fields['password']] = ''; 
        } 
        return parent::startup($controller); 
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
        // Set debug mode 
        phpCAS::setDebug(false); 
        //Initialize phpCAS 
        phpCAS::client(CAS_VERSION_2_0, Configure::read('CAS.hostname'), Configure::read('CAS.port'), Configure::read('CAS.uri'), true);
        // No SSL validation for the CAS server 
        phpCAS::setNoCasServerValidation(); 
        // Force CAS logout if required 
        if (phpCAS::isAuthenticated()) { 
            phpCAS::logout(array('url' => 'http://www.cakephp.org')); // Provide login url for your application 
        } 
        return parent::logout(); 
    } 
     
} 

?>
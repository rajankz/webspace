<?php

class User extends AppModel{
	var $name = 'User';
    var $useTable = 'users';

    public $validate = array(
        'username' => array(
            array(
                'rule' => 'notEmpty',
	            'required' => true,
	            'allowEmpty' => false,
                'message' => 'Username cannot be empty'
            ),
            array(
                'rule' => 'isUnique',
                'message' => 'This username is already taken'
            )
        )/*,
        'password' => array(
            array(
                'rule' => 'notEmpty',
	            'required' => true,
	            'allowEmpty' => false,
                'message' => 'Password cannot be empty'
            ),
            array(
                'rule' => array('minLength', 4),
                'message' => 'Must be at least 4 chars'
            ),
            array(
                'rule' => array('passCompare'),
                'message' => 'The passwords do not match'
            )
        )*/
    );

	function beforeValidate(){
		//debug($this->User);
		//debug($this->data);exit;
		//if(empty($this->data['User']['password']))
			unset($this->data['User']['password']);
	}
    public function passCompare() {
        //return ($this->data['User']['newPassword'] === $this->data['User']['confirmNewPassword']);
    }

    public function beforeSave() {
        //$this->data['User']['password'] = AuthComponent::password($this->data['User']['password']);
        return true;
    }
    
    
    
    
    

}
?>
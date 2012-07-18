<?php

class User extends AppModel{
	var $name = 'User';
    var $useTable = 'users';
    /*
    var $validate = array(
        'username' => 'VALID_NOT_EMPTY',
        'password' => 'VALID_NOT_EMPTY',
        'emailId' => 'VALID_NOT_EMPTY'
    );
    */

    public $validate = array(
        'username' => array(
            array(
                'rule' => 'notEmpty',
                'message' => 'Username cannot be empty'
            ),
            array(
                'rule' => 'isUnique',
                'message' => 'This username is already taken'
            )
        ),
        'password' => array(
            array(
                'rule' => 'notEmpty',
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
        )
    );

    public function passCompare() {
        return ($this->data[$this->alias]['password'] === $this->data[$this->alias]['confirm_password']);
    }

    public function beforeSave() {
        //$this->data['User']['password'] = AuthComponent::password($this->data['User']['password']);
        return true;
    }

}
?>
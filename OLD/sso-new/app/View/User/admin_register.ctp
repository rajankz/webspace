<h2 style="text-align: center">Register User</h2>
<?php
echo $this->Form->create('User', array('action' => 'register'));
echo $this->Form->input('username');
echo $this->Form->input('emailId');
echo $this->Form->input('password',array('type' => 'password'));
echo $this->Form->input('confirm_password', array('type' => 'password'));
echo $this->Form->input('User.role',array('type'=>'select','options'=>$roleOptions));
echo $this->Form->submit();
echo $this->Form->end();
?>
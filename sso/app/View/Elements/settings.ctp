<?php
    echo $this->Form->create('User', array('controller'=>'users','action' => 'logout','admin'=>false));
    echo $this->Form->end('Logout');
?>
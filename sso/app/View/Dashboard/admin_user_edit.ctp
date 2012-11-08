<?php echo $this->element('admin_navmenu'); ?>
<div id="theContent">
<h2 class="center">Update User</h2>
<?php
echo $this->Form->create('User', array('action' => 'updateUser'));
echo $this->Form->input('id',array('type'=>'hidden', 'value'=>$userEdit['User']['id']));
echo $this->Form->input('username', array('value'=>$userEdit['User']['username']));
?>
<div style="margin-bottom: 0;"><?php

echo $this->Html->link('Change Password',array('action'=>'changePwd','userId'=>$userEdit['User']['id'],'username'=>$userEdit['User']['username'])); 
?></div><?php
echo $this->Form->input('fullName',array('value'=>$userEdit['User']['fullName']));
echo $this->Form->input('emailId',array('value'=>$userEdit['User']['emailId']));
//echo $this->Form->input('password',array('type' => 'password'));
//echo $this->Form->input('confirm_password', array('type' => 'password'));
echo $this->Form->input('User.role',array('type'=>'select','options'=>$roleOptions,'selected'=>$userEdit['User']['role']));
echo $this->Form->input('User.is_active', array('type' => 'checkbox','checked'=>($userEdit['User']['is_active']?'checked':''),'label'=>'Active'));
echo $this->Form->submit('Update');
echo $this->Form->end();

?>

</div>
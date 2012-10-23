<?php echo $this->element('admin_navmenu'); ?>

<div id="theContent">
<h2 class="center">Update User</h2>
<?php
echo $this->Form->create('User', array('action' => 'updateUser'));
echo $this->Form->input('id',array('type'=>'hidden', 'value'=>$userEdit['Users']['id']));
echo $this->Form->input('username', array('value'=>$userEdit['Users']['username']));
echo $this->Form->input('emailId',array('value'=>$userEdit['Users']['emailId']));
//echo $this->Form->input('password',array('type' => 'password'));
//echo $this->Form->input('confirm_password', array('type' => 'password'));
?>
<div class="button"><?php
echo $this->Html->link('Change Password',array('class'=>'button','action'=>'changePwd','div'=>true)); 
?></div>
<?php
echo $this->Form->input('User.is_active', array('type' => 'checkbox','checked'=>($userEdit['Users']['is_active']?'':'checked'),'label'=>'Disable this account'));
echo $this->Form->submit('Update');
echo $this->Form->end();
?>

</div>
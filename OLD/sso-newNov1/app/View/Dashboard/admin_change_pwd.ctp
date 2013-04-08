<?php echo $this->element('admin_navmenu'); ?>
<div id="theContent">
<h2 class="center">Change User Password</h2>
<?php
echo $this->Form->create('User', array('action' => 'updatePwd'));
echo $this->Form->input('id',array('type'=>'hidden', 'value'=>$this->params['named']['userId']));
echo $this->Form->input('username',array('type'=>'hidden', 'value'=>$this->params['named']['username']));
echo $this->Form->input('password',array('type' => 'password','label'=>'New Password'));
echo $this->Form->input('confirm_password', array('type' => 'password'));
echo $this->Form->submit('Update Password');
echo $this->Form->end();

?>

</div>
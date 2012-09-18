<?php echo $this->element('admin_sidemenu'); ?>
<div id="theContent">
<h2 class="center">Change User Password</h2>
<?php
echo $this->Form->create('User', array('action' => 'updatePwd'));
echo $this->Form->input('id',array('type'=>'hidden', 'value'=>$this->params['named']['userId']));
echo $this->Form->input('newPassword',array('type' => 'password'));
echo $this->Form->input('confirmNewPassword', array('type' => 'password'));
echo $this->Form->submit('Update Password');
echo $this->Form->end();

?>

</div>
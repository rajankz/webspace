<div id="commonControls">
 <?php   echo $this->Html->link('preferences', array('controller'=>'users','action' => 'settings')); ?>
 <?php   echo $this->Html->link('logout', array('controller'=>'users','action' => 'logout','admin'=>false,'creator'=>false,'reviewer'=>false)); ?>
</div>
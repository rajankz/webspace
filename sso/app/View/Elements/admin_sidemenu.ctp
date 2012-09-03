<div id="sidemenu">

    <?php echo $this->Html->link('Worksheets', 
    array('controller'=>'dashboard', 'action'=>'admin_worksheets','admin'=>true)); ?>
    
    <?php echo $this->Html->link('Users Settings', array('controller'=>'dashboard', 'action'=>'admin_userSettings','admin'=>true)); ?>
    
    <?php echo $this->Html->link('Reviews', array('controller'=>'users', 'action'=>'reviews','admin'=>true)); ?>
    
    
    <br /><hr /><br />
    
    <?php   echo $this->Html->link('preferences', array('controller'=>'users','action' => 'settings')); ?>
    <?php   echo $this->Html->link('logout', array('controller'=>'users','action' => 'logout','admin'=>false)); ?>
    
</div>
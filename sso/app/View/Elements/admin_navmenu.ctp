<div id="navmenu">
	<div class="floatLeft">
    <?php echo $this->Html->link('Worksheets', 
    array('controller'=>'dashboard', 'action'=>'admin_worksheets','admin'=>true)); ?>
    
    <?php echo $this->Html->link('Users Settings', array('controller'=>'dashboard', 'action'=>'admin_userSettings','admin'=>true)); ?>
    
    <?php echo $this->Html->link('Reviews', array('controller'=>'dashboard', 'action'=>'admin_reviews','admin'=>true)); ?>
    
    <?php echo $this->Html->link('Stats', array('controller'=>'dashboard', 'action'=>'admin_stats','admin'=>true)); ?>
    
    </div>
    
    <div class="floatRight">
    <div class="horizontalSeperator"></div>
    
    <?php   echo $this->Html->link('preferences', array('controller'=>'users','action' => 'settings')); ?>
    <?php   echo $this->Html->link('logout', array('controller'=>'users','action' => 'logout','admin'=>false)); ?>
    </div>
    
</div>
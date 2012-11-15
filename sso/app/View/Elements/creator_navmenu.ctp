<div id="navmenu">
	<div class="floatLeft">
    <?php echo $this->Html->link('Worksheets', 
    array('controller'=>'dashboard', 'action'=>'creator_worksheets','creator'=>true)); ?>
    
    <?php echo $this->Html->link('Reviews', array('controller'=>'dashboard', 'action'=>'creator_reviews','creator'=>true)); ?>
    
    <?php echo $this->Html->link('Stats', array('controller'=>'dashboard', 'action'=>'creator_stats','creator'=>true)); ?>
    
    </div>
    
    <div class="floatRight">
    <div class="horizontalSeperator"></div>
    
    <?php   //echo $this->Html->link('preferences', array('controller'=>'users','action' => 'settings')); ?>
    <?php   echo $this->Html->link('logout', array('controller'=>'users','action' => 'logout','creator'=>false)); ?>
    </div>
    
</div>
<div id="navmenu">
	<div class="floatLeft">
    <?php echo $this->Html->link('Reviews', 
    array('controller'=>'dashboard', 'action'=>'reviewer_reviews','reviewer'=>true)); ?>
    </div>
    
    <div class="floatRight">
    <div class="horizontalSeperator"></div>
    
    <?php   //echo $this->Html->link('preferences', array('controller'=>'users','action' => 'settings')); ?>
    <?php   echo $this->Html->link('logout', array('controller'=>'users','action' => 'logout','reviewer'=>false)); ?>
    </div>
    
</div>
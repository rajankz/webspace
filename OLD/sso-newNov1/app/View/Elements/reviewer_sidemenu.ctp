<div id="sidemenu">
 
    <?php echo $this->Html->link('Reviews', array('controller'=>'dashboard', 'action'=>'reviewer_reviews','reviewer'=>true)); ?>

    <br /><hr /><br />
    
    <?php echo $this->Html->link('preferences', array('controller'=>'users','action' => 'settings')); ?>
    <?php  echo $this->Html->link('logout', array('controller'=>'users','action' => 'logout','reviewer'=>false)); ?>
    
</div>
<div id="sidemenu">
    <?php echo $this->Html->link('Worksheets', array('controller'=>'dashboard', 'action'=>'worksheets','admin'=>true)); ?>
    <?php echo $this->Html->link('Users Settings', array('controller'=>'dashboard', 'action'=>'admin_userSettings','admin'=>true)); ?>
    <?php echo $this->Html->link('Reviews', array('controller'=>'users', 'action'=>'reviews','admin'=>true)); ?>

</div>
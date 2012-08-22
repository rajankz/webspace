<div id="sidemenu">
    <?php echo $this->Html->link('Worksheets', array('controller'=>'worksheets', 'action'=>'index','creator'=>true)); ?>
    <?php echo $this->Html->link('Users Settings', array('controller'=>'dashboard', 'action'=>'admin_userSettings','creator'=>true)); ?>
    <?php echo $this->Html->link('Reviews', array('controller'=>'users', 'action'=>'reviews','creator'=>true)); ?>
</div>
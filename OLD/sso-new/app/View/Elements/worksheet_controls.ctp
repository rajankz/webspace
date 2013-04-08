<div id="worksheetControls">

    <?php echo $this->Html->link('Add', array('controller'=>'worksheets','action' => 'add'),array('class'=>'buttonLink','id'=>'addButton')); ?>
    <?php echo $this->Html->link('Delete', array('controller'=>'worksheets','action' => 'delete'),array('class'=>'buttonLink')); ?>
    <?php echo $this->Html->link('Edit', array('controller'=>'worksheets','action' => 'edit'),array('class'=>'buttonLink')); ?>
</div>
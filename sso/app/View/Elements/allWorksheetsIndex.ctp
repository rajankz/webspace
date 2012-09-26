Page: <?php echo $this->Paginator->counter(); ?>
<table>
	<tr>
		<th><?php echo $this->Paginator->sort('uid', 'University ID'); ?></th>
		<th><?php echo $this->Paginator->sort('name', 'Name');?></th>
		<th><?php echo $this->Paginator->sort('statusId', 'Status');?></th>
		<th><?php echo $this->Paginator->sort('assignedToId','Assigned To');?></th>
	</tr>
	<?php //debug($reviewers);exit;?>
	<?php foreach($worksheets as $worksheet): ?>
	<tr>
	<td><?php
		echo $this->Html->link(h($worksheet['Worksheet']['uid']), array('action'=>'editWorksheet','id'=>$worksheet['Worksheet']['id'])); ?> </td>
		<td><?php echo h($worksheet['Worksheet']['firstName']." ".$worksheet['Worksheet']['lastName']); ?></td>
		<td><?php echo h($this->viewVars['worksheetSC'][$worksheet['Worksheet']['statusId']]); ?></td>
		<td><?php echo ($worksheet['Worksheet']['assignedToId']!='')?h($reviewers[$worksheet['Worksheet']['assignedToId']]):''; ?></td>	
	</tr>
	<?php endforeach; ?>
</table>

<div id="pagination">
	<?php echo $this->Paginator->prev('« Previous', null, null, array('class' => 'disabled')); ?>
	<?php echo $this->Paginator->numbers(); ?>
	<?php //debug($this->params);exit; ?>
	<!-- Page: -->
	<select onchange="setURL('page', this.value)">
	<?php for ($i = 1; $i <= $this->Paginator->counter(array('format' => '%pages%')); $i++): ?>
	  <option value="<?=$i?>"<?=($this->params['paging']['Worksheet']['page'] == $i) ? ' selected="selected"' : ''?>><?=$i?></option>
	<?php endfor ?>
	</select>
	
	<?php echo $this->Paginator->next('Next »', null, null, array('class' => 'disabled')); ?> 
</div>
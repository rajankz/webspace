<script type="text/javascript">
	/*
	$('#WorksheetFilters').focus(function{
		alert('clicked');
	});
	
	clearIfNotDefault(default){
		
	}*/

</script>


<?php echo $this->Form->create('Worksheet', array('action' => 'filterWorksheet')); ?>
<?php $reviewersFilter = $reviewers;$reviewersFilter[-1]='No one';ksort($reviewersFilter);//debug($reviewersFilter); ?>	
<?php $worksheetSCItems = array();$worksheetSCItems[-1]='All Pending Sheets';	$worksheetSCItems[-2]='All Finished Sheets';ksort($worksheetSCItems);
	$worksheetSCFilter = array(array($worksheetSCItems),'well'=>array($worksheetSC));	
//$worksheetSCFilter['Items',$worksheetSCItems];//debug($reviewersFilter); ?>	
<table>
<tr>
	<td class="small">University Id</td>
	<td class="small">Student Name</td>
	<td class="small">Status</td>
	<td class="small">Assigned To</td>
	<td class="small">Semester</td>
</tr>
<tr>
<td><?php echo $this->Form->input('WorksheetFilters.uid',array('label'=>false,'div'=>false,'class'=>'small')); ?></td>
<td><?php echo $this->Form->input('WorksheetFilters.name',array('label'=>false,'div'=>false,'class'=>'small')); ?></td>
<td><?php echo $this->Form->input('WorksheetFilters.Status',array('label'=>false, 'empty'=>true,'div'=>false, 'type'=>'select', 'options'=>array($worksheetSCFilter))); ?></td>
<td><?php echo $this->Form->input('WorksheetFilters.AssignedTo',array('label'=>false, 'empty'=>true,'div'=>false, 'type'=>'select', 'options'=>array($reviewersFilter))); ?></td>
<td><?php echo $this->Form->input('WorksheetFilters.Sem',array('label'=>false, 'empty'=>true,'div'=>false, 'type'=>'select', 'options'=>array($semOptions))); ?></td>
<td><?php echo $this->Form->submit('Go',array('div'=>false, 'action'=>'filter','name'=>'filterButton','class'=>'small')); ?></td>
<td><?php echo $this->Form->submit('Restore Default', array('div'=>false,'action'=>'restoreDefault','name'=>'restoreDefaultButton','class'=>'small alignRight'));?></td>
</tr>
</table>

<table>
	<tr>
		<th><?php echo $this->Paginator->sort('uid', 'University ID'); ?></th>
		<th><?php echo $this->Paginator->sort('name', 'Name');?></th>
		<th><?php echo $this->Paginator->sort('statusId', 'Status');?></th>
		<th><?php echo $this->Paginator->sort('assignedToId','Assigned To');?></th>
		<th><?php echo $this->Paginator->sort('sem','Semester');?></th>
	</tr>
	<?php //debug($reviewers);exit;?>
	<?php foreach($worksheets as $worksheet): ?>
	<tr>
	<td><?php
		echo $this->Html->link(h($worksheet['Worksheet']['uid']), array('action'=>'editWorksheet','id'=>$worksheet['Worksheet']['id'])); ?> </td>
		<td><?php echo h($worksheet['Worksheet']['firstName']." ".$worksheet['Worksheet']['lastName']); ?></td>
		<td><?php echo h($this->viewVars['worksheetSC'][$worksheet['Worksheet']['statusId']]); ?></td>
		<td><?php echo ($worksheet['Worksheet']['assignedToId']!='')?h($reviewers[$worksheet['Worksheet']['assignedToId']]):''; ?></td>	
		<td><?php echo ($worksheet['Worksheet']['sem']!='')?(h($semOptions[$worksheet['Worksheet']['sem']])):''; ?></td>
	</tr>
	<?php endforeach; ?>
</table>
<br />
<div style="width:990px;position:relative;position:absolute">
<span style="text-align:left;left:0px;">Page: <?php echo $this->Paginator->counter(); ?></span>

<span id="pagination" style="text-align:right;right:0px;position:absolute">
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
</span>
</div>
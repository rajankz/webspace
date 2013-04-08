<script type="text/javascript">


</script>


<?php echo $this->Form->create('Worksheet', array('action' => 'filterWorksheet')); ?>
<?php $reviewersFilter = $reviewers;$reviewersFilter[-1]='No one';ksort($reviewersFilter);//debug($reviewersFilter); ?>	
<?php $worksheetSCItems = array();$worksheetSCItems[-1]='All Pending Sheets';ksort($worksheetSCItems);
	$worksheetSCFilter = array('Status Codes'=>array($worksheetSCItems),array($worksheetSC)); ?>	
<?php 
	$filters = $this->Session->read('WorksheetFilters');
	$uid = $filters['uid'];
	$sem = $filters['sem'];
	$studentName = $filters['name'];
	$status=intval($filters['status']);
	$assignedTo=intval($filters['assignedTo']);
?>
<table width="100%">
<tr>
	<td class="small">University Id</td>
	<td class="small">Student Name</td>
	<td class="small">Status</td>
	<td class="small">Assigned To</td>
	<td class="small">Semester</td>
</tr>
<tr>
<td><?php echo $this->Form->input('WorksheetFilters.uid',array('label'=>false,'div'=>false,'class'=>'small','value'=>$uid)); ?></td>
<td><?php echo $this->Form->input('WorksheetFilters.name',array('label'=>false,'div'=>false,'class'=>'small','value'=>$studentName)); ?></td>
<td><?php echo $this->Form->input('WorksheetFilters.status',array('label'=>false, 'empty'=>true,'div'=>false, 'type'=>'select', 'options'=>array($worksheetSCFilter),'selected'=>$status?$status:-1)); ?></td>
<td><?php echo $this->Form->input('WorksheetFilters.assignedTo',array('label'=>false, 'empty'=>true,'div'=>false, 'type'=>'select', 'options'=>array($reviewersFilter),'selected'=>$assignedTo)); ?></td>
<td><?php echo $this->Form->input('WorksheetFilters.sem',array('label'=>false, 'empty'=>true,'div'=>false, 'type'=>'select', 'options'=>array($semOptions),'selected'=>$sem)); ?></td>
<!--
<td><?php //echo $this->Form->submit('Go',array('div'=>false,'name'=>'applyFilter','class'=>'small')); ?></td>
<td><?php //echo $this->Form->submit('Restore Default', array('div'=>false,'name'=>'restoreDefault','class'=>'small alignRight'));?></td>
-->
</tr>
</table>

<table id="allWorksheetTable" class="dataGrid">
	<tr>
		<th><?php echo $this->Paginator->sort('uid', 'University ID'); ?></th>
		<th><?php echo $this->Paginator->sort('applicantName', 'Applicant Name');?></th>
		<th><?php echo $this->Paginator->sort('statusId', 'Status');?></th>
		<th><?php echo $this->Paginator->sort('assignedToId','Assigned To');?></th>
		<th><?php echo $this->Paginator->sort('sem','Semester');?></th>
	</tr>
	<?php //debug($reviewers);exit;?>
	<?php foreach($worksheets as $worksheet): ?>
	<tr>
	<td><?php
		echo $this->Html->link(h($worksheet['Worksheet']['uid']), array('action'=>'editWorksheet','id'=>$worksheet['Worksheet']['id'])); ?> </td>
		<td><?php echo h($worksheet['Worksheet']['applicantName']); ?></td>
		<td><?php echo h($this->viewVars['worksheetSC'][$worksheet['Worksheet']['statusId']]); ?></td>
		<td><?php echo ($worksheet['Worksheet']['assignedToId']!='')?h($reviewers[$worksheet['Worksheet']['assignedToId']]):''; ?></td>	
		<td><?php echo ($worksheet['Worksheet']['sem']!='')?(h($semOptions[$worksheet['Worksheet']['sem']])):''; ?></td>
	</tr>
	<?php endforeach; ?>
</table>
<br />

<div>
<div id="worksheetControls" class="actionLink">  
	<span class="floatLeft">  
  <?php echo $this->Html->link('Add Worksheet', array('action'=>'addWorksheet')); ?>  
	</span>
	<span class="floatRight">
  <?php echo $this->Form->submit('Apply Filter',array('div'=>false,'name'=>'applyFilter','class'=>'small')); ?>
  <?php echo $this->Form->submit('Restore Default', array('div'=>false,'name'=>'restoreDefault','class'=>'small alignRight'));?>
	</span>
	<div class="clearBoth"></div>
</div>
</div>


<div style="width:990px;position:relative;margin-bottom:1em;margin-top:1em;">
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
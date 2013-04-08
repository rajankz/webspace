<?php echo $this->element('reviewer_navmenu'); ?>


<div id="theContent">
<h2 class="center">Reviewer Reviews</h2>

Page: <?php echo $this->Paginator->counter(); ?>
<table>
	<tr>
		<th><?php echo $this->Paginator->sort('Worksheet.firstName', 'Applicant Name'); ?></th>
		<th><?php echo $this->Paginator->sort('statusCode', 'Status');?></th>
		<th><?php echo $this->Paginator->sort('reviewOrder','Review Order');?></th>
	</tr>
	<?php foreach($reviews as $review): ?>
	<tr>
	<td><?php
	//debug($review);
	//debug($review['Review']['statusCode']);//exit;
		echo $this->Html->link(/*h($review['Review']['worksheetId']), */
		h($review['Worksheet']['firstName']." ".$review['Worksheet']['lastName']),
		array('controller'=>'worksheets','action'=>'reviewer_editReview','id'=>$review['Review']['id'],'worksheetId'=>$review['Review']['worksheetId'])); ?> </td>
		<td><?php echo h($this->viewVars['reviewSC'][$review['Review']['statusCode']]); ?></td>
		<td><?php echo h($review['Review']['reviewOrder']); ?></td>	
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
	  <option value="<?=$i?>"<?=($this->params['paging']['Review']['page'] == $i) ? ' selected="selected"' : ''?>><?=$i?></option>
	<?php endfor ?>
	</select>
	
	<?php echo $this->Paginator->next('Next »', null, null, array('class' => 'disabled')); ?> 
</div>


</div>
<div class="formBox"><a name="finalDecision"></a>
	<h3>Final Decision</h3>
	<?php 
		$disabled=true;
		if($worksheet['Worksheet']['statusId']=='7')
			$disabled=false;
	?>	
		<div class="input text reviewerComments">
	<?php echo $this->Form->label('finalComments');
		echo $this->Form->textarea('Worksheet.finalComments',array('rows'=>'5','cols'=>'100','disabled'=>$disabled,'value'=>$worksheet['Worksheet']['finalComments']));?>
		</div>		

		<div>
			<span class="label">Final Decision Code:</span>
			<span><?php echo $this->Form->input('Worksheet.finalLetterCode',array('disabled'=>$disabled,'empty'=>'', 'value'=>$worksheet['Worksheet']['finalLetterCode'], 'div'=>false,'label'=>false,'type'=>'select','options'=>array($reviewerDecisionCodeOptions)));?></span>
		</div>
	
</div>

<div id="reviewControls"> 
<h3>Reviewer Section</h3>
	<?php $worksheetId = $worksheet['Worksheet']['id']; ?>
	<?php 
	//debug($this->viewVars);exit;
	if(!empty($this->viewVars['reviews'])){
	
	//debug($this->viewVars['reviews']);exit;
	foreach ($this->viewVars['reviews'] as $review) {
		//debug($review);exit;
		echo $this->Form->input('Review.Id'.$review['reviewOrder'], array('type'=>'hidden','value'=>$review['id']));
	}
	
	}
	?>
		<?php //echo $this->Form->input('reviewer',array('type'=>'hidden','value'='')); ?>
	
	<h4 class="red">First Review</h4>
	<div class="oneReview">
	Reviewer: 
	<?php
		if(empty($worksheetID)){// || $this->viewVars['reviews']['locked']==false){
			echo $this->Form->input('Review.firstReviewerId',array('type'=>'select','options'=>$reviewerOptions, 'label'=>false,'div'=>false,'empty'=>true,'selected'=>(empty($this->viewVars['reviews']['1'])?'':$this->viewVars['reviews']['1']['reviewerId']))); 
		}else{
			echo $this->Form->label($this->viewVars['reviews']['firstReviewerId']);
		}			
	?>
	
	<?php //if review done 
	if(false){
	?>
	
	<?php echo $this->Form->label('Review: '); ?>
	<?php echo $this->Form->textarea('Review.review',array('rows'=>'5','cols'=>'80','readonly'=>'readonly')); ?>
	<?php } ?>
	
	</div>
	
	<h4 class="red">Second Review</h4>
	<div class="oneReview">
	Reviewer: 
	<?php
	// if status == first reviewer sumbitted then text box else dropdown
	?>
	
	<?php 
	if(empty($worksheetID) || $this->viewVars['reviews']['locked']==false){
		echo $this->Form->input('Review.secondReviewerId',array('type'=>'select','options'=>$reviewerOptions, 'label'=>false,'div'=>false,'empty'=>true,'selected'=>(empty($this->viewVars['reviews']['2'])?'':$this->viewVars['reviews']['2']['reviewerId']))); 
	}else{
		echo $this->Form->label($this->viewVars['reviews']['secondReviewerId']);
	}
	?>
	
	<?php //if review done 
	if(false){
	?>
	
	<?php echo $this->Form->label('Review: '); ?>
	<?php echo $this->Form->textarea('Review.review',array('rows'=>'5','cols'=>'80','readonly'=>'readonly')); ?>
	<?php } ?>
	
	</div>
	
	<h4 class="red">Third Review</h4>
	<div class="oneReview">
	Reviewer: 
	<?php
	// if status == first reviewer sumbitted then text box else dropdown
	?>
	
	<?php 
	if(empty($worksheetID) || $this->viewVars['reviews']['locked']==false){
		echo $this->Form->input('Review.thirdReviewerId',array('type'=>'select','options'=>$reviewerOptions, 'label'=>false,'div'=>false,'empty'=>true,'selected'=>(empty($this->viewVars['reviews']['3'])?'':$this->viewVars['reviews']['3']['reviewerId']))); 
	}else{
		echo $this->Form->label($this->viewVars['reviews']['thirdReviewerId']);
	} ?>
	
	<?php //if review done 
	if(false){
	?>
	
	<?php echo $this->Form->label('Review: '); ?>
	<?php echo $this->Form->textarea('Review.review',array('rows'=>'5','cols'=>'80','readonly'=>'readonly')); ?>
	<?php } ?>
	
	</div>
	
	
	
	
	
	
	<?php //debug($this);exit;?>	
</div>

<div id="reviewControls"> 
<h3>Reviewer Section</h3>
	<?php $worksheetId = $worksheet['Worksheet']['id']; ?>
	<?php 
	$statusId = $worksheet['Worksheet']['statusId']; //>3,4,5
	$reviewDone=false;
	//debug($this->viewVars['reviews']);
	if(!empty($this->viewVars['reviews'])){
		foreach ($this->viewVars['reviews'] as $review) {
		echo $this->Form->input('Review.Id'.$review['reviewOrder'], array('type'=>'hidden','value'=>$review['id']));
	}
	
	}
	?>
	
	<h4 class="red">First Review</h4>
	<div class="oneReview">
	Reviewer: 
	<?php
		if(!empty($this->viewVars['reviews']['1']))
			$reviewDone=($this->viewVars['reviews']['1']['statusCode']>2)?true:false;
		echo $this->Form->input('Review.firstReviewerId',array('disabled'=>$reviewDone,'type'=>'select','options'=>$reviewerOptions, 'label'=>false,'div'=>false,'empty'=>true,'selected'=>(empty($this->viewVars['reviews']['1'])?'':$this->viewVars['reviews']['1']['reviewerId']))); 			
	if($reviewDone){?>
		<div style="margin-bottom:0">
			<span>Reviewer Decision Code: <?php echo $this->viewVars['reviews']['1']['letterCode']; ?> </span><br />
			<span>Reviewer Comments: <br /><pre style="max-height: 60px;overflow-y: scroll;padding:5px 10px;border: 0;"><?= $this->viewVars['reviews']['1']['review'] ?></pre> </span>
		</div>
	<?php } ?>
	</div>
	
	<h4 class="red">Second Review</h4>
	<div class="oneReview">
	Reviewer: 
	<?php
		if(!empty($this->viewVars['reviews']['2']))
			$reviewDone=($this->viewVars['reviews']['2']['statusCode']>2)?true:false;
		echo $this->Form->input('Review.secondReviewerId',array('disabled'=>$reviewDone,'type'=>'select','options'=>$reviewerOptions, 'label'=>false,'div'=>false,'empty'=>true,'selected'=>(empty($this->viewVars['reviews']['2'])?'':$this->viewVars['reviews']['2']['reviewerId']))); 			
	if($reviewDone){?>
		<div style="margin-bottom:0">
			<span>Reviewer Decision Code: <?php echo $this->viewVars['reviews']['2']['letterCode']; ?> </span><br />
			<span>Reviewer Comments: <br /><pre style="max-height: 60px;overflow-y: scroll;padding:5px 10px;border: 0;"><?= $this->viewVars['reviews']['2']['review'] ?></pre> </span>
		</div>
	<?php } ?>
	</div>

	<h4 class="red">Third Review</h4>
	<div class="oneReview">
	Reviewer: 
	<?php
		if(!empty($this->viewVars['reviews']['3']))
			$reviewDone=($this->viewVars['reviews']['3']['statusCode']>2)?true:false;
		echo $this->Form->input('Review.thirdReviewerId',array('disabled'=>$reviewDone,'type'=>'select','options'=>$reviewerOptions, 'label'=>false,'div'=>false,'empty'=>true,'selected'=>(empty($this->viewVars['reviews']['3'])?'':$this->viewVars['reviews']['3']['reviewerId']))); 			
	if($reviewDone){?>
		<div style="margin-bottom:0">
			<span>Reviewer Decision Code: <?php echo $this->viewVars['reviews']['3']['letterCode']; ?> </span><br />
			<span>Reviewer Comments: <br /><pre style="max-height: 60px;overflow-y: scroll;padding:5px 10px;border: 0;"><?= $this->viewVars['reviews']['3']['review'] ?></pre> </span>
		</div>
	<?php } ?>
	</div>

</div>
<div></div>
<div class="clearBoth" style="margin-bottom:1em;"></div>
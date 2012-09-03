<?php echo $this->element('admin_sidemenu'); ?>
<?php //echo $this->element('common'); ?>

<div id="theContent">
<h2 class="center red">Create or Edit Worksheet</h2>

<?php echo $this->Form->create('Worksheet', array('action' => 'submitWorksheetForm')); ?>

<?php
	$id = "";
	if($worksheet!=null)
		$id=$worksheet['Worksheet']['id'];
	echo $this->Form->input('Worksheet.id',array('type'=>'hidden','value'=>$id));
?>

<div class="formBox">
	<h3>Student Information</h3>
    <table class="uiGrid table400" cellspacing="0" cellpadding="1">
        <tbody>
            <tr>
                <td class="label">University Id:</td>
                <td><?php echo $this->Form->input('Worksheet.uid',array('label'=>false, 'div'=>false,
                'value'=>$worksheet['Worksheet']['uid']
                )); ?></td>
            </tr>
            <tr>
                <td class="label">First Name:</td>
                <td><?php echo $this->Form->input('Worksheet.firstName',array('label'=>false, 'div'=>false,'value'=>$worksheet['Worksheet']['firstName'])); ?></td>
            </tr>
            <tr>
                <td class="label">Last Name:</td>
                <td><?php echo $this->Form->input('Worksheet.lastName',array('label'=>false, 'div'=>false,'value'=>$worksheet['Worksheet']['lastName'])); ?></td>
            </tr>
        </tbody>
    </table>
</div>

<div class="formBox">
	<h3>Blocks</h3>
	<table class="uiGrid table400" cellspacing="0" cellpadding="1">
		<tbody>
			<tr>
				<td class="label">Financial Block:</td>
				<td><?php echo $this->Form->input('Worksheet.financialBlock',array('div'=>false,'label'=>false,'type'=>'select','options'=>array($financialBlockOptions), 'selected'=>$worksheet['Worksheet']['financialBlock'])); ?></td>
			</tr>
			<tr>
				<td class="label">Judicial Block:</td>
				<td><?php echo $this->Form->input('Worksheet.judicialBlock',array('div'=>false,'label'=>false,'type'=>'select','options'=>array($judicialBlockOptions), 'selected'=>$worksheet['Worksheet']['judicialBlock'])); ?></td>
			</tr>
		</tbody>
	</table>
    <?php echo $this->Form->input('Worksheet.missingTranscripts', array('type'=>'checkbox', 'checked'=>$worksheet['Worksheet']['missingTranscripts'])); ?>
    <?php echo $this->Form->input('Worksheet.missingEssay', array('type'=>'checkbox', 'checked'=>$worksheet['Worksheet']['missingEssay'])); ?>
</div>

<div class="formBox">
    <h3>Prior Re-enrollment Decisions</h3>

	<?php echo $this->Form->input('Worksheet.numReEnrollApps', array('label'=>'Number of Re-enrollment Applications', 'value'=>$worksheet['Worksheet']['numReEnrollApps'])); ?>
	<?php echo $this->Form->input('Worksheet.numApprovals', array('label'=>'Number of Approvals (80, 86, 8A*, 8A, 8N)', 'value'=>$worksheet['Worksheet']['numApprovals'])); ?>
	<?php echo $this->Form->input('Worksheet.numDenials', array('label'=>'Number of Denials (1A, 2A, 2F, 3A, 3F, 4X, 50)', 'value'=>$worksheet['Worksheet']['numDenials'])); ?>
	<?php echo $this->Form->input('Worksheet.numPendingDecision', array('label'=>'Number of Pending Decision (60,6M,6X)', 'value'=>$worksheet['Worksheet']['numPendingDecision'])); ?>
	<?php echo $this->Form->input('Worksheet.numCancelledApps', array('label'=>'Number of Cancelled Applications (RC)', 'value'=>$worksheet['Worksheet']['numCancelledApps'])); ?>
	
	<?php //echo $this->Html->div('priorReEnrollmentDecisions'); ?>
	
	<?php //echo $this->Html->Link('addSemester',$options=>array('onClick'=>'addOneSemester()')); ?>
	
</div>

<div class="formBox">
	<h3>Student Success Office Feedback</h3>
	<?php echo $this->Form->input('Worksheet.creditsRepeated', array('label'=>'Repeated Credits (out of 18)', 'div'=>array('class'=>'smallText input text'),'maxlength'=>'2', 'value'=>$worksheet['Worksheet']['financialBlock'])); ?>
	
	<?php echo $this->Form->input('Worksheet.needPermToReturnToMajor', array('type'=>'checkbox','label'=>'Needs permission to return to Major', 'checked'=>$worksheet['Worksheet']['needPermToReturnToMajor'])); ?>
	
	<?php echo $this->Form->input('Worksheet.needPermToRegisterThirdTime', array('type'=>'checkbox','label'=>'Needs permission to register for a major requirement for a third time', 'checked'=>$worksheet['Worksheet']['needPermToRegisterThirdTime'])); ?>
	
	<?php echo $this->Form->input('Worksheet.needPermToRepeatMoreThan18', array('type'=>'checkbox','label'=>'Needs permission to repeat more than 18 credits', 'checked'=>$worksheet['Worksheet']['needPermToRepeatMoreThan18'])); ?>
</div>

<div class="formBox">
	<h3>GPA</h3>
	<?php echo $this->Form->input('Worksheet.attemptedUMDCredits', array('label'=>'Attempted UMD Credits', 'value'=>$worksheet['Worksheet']['attemptedUMDCredits'])); ?>
	<?php echo $this->Form->input('Worksheet.cgpa', array('label'=>'Cumulative GPA', 'value'=>$worksheet['Worksheet']['cgpa'])); ?>
	
	<div class="input text"><label>To raise GPA to 2.0, this student needs...</label></div>
	<div style="float: left;margin: 0;padding: 0;">
	<div style="text-align: right;display: block;margin: 0;padding: 0;">
	<?php echo $this->Form->input('Worksheet.needCreditsAt275', array('label'=>'Credits at a 2.75 GPA','maxlength'=>'3','div'=>array('class'=>'input text smallText'), 'value'=>$worksheet['Worksheet']['needCreditsAt275']));?>
	<?php echo $this->Form->input('Worksheet.needCreditsAt25', array('label'=>'Credits at a 2.5 GPA','maxlength'=>'3','div'=>array('class'=>'input text smallText'), 'value'=>$worksheet['Worksheet']['needCreditsAt25']));?>
	<?php echo $this->Form->input('Worksheet.needCreditsAt225', array('label'=>'Credits at a 2.25 GPA','maxlength'=>'3','div'=>array('class'=>'input text smallText'), 'value'=>$worksheet['Worksheet']['needCreditsAt225']));?>
	</div>
	</div><div style="clear: both;margin: 0;padding: 0;"></div>
</div>

<div class="formBox">
	<h3>Major</h3>
	<?php echo $this->Form->input('Worksheet.currentMajor',array('value'=>$worksheet['Worksheet']['currentMajor'])); ?>
	<?php echo $this->Form->input('Worksheet.requestedMajor', array('label'=>'Requested Major (if applicable)', 'value'=>$worksheet['Worksheet']['requestedMajor'])); ?>
</div>

<div class="formBox">
	<h3>Additional Notes</h3>
	<?php echo $this->Form->input('Worksheet.nonDegreeSeeking', array('type'=>'checkbox','label'=>'Non-degree seeking', 'checked'=>$worksheet['Worksheet']['nonDegreeSeeking'])); ?>
	
	<?php echo $this->Form->input('Worksheet.shadyGrove', array('type'=>'checkbox','label'=>'Shady Grove', 'checked'=>$worksheet['Worksheet']['shadyGrove'])); ?>
	
	<?php echo $this->Form->input('Worksheet.repeatingCoursesOffSem', array('type'=>'checkbox','label'=>'Repeating courses in Summer or Winter term', 'checked'=>$worksheet['Worksheet']['repeatingCoursesOffSem'])); ?>
	
	<?php echo $this->Form->input('Worksheet.dismissedLastSem', array('type'=>'checkbox','label'=>'Dismissed last semester', 'checked'=>$worksheet['Worksheet']['dismissedLastSem'])); ?>
	
	<?php echo $this->Form->input('Worksheet.withdrewLastSem', array('type'=>'checkbox','label'=>'Withdrew last semester', 'checked'=>$worksheet['Worksheet']['withdrewLastSem'])); ?>
	
	<?php echo $this->Form->input('Worksheet.registeredForOffSem', array('type'=>'checkbox','label'=>'Registered for Summer or Winter term', 'checked'=>$worksheet['Worksheet']['registeredForOffSem'])); ?>
	
	<div class="input text">
	<?php echo $this->Form->label('additionalComments'); ?>
	<?php echo $this->Form->textarea('Worksheet.additionalComments',array('rows'=>'5','cols'=>'80', 'value'=>$worksheet['Worksheet']['additionalComments'])); ?>
	</div>
	
</div>

<?php echo $this->Form->input('Worksheet.statusId', array('type'=>'hidden', 'value'=>($worksheet==null?'0':$worksheet['Worksheet']['statusId']))); ?>

<div class="formBox">
<?php echo $this->Form->submit('Save/Update',array('name'=>'saveButton', 'class'=>'submit')); ?>
<?php //if(!empty($id))
		echo $this->Form->submit('Submit Worksheet',array('name'=>'submitButton','class'=>'submit'));
?>
</div>

<?php echo $this->Form->end(); ?>

</div>
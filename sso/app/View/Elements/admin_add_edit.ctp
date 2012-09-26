<?php //echo $this->element('common'); ?>
<?php //echo $this->element('admin_sidemenu'); ?>

<div id="theContent">
<h2 class="center">Create or Edit Worksheet</h2>

<?php echo $this->Form->create('Worksheet', array('action' => 'submit')); ?>
<div class="formBox">
	<h3>Student Information</h3>
    <table class="uiGrid table400" cellspacing="0" cellpadding="1">
        <tbody>
            <tr>
                <td class="label">University Id:</td>
                <td><?php echo $this->Form->input('universityId',array('label'=>false, 'div'=>false)); ?></td>
            </tr>
            <tr>
                <td class="label">First Name:</td>
                <td><?php echo $this->Form->input('firstName',array('label'=>false, 'div'=>false)); ?></td>
            </tr>
            <tr>
                <td class="label">Last Name:</td>
                <td><?php echo $this->Form->input('firstName',array('label'=>false, 'div'=>false)); ?></td>
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
				<td><?php echo $this->Form->input('Worksheet.financialBlock',array('div'=>false,'label'=>false,'type'=>'select','options'=>array($financialBlockOptions))); ?></td>
			</tr>
			<tr>
				<td class="label">Judicial Block:</td>
				<td><?php echo $this->Form->input('Worksheet.judicialBlock',array('div'=>false,'label'=>false,'type'=>'select','options'=>array($judicialBlockOptions))); ?></td>
			</tr>
		</tbody>
	</table>
    <?php echo $this->Form->input('Worksheet.missingTranscripts', array('type'=>'checkbox','hiddenField' => false)); ?>
    <?php echo $this->Form->input('Worksheet.missingEssay', array('type'=>'checkbox','hiddenField' => false)); ?>
</div>

<div class="formBox">
    <h3>Prior Re-enrollment Decisions</h3>

	<?php echo $this->Form->input('numApplications', array('label'=>'Number of Re-enrollment Applications')); ?>
	<?php echo $this->Form->input('numApprovals', array('label'=>'Number of Approvals (80, 86, 8A*, 8A, 8N)')); ?>
	<?php echo $this->Form->input('numDenials', array('label'=>'Number of Denials (1A, 2A, 2F, 3A, 3F, 4X, 50)')); ?>
	<?php echo $this->Form->input('numPendingDecision', array('label'=>'Number of Pending Decision (60,6M,6X)')); ?>
	<?php echo $this->Form->input('numCancelledApplications', array('label'=>'Number of Cancelled Applications (RC)')); ?>
	
	<?php //echo $this->Html->div('priorReEnrollmentDecisions');
	
	<?php //echo $this->Html->Link('addSemester',$options=>array('onClick'=>'addOneSemester()')); ?>
	
</div>

<div class="formBox">
	<h3>Student Success Office Feedback</h3>
	<?php echo $this->Form->input('repCredits', array('label'=>'Repeated Credits (out of 18)', 'div'=>array('class'=>'smallText input text'),'maxlength'=>'2')); ?>
	<?php echo $this->Form->input('Worksheet.needPermToRetunToMajor', array('type'=>'checkbox','hiddenField' => false,'label'=>'Needs permission to return to Major')); ?>
	<?php echo $this->Form->input('Worksheet.needPermToRegisterThirdTime', array('type'=>'checkbox','hiddenField' => false,'label'=>'Needs permission to register for a major requirement for a third time')); ?>
	<?php echo $this->Form->input('Worksheet.needPermToRepeatMoreThan18', array('type'=>'checkbox','hiddenField' => false,'label'=>'Needs permission to repeat more than 18 credits')); ?>
</div>


<div class="formBox">
	<h3>GPA</h3>
	<?php echo $this->Form->input('attemptedUMDCredits', array('label'=>'Attempted UMD Credits')); ?>
	<?php echo $this->Form->input('cumulativeGPA', array('label'=>'Cumulative GPA')); ?>
	<div class="input text"><label>To raise GPA to 2.0, this student needs...</label></div>
	<div style="float: left;margin: 0;padding: 0;">
	<div style="text-align: right;display: block;margin: 0;padding: 0;">
	<?php echo $this->Form->input('creditsAt275GPA', array('label'=>'Credits at a 2.75 GPA','maxlength'=>'3','div'=>array('class'=>'input text smallText')));?>
	<?php echo $this->Form->input('creditsAt25GPA', array('label'=>'Credits at a 2.5 GPA','maxlength'=>'3','div'=>array('class'=>'input text smallText')));?>
	<?php echo $this->Form->input('creditsAt225GPA', array('label'=>'Credits at a 2.25 GPA','maxlength'=>'3','div'=>array('class'=>'input text smallText')));?>
	</div>
	</div><div style="clear: both;margin: 0;padding: 0;"></div>
</div>


<div class="formBox">
	<h3>Major</h3>
	<?php echo $this->Form->input('currentMajor'); ?>
	<?php echo $this->Form->input('reqMajor', array('label'=>'Requested Major (if applicable)')); ?>
</div>

<div class="formBox">
	<h3>Additional Notes</h3>
	<?php echo $this->Form->input('Worksheet.nonDegreeSeeking', array('type'=>'checkbox','hiddenField' => false,'label'=>'Non-degree seeking')); ?>
	<?php echo $this->Form->input('Worksheet.shadyGrove', array('type'=>'checkbox','hiddenField' => false,'label'=>'Shady Grove')); ?>
	<?php echo $this->Form->input('Worksheet.repeatingCoursesOffSem', array('type'=>'checkbox','hiddenField' => false,'label'=>'Repeating courses in Summer or Winter term')); ?>
	<?php echo $this->Form->input('Worksheet.dismissedLastSem', array('type'=>'checkbox','hiddenField' => false,'label'=>'Dismissed last semester')); ?>
	<?php echo $this->Form->input('Worksheet.withdrewLastSem', array('type'=>'checkbox','hiddenField' => false,'label'=>'Withdrew last semester')); ?>
	<?php echo $this->Form->input('Worksheet.registeredForOffSem', array('type'=>'checkbox','hiddenField' => false,'label'=>'Registered for Summer or Winter term')); ?>
	<div class="input text">
	<?php echo $this->Form->label('additionalComments'); ?>
	<?php echo $this->Form->textarea('Worksheet.additionalComments',array('rows'=>'5','cols'=>'80')); ?>
	</div>
	
</div>

<div class="formBox">
<?php echo $this->Form->submit('Save/Update',array('name'=>'saveButton', 'class'=>'submit')); ?>
<?php echo $this->Form->submit('Submit Worksheet',array('name'=>'submitButton','class'=>'submit')); ?>
<?php 

echo $this->Form->submit('Save/Update',array('name'=>'saveButton', 'class'=>'submit')); ?>

</div>
<?php echo $this->Form->end(); ?>

</div>





<?php echo $this->element('common'); ?>
<?php echo $this->element('admin_sidemenu'); ?>

<div id="worksheetForm">
<h2 class="center" xmlns="http://www.w3.org/1999/html">Create or Edit Worksheet</h2>


<?php echo $this->Form->create('Worksheet', array('action' => 'submit')); ?>
    <h3>Student Info</h3>
    <?php echo $this->Form->input('universityId'); ?>
    <div><table><tr>
    <td><?php echo $this->Form->input('firstName',array('div'=>false)); ?></td>
    <td><?php echo $this->Form->input('lastName',array('div'=>false)); ?></td>
    </tr></table>
    </div>

    <div>
    <h3>Blocks</h3>
    <?php echo $this->Form->input('Worksheet.financialBlock',array('type'=>'select','options'=>array($financialBlockOptions.code,$financialBlockOptions.name))); ?>
    <?php //echo $this->Form->input('Worksheet.financialBlock',array($financialBlockOptions.code, $financialBlockOptions)); ?>
    <?php echo $this->Form->input('Worksheet.judicialBlock',array('type'=>'select','options'=>$judicialBlockOptions)); ?>
    <?php echo $this->Form->input('Worksheet.missingTranscripts', array('type'=>'checkbox','hiddenField' => false)); ?>
    <?php echo $this->Form->input('Worksheet.missingEssay', array('type'=>'checkbox','hiddenField' => false)); ?>
    </div>

    <div>
    <h3>Prior Re-enrollment Decisions</h3>
    <?php echo $this->Form->input('numOfApplications', array('label'=>'Number of Re-enrollment Applications: ')); ?>
    <?php echo $this->Form->input('numOfApprovals', array('label'=>'Number of Approvals: ')); ?>
    <?php echo $this->Form->input('numOfDenials', array('label'=>'Number of Denials: ')); ?>
    </div>

<div id="studentInfo">

    <h3>Prior Re-enrollment Decisions</h3>
    <label>Number of Re-enrollment Applications *
        <input type="text" name="numPreviousApps" />
    </label>

    <label>Number of Approvals
        <input type="text" name="numApprovals" />
    </label>

    <label>Number of Denials
        <input type="text" name="numDenials" />
    </label>





</div></div>
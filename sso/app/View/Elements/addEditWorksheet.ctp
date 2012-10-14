<h2 class="center red"><?php if(empty($id))echo "Create"; else echo "Edit";?> Worksheet</h2>
<a name="top"></a>
<?php echo $this->Form->create('Worksheet', array('action' => 'submitWorksheetForm')); ?>
<?php
	$id = "";
	if($worksheet!=null){
		debug($worksheet);
		$id=$worksheet['Worksheet']['id'];
	}
	echo $this->Form->input('Worksheet.id',array('type'=>'hidden','value'=>$id));
?>

<div id="navListContainer">
<ul id="navList">
<li><a href=<?php echo $this->here ?>#blocks>Blocks</a></li>
<li><a href=<?php echo $this->here ?>#prior-reenroll>Prior Re-enrollment</a></li>
<li><a href=<?php echo $this->here ?>#sso-feedback>SSO Feedback</a></li>
<li><a href=<?php echo $this->here ?>#gpa>GPA</a></li>
<li><a href=<?php echo $this->here ?>#major>Major</a></li>
<li><a href=<?php echo $this->here ?>#notes>Additional Notes</a></li>
<li><a href=<?php echo $this->here ?>#attachments>Attachments</a></li>
<?php if(!empty($this->Session->request->params['admin'])){?>
<li><a href=<?php echo $this->here ?>#reviews>Reviews</a></li>
<?php } ?>
</ul>
</div>

<div class="formBox">
	<h3>Student Information</h3>
    <table class="uiGrid table400" cellspacing="0" cellpadding="1">
        <tbody>
            <tr>
                <td class="label alignLeft">University Id</td>
                <td class="label alignLeft">Semester</td>
            </tr>
            
            <tr>                
	            <td><?php echo $this->Form->input('Worksheet.uid',array('label'=>false, 'div'=>false,
                'value'=>$worksheet['Worksheet']['uid'], 'class'=>'fields'
                )); ?></td>
                
                <td><?php echo $this->Form->input('Worksheet.sem',array('label'=>false, 'div'=>false, 'type'=>'select', 'options'=>array($semOptions), 'selected'=>$worksheet['Worksheet']['sem'])); ?></td>
                
                
            </tr>
            <tr>
                <td class="label alignLeft">First Name</td>
                <td class="label alignLeft">Last Name</td>
            </tr>
            <tr>
            	<td><?php echo $this->Form->input('Worksheet.firstName',array('label'=>false, 'div'=>false,'value'=>$worksheet['Worksheet']['firstName'], 'class'=>'fields')); ?></td>
                
                <td><?php echo $this->Form->input('Worksheet.lastName',array('label'=>false, 'div'=>false,'value'=>$worksheet['Worksheet']['lastName'], 'class'=>'fields')); ?></td>
            </tr>
            
        </tbody>
    </table>
</div>

<div class="formBox"><a name="blocks"></a>
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

<div class="formBox"><a name="prior-reenroll"></a>
    <h3>Prior Re-enrollment Decisions</h3>

	<?php echo $this->Form->input('Worksheet.numReEnrollApps', array('label'=>'Number of Re-enrollment Applications ', 'value'=>$worksheet['Worksheet']['numReEnrollApps'], 'div'=>array('class'=>'smallText input text'))); ?>
	<?php echo $this->Form->input('Worksheet.numApprovals', array('label'=>'Number of Approvals (80, 86, 8A*, 8A, 8N) ', 'value'=>$worksheet['Worksheet']['numApprovals'], 'div'=>array('class'=>'smallText input text'))); ?>
	<?php echo $this->Form->input('Worksheet.numDenials', array('label'=>'Number of Denials (1A, 2A, 2F, 3A, 3F, 4X, 50) ', 'value'=>$worksheet['Worksheet']['numDenials'], 'div'=>array('class'=>'smallText input text'))); ?>
	<?php echo $this->Form->input('Worksheet.numPendingDecision', array('label'=>'Number of Pending Decision (60,6M,6X) ', 'value'=>$worksheet['Worksheet']['numPendingDecision'], 'div'=>array('class'=>'smallText input text'))); ?>
	<?php echo $this->Form->input('Worksheet.numCancelledApps', array('label'=>'Number of Cancelled Applications (RC) ', 'value'=>$worksheet['Worksheet']['numCancelledApps'], 'div'=>array('class'=>'smallText input text'))); ?>
	
	<?php //debug($worksheet); ?>
	<div id='priorSemesters'><br />
	<script type="text/javascript">
	function addSemester(tableID) {
            var table = document.getElementById(tableID);
            var rowCount = table.rows.length;
            var row = table.insertRow(rowCount);
            rowNum = rowCount;
            
            var cell1 = row.insertCell(0);
            var element1 = document.createElement("input");
            element1.type = "checkbox";
            cell1.appendChild(element1);
 
            var cell2 = row.insertCell(1);
            var sem = document.createElement("input");
            sem.type = "text";
            sem.setAttribute("id", "Semester"+rowNum+"sem");
            sem.setAttribute("name", "data[Semester]["+rowNum+"][sem]");
            cell2.appendChild(sem);
 
            var cell3 = row.insertCell(2);
            var code = document.createElement("input");
            code.type = "text";
            code.setAttribute("id", "Semester"+rowNum+"code");
            code.setAttribute("name", "data[Semester]["+rowNum+"][code]");
            cell3.appendChild(code);
    }
    
    function removeSemesters(tableID) {
            try {
            var table = document.getElementById(tableID);
            var rowCount = table.rows.length;
 
            for(var i=0; i<rowCount; i++) {
                var row = table.rows[i];
                var chkbox = row.cells[0].childNodes[0];
                if(null != chkbox && true == chkbox.checked) {
                    table.deleteRow(i);
                    rowCount--;
                    i--;
                }
            }
            }catch(e) {
                alert(e);
            }
        }
	</script>
	
	<input type="button" value="Add Semester" onclick="addSemester('priorSems')" class="small">
	<input type="button" value="Remove Semester" onclick="removeSemesters('priorSems')" class="small">
	<div style="clear:both"></div>
	<table id="priorSems" style="width:300px;float:left">
		<tr><th></th><th>Semester</th><th>Code</th></tr>
	<?php
		$prevSemCount=0;
		if(!empty($worksheet['Semester'])){
			
			foreach($worksheet['Semester'] as $oneSemester){
				//debug($oneSemester);
				$prevSemCount++;
				echo $this->Form->input('SemesterIds.'.$prevSemCount,array('type'=>'hidden','value'=>$oneSemester['id']));
				echo "<tr><td>";
				echo "<input type='checkbox'></td><td>";
				echo $this->Form->input('Semester.'.$oneSemester['order'].'.sem',array('label'=>false,'div'=>false,'value'=>$oneSemester['sem']));
				echo "</td><td>";
				echo $this->Form->input('Semester.'.$oneSemester['order'].'.code',array('label'=>false,'div'=>false,'value'=>$oneSemester['code']));
				echo "</td></tr>";
				
			}
		}
	?>
	</table>
	<?php echo $this->Form->input('SemesterCount',array('type'=>'hidden','value'=>$prevSemCount)); ?>		
		<div style="clear:both;margin:0;padding:0"></div>
	</div>

</div>

<div class="formBox"><a name="sso-feedback"></a>
	<h3>Student Success Office Feedback</h3>
	<?php echo $this->Form->input('Worksheet.creditsRepeated', array('label'=>'Repeated Credits (out of 18)', 'div'=>array('class'=>'smallText input text'),'maxlength'=>'2', 'value'=>$worksheet['Worksheet']['financialBlock'])); ?>
	
	<?php echo $this->Form->input('Worksheet.needPermToReturnToMajor', array('type'=>'checkbox','label'=>'Needs permission to return to Major', 'checked'=>$worksheet['Worksheet']['needPermToReturnToMajor'])); ?>
	
	<?php echo $this->Form->input('Worksheet.needPermToRegisterThirdTime', array('type'=>'checkbox','label'=>'Needs permission to register for a major requirement for a third time', 'checked'=>$worksheet['Worksheet']['needPermToRegisterThirdTime'])); ?>
	
	<?php echo $this->Form->input('Worksheet.needPermToRepeatMoreThan18', array('type'=>'checkbox','label'=>'Needs permission to repeat more than 18 credits', 'checked'=>$worksheet['Worksheet']['needPermToRepeatMoreThan18'])); ?>
</div>

<div class="formBox"><a name="gpa"></a>
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

<div class="formBox"><a name="major"></a>
	<h3>Major</h3>
	<?php echo $this->Form->input('Worksheet.currentMajor',array('value'=>$worksheet['Worksheet']['currentMajor'], 'class'=>'fields')); ?>
	<?php echo $this->Form->input('Worksheet.requestedMajor', array('label'=>'Requested Major (if applicable)', 'value'=>$worksheet['Worksheet']['requestedMajor'], 'class'=>'fields')); ?>
</div>

<div class="formBox"><a name="notes"></a>
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

<div class="formBox"><a name="attachments"></a>
	<h3>Attachments</h3>
	<div id="attachmentList"></div>
	
	<?php echo $this->Form->input('Worksheet.currentMajor',array('value'=>$worksheet['Worksheet']['currentMajor'])); ?>
	<?php echo $this->Form->input('Worksheet.requestedMajor', array('label'=>'Requested Major (if applicable)', 'value'=>$worksheet['Worksheet']['requestedMajor'])); ?>
</div>

<?php echo $this->Form->input('Worksheet.statusId', array('type'=>'hidden', 'value'=>($worksheet==null?'0':$worksheet['Worksheet']['statusId']))); ?>


<?php
	if(!empty($this->Session->request->params['admin'])){
		?><div class="formBox"><a name="reviews"></a> <?php
		echo $this->element('admin_review_controls');
		?></div><?php
		
	if($worksheet['Worksheet']['statusId']>='6'){
		echo $this->element('admin_final_decision');
	}	
		
	}
?>



<div class="formBox">
<?php if($worksheet['Worksheet']['statusId']<'2') echo $this->Form->submit('Save/Update',array('name'=>'saveButton', 'class'=>'submit')); ?>
<?php
	if(!empty($this->Session->request->params['admin'])){
		if($worksheet['Worksheet']['statusId']<'6')
		echo $this->Form->submit('Save & Assign',array('name'=>'submitButton','class'=>'submit'));
		else if($worksheet['Worksheet']['statusId']=='6')
		echo $this->Form->submit('Finalize Worksheet',array('name'=>'finalizeButton','class'=>'submit'));
		if(!empty($id)){
		echo $this->Form->submit('Delete Worksheet',array('name'=>'deleteButton','class'=>'redButton submit floatRight'));	
		}
	}else if($this->Session->request->params['creator']){
		if($worksheet['Worksheet']['statusId']<'2')
		echo $this->Form->submit('Save & Submit Worksheet',array('name'=>'submitButton','class'=>'submit'));
	}	
	
	echo $this->Form->submit('Duplicate',array('name'=>'duplicateButton','class'=>'redButton submit floatRight'));
	
?>
</div>

<?php echo $this->Form->end(); ?>
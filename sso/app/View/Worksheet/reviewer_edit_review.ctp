<?php echo $this->element('reviewer_sidemenu'); ?>

<div id="theContent">
<h2 class="center">View / Edit Worksheet Review</h2>
<table class="review">
	<tr>
		<th><div class="red">Student's Name: <span class="grey"><?php echo $worksheetData['firstName'] . " " . $worksheetData['lastName']; ?></span></div></th>
		<th><div class="floatLeft red">University ID: <span class="grey"><?php echo $worksheetData['uid']; ?></span></div></th>
	</tr>
</table>

<div class="reviewSections">
	<div class="reviewHeader">Prior Re-enrollment Decisions</div>
<table class="review">
	<tr><td class="rtAlign">Re-enroll Apps :</td><td><?= $worksheetData['numReEnrollApps']; ?></td></tr>
	<tr><td class="rtAlign">Approvals :</td><td><?= $worksheetData['numApprovals']; ?></td></tr>
	<tr><td class="rtAlign">Denials :</td><td><?= $worksheetData['numDenials']; ?></td></tr>
</table>
</div> <!-- reviewSections -->

<div class="reviewSections">
	<div class="reviewHeader">Student Success Office Feedback</div>
<table class="review">
	<tr><td class="ltAlign">Repeated Credits :</td><td><?= $worksheetData['creditsRepeated']; ?>/18</td></tr>
	<?php if($worksheetData['needPermToReturnToMajor']) ?>
		<tr><td colspan="2" class="red">- Needs permission to return to major</td></tr
	<?php if($worksheetData['needPermToRegisterThirdTime']) ?>
		<tr><td colspan="2" class="red">- Needs permission to register for a major requirement for a 3rd time</td></tr>
	<?php if($worksheetData['needPermToRepeatMoreThan18']) ?>
		<tr><td colspan="2" class="red">- Needs permission to repeat more than 18 credits</td></tr>
</table>
</div> <!-- reviewSections -->

<div class="reviewSections">
	<div class="reviewHeader">GPA</div>
<table class="review">
	<tr><td class="rtAlign">Attempted UMD Credits :</td><td><?= $worksheetData['attemptedUMDCredits']; ?></td></tr>
	<tr><td class="rtAlign">Cumulative GPA :</td><td><?= $worksheetData['cgpa']; ?></td></tr>
	<tr><td colspan="2">&nbsp;</td></tr>
	<tr><td colspan="2"><h5>To raise GPA to 2.0</h5></td></tr>
	<tr><td class="rtAlign">Credits at 2.75 GPA :</td><td><?= ($worksheetData['cgpa']>2.0)?'N/A':$worksheetData['needCreditsAt275']; ?></td></tr>
	<tr><td class="rtAlign">Credits at 2.50 GPA :</td><td><?= ($worksheetData['cgpa']>2.0)?'N/A':$worksheetData['needCreditsAt25']; ?></td></tr>
	<tr><td class="rtAlign">Credits at 2.25 GPA :</td><td><?= ($worksheetData['cgpa']>2.0)?'N/A':$worksheetData['needCreditsAt225']; ?></td></tr>
</table>
</div> <!-- reviewSections -->

<div class="reviewSections">
	<div class="reviewHeader">Blocks</div>
<table class="review">
	<tr <?php if($worksheetData['financialBlock']!='01') echo 'class="red"' ?>><td class="rtAlign">Financial Block :</td><td><?= $worksheetData['financialBlock']; ?></td></tr>
	<tr <?php if($worksheetData['judicialBlock']!='01') echo 'class="red"' ?>><td class="rtAlign">Judicial Block :</td><td><?= $worksheetData['judicialBlock']; ?></td></tr>
</table>
</div> <!-- reviewSections -->

<div class="reviewSections" style="width: 470px;">
	<div class="reviewHeader">Major</div>
<table class="review">
	<tr><td class="ltAlign" style="width:120px">Current Major :</td><td><?= $worksheetData['currentMajor']; ?></td></tr>
	<tr><td class="ltAlign"  style="width:120px">Requested Major :</td><td><?= $worksheetData['requestedMajor']; ?></td></tr>
</table>
</div> <!-- reviewSections -->

<div class="reviewSections" style="width: 350px">
	<div class="reviewHeader">Notes</div>
<table class="review">
	<?php if($worksheetData['nonDegreeSeeking']) ?>
		<tr><td colspan="2" class="red">- Non-degree seeking student</td></tr
	<?php if($worksheetData['shadyGrove']) ?>
		<tr><td colspan="2" class="red">- Shady Grove student</td></tr>
	<?php if($worksheetData['repeatingCoursesOffSem']) ?>
		<tr><td colspan="2" class="red">- Repeating courses in summer or winter term</td></tr>
	<?php if($worksheetData['dismissedLastSem']) ?>
		<tr><td colspan="2" class="red">- Dismissed last semester</td></tr>
	<?php if($worksheetData['withdrewLastSem']) ?>
		<tr><td colspan="2" class="red">- Withdrew last semester</td></tr>
	<?php if($worksheetData['registeredForOffSem']) ?>
		<tr><td colspan="2" class="red">- Registered for summer or winter term</td></tr>
</table>
</div> <!-- reviewSections -->

<div class="reviewSections" style="width: 350px;">
	<div class="reviewHeader">Additional Comments</div>
	<?php
	if(empty($worksheetData['additionalComments']))
		echo "<p>There are no additional comments for this student.</p>";
	else ?>
		<pre style="max-height: 130px;overflow-y: scroll;"><?= $worksheetData['additionalComments']; ?></pre>
</div> <!-- reviewSections -->

</div> <!-- theContent -->





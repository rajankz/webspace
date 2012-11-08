<?php echo $this->element('admin_navmenu'); ?>

<div id="theContent">
<h2 class="center red">Admin Stats</h2>

	<div class="clearBoth"></div>
	
	<table class="dataGrid">
		<tr><th>Key</th><th>Value</th></tr>
		<tr><td>Total Worksheets</td><td><?=$totalWorksheets?></td></tr>
		<tr><td>Completed Worksheets</td><td><?=$worksheetsDecisionMade?></td></tr>	
		<tr><td>Newly Created Worksheets(Not assigned to reviewers)</td><td><?=$worksheetsIncomplete?></td></tr>	
		<tr><td>Worksheets Under Review</td><td><?=$worksheetsWithReviewers?></td></tr>	
		<tr><td>Worksheets Pending with Admin</td><td><?=$totalWorksheets-$worksheetsDecisionMade-$worksheetsIncomplete-$worksheetsWithReviewers?></td></tr>
	</table>
	
	<div></div>
	
	<h3 class="red">Reviewers</h3>
	<table class="dataGrid">
		<tr><th>Reviewer Name</th><th>Num Selected</th><th>Num Assigned</th><th>Num Completed</th></tr>
		<?php //debug($reviewerStats); ?>
		<?php foreach($reviewerStats as $oneReviewerStat){
			echo '<tr>';
			echo '<td>'.$oneReviewerStat['fullName'].'</td>';
			echo '<td>'.$oneReviewerStat['numSelected'].'</td>';	
			echo '<td>'.$oneReviewerStat['numAssigned'].'</td>';
			echo '<td>'.$oneReviewerStat['numCompleted'].'</td>';			
			echo '</tr>';			
		}
		?>	
	</table>

</div>
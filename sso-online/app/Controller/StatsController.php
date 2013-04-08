<?php

class StatsController extends AppController{

	/** ADMIN **/
	function admin_index(){
		$this->loadModel('Worksheet');
		$this->loadModel('Review');
		$this->loadModel('User');
		
		$totalWorksheets = $this->Worksheet->find('count');
		$worksheetsIncomplete=$this->Worksheet->find('count',array('conditions'=>array('Worksheet.statusId<=2')));
		$worksheetsDecisionMade=$this->Worksheet->find('count',array('conditions'=>array('Worksheet.statusId=7')));
		$worksheetsWithReviewers=$this->Worksheet->find('count',array('conditions'=>array('Worksheet.statusId>=3 AND Worksheet.statusId<=5')));
		
		$this->set('totalWorksheets',$totalWorksheets);
		$this->set('worksheetsIncomplete',$worksheetsIncomplete);
		$this->set('worksheetsDecisionMade',$worksheetsDecisionMade);
		$this->set('worksheetsWithReviewers',$worksheetsWithReviewers);
		
		$reviewers = $this->User->findAllByRole('reviewer');

		$reviewerStats = array();
		$oneReviewerStat = array();
		$counter = 0;
		
		foreach($reviewers as $oneReviewer){
			$id = $oneReviewer['User']['id'];
			
			$oneReviewerStat['fullName']=$oneReviewer['User']['fullName'];		
			$oneReviewerStat['numAssigned']=$this->Review->find('count',array('conditions'=>
					array('reviewerId'=>$id,'statusCode'=>2)));
			$oneReviewerStat['numCompleted']=$this->Review->find('count',array('conditions'=>
					array('reviewerId'=>$id,'statusCode'=>3)));
			$oneReviewerStat['numSelected']=$this->Review->find('count',array('conditions'=>
					array('reviewerId'=>$id,'statusCode'=>1)));
			
			$reviewerStats[$counter++]=$oneReviewerStat;
			
		
		}
		$this->set('reviewerStats',$reviewerStats);

	}
		
}
?>
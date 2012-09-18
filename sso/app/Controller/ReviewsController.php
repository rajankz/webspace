<?php
/**
 * User: rajankz
 * Date: 8/29/12
 * Time: 11:47 AM
 */
class ReviewsController extends AppController {
	var $name = 'Review';
	var $useTable = 'reviews';
	
	var $paginate = array(
		'limit' => 2,
		'order' => array('Review.id' => 'asc'),
		'conditions'=>array('Review.invalidReview'=>false)
	);
	
	function admin_index(){
		$data = $this->paginate('Review');
		$this->set('reviews',$data);
	}

	function reviewer_index(){
		$this->paginate = null;
		$this->paginate = array(
			'limit' => 10,
			'order' => array('Review.worksheetId' => 'asc'),
			'conditions'=>array('Review.invalidReview'=>false,'statusCode >'=>'1','reviewerId'=>$this->Auth->user('id'))
		);
		$data = $this->paginate('Review');//,
		$this->set('reviews',$data);
	}
	
	function reviewer_submit(){
		$reviewOrder = $this->params['data']['Review']['reviewOrder'];
		$submittedData = $this->params['data']['Review'][$reviewOrder];
		
		$this->Review->reviewDate = date("Y-m-d H:i:s", time());

		if($submittedData['review']=='' || $submittedData['letterCode']==''){
			$this->Session->setFlash('Please fill in both review fields.','flashInformation');
			
			$this->redirect(array('controller'=>'worksheets','action'=>'reviewer_editReview','id'=>$this->params['data']['Review']['id'],'worksheetId'=>$this->params['data']['Review']['worksheetId']));
			
		}
		$this->Review->id = $submittedData['id'];
		$submittedData['statusCode'] = '4';
		$submittedData['reviewDate'] = date("Y-m-d H:i:s", time());
		if($this->Review->save($submittedData)){
			$this->Session->setFlash('Review Data Saved','flashSuccess');
			updateStatuses($this->params['data']['Review']['worksheetId']);
			assignToNextReviewer($this->params['data']['Review']['worksheetId']);
		}else{
			$this->Session->setFlash('Error in saving Review Data','flashError');
		}
		$this->paginate = null;
		$this->redirect(array('action'=>'index'));

	}
	
	private function updateStatuses($worksheetId){
		//update worksheet status
		//update next review statsu
		
	}
	
	private function assignToNextReviewer($worksheetId){
		//if review1 done and review2 not done then assign to review2
		
		// if review 1 and 2 done, then update
		
	}
	


}
?>

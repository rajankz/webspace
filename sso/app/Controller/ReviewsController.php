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
		'conditions'=>array('Review.invalidReview'=>false,'statusCode >'=>'0','reviewerId'=>$this->Auth->user('id'))
	);

		$data = $this->paginate('Review');//,
//		'conditions'=>array('statusCode'=>'1','reviewerId'=>$this->User->id)
//		);
		$this->set('reviews',$data);
		//debug($data);exit;
	}
	
	function reviewer_submit(){
		foreach($this->params['data']['Review'] as $submittedReview){
			//$id=$submittedReview['id'];
			$review=$this->Review->findById($submittedReview['id']);
			$review=$review['Review'];
			$review['statusCode']='4';
			$review['review']=$submittedReview['review'];
			$review['letterCode']=$submittedReview['letterCode'];
			//debug($review);exit;
			if($this->Review->save($review)){
				$this->Session->setFlash('Saved Review Data','flashSuccess');
			}else{
				$this->Session->setFlash('Error in saving Review Data','flashError');
			}
			$this->paginate = null;
			$this->redirect(array('action'=>'index'));
			
		}
	}


}
?>

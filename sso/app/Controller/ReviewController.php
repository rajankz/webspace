<?php
/**
 * User: rajankz
 * Date: 8/29/12
 * Time: 11:47 AM
 */
class ReviewController extends AppController {
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
	$this->paginate = array(
		'limit' => 10,
		'order' => array('Review.worksheetId' => 'asc'),
		'conditions'=>array('Review.invalidReview'=>false,'statusCode >'=>'0','reviewerId'=>$this->Auth->user('id'))
	);

		$data = $this->paginate('Review');//,
//		'conditions'=>array('statusCode'=>'1','reviewerId'=>$this->User->id)
//		);
		$this->set('reviews',$data);
	}


}
?>

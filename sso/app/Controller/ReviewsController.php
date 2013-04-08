<?php
/**
 * User: rajankz
 * Date: 8/29/12
 * Time: 11:47 AM
 */
class ReviewsController extends AppController {
	
	var $name = 'Review';
	var $useTable = 'reviews';
	
	//var $defaultCond=array('Review.statusCode'=>array(2));
	//var $defaultCond=array('invalidReview'=>false,'statusCode >'=>'1','reviewerId'=>$this->Auth->user('id'));
	var $paginate = array(
		'limit' => 10,
		'order' => array('Review.id' => 'asc'),
		'conditions'=>array('Review.invalidReview'=>false, 'Review.statucCode'=>'2')
	);
	
	function admin_index(){
		$data = $this->paginate('Review');
		$this->set('reviews',$data);
	}
	
	function reviewer_index(){
	//debug($this);exit;
	//$this->Session->write('ReviewConditions','hello');
	//debug($this->Session->read('ReviewConditions'));
		//if(empty($this->Session->read('ReviewConditions'))){
			//$this->Session->write('ReviewConditions',$this->defaultCond);
		//}
		//$cond=$this->Session->read('ReviewConditions');
		$this->paginate = null;
		$this->paginate = array(
			'limit' => 10,
			'order' => array('Review.worksheetId' => 'asc'),
			'conditions'=>array('invalidReview'=>false,'statusCode'=>'2','reviewerId'=>$this->Auth->user('id'))
			//'conditions'=>$this->Session->read('ReviewConditions')
			//'conditions'=>$cond
		);
		$data = $this->paginate('Review');
		$this->set('reviews',$data);
	
	}
	
	function reviewer_submit(){
		//debug($this->params['data']);exit;/*
		$reviewOrder = $this->params['data']['Review']['reviewOrder'];
		$submittedData = $this->params['data']['Review'][$reviewOrder];
		
		$this->Review->reviewDate = date("Y-m-d H:i:s", time());

		
		if($submittedData['review']=='' || $submittedData['letterCode']==''){
			$this->Session->setFlash('Please fill in both review fields.','flashInformation');
			//debug($submittedData);
			$this->set('submittedData',$submittedData);
			
			//$this->redirect($this->referer());
			$this->redirect(array('controller'=>'worksheets','action'=>'reviewer_editReview','id'=>$this->params['data']['Review']['id'],'worksheetId'=>$this->params['data']['Review']['worksheetId']));
			
		}
		$this->Review->id = $submittedData['id'];
		$submittedData['statusCode'] = '3';
		$submittedData['reviewDate'] = date("Y-m-d H:i:s", time());
		if($this->Review->save($submittedData)){
		//if(true){
			$this->Session->setFlash('Review Data Saved','flashSuccess');
			$this->assignToNextReviewer($this->params['data']['Review']['worksheetId'],$reviewOrder+1);
		}else{
			$this->Session->setFlash('Error in saving Review Data','flashError');
		}
		
		$this->paginate = null;
		$this->redirect(array('action'=>'index'));
	}
	
	
	private function assignToNextReviewer($worksheetId,$reviewOrder){
		Classregistry::init('Worksheet')->id = $worksheetId;
		if($reviewOrder=='4'){//third review is also done
			Classregistry::init('Worksheet')->saveField('statusId','8');
			Classregistry::init('Worksheet')->saveField('assignedToId',null);
			return;
		}
		//blindly assignto 2nd reviewer...will get overwritten later appropriately
		//no need now
		//Classregistry::init('Worksheet')->saveField('statusId','5');
		if($reviewOrder == '3'){
			//check the status and assign to third reviewer
			$firstTwoReviews = $this->Review->find('list', array(
			'fields'=>array('reviewOrder','letterCode'),
			'conditions'=>array('worksheetId'=>$worksheetId,'invalidReview'=>false)
			));
			
			if(($firstTwoReviews['1']==$firstTwoReviews['2'])||(($firstTwoReviews['1']=='81'||$firstTwoReviews['1']=='8A')&&($firstTwoReviews['2']=='81'||$firstTwoReviews['2']=='8A'))){			
				Classregistry::init('Worksheet')->saveField('statusId','8');
				Classregistry::init('Worksheet')->saveField('assignedToId',null);
				//no need to assign to third reviewer
				// make the worksheet statusId as '8'
				return;
			}else{
				//check if third reviewer is selected or not
				$this->loadModel('Review');
				if($this->Review->find('first',
				array('conditions'=>array('worksheetId'=>$worksheetId,'reviewOrder'=>'3'))))
				{			
					//assign to third reviewer - worksheet pending third review
					Classregistry::init('Worksheet')->saveField('statusId','7');
				}
				else{
					//third reviewer not selected
					Classregistry::init('Worksheet')->saveField('statusId','6');
				}
				//assign to third reviewer
			}
		}
		$nextReview = $this->Review->find('first',array('conditions' => array('worksheetId'=>$worksheetId,'invalidReview'=>false,'statusCode'=>'1','reviewOrder'=>$reviewOrder)));
		if($nextReview){
		$this->Review->id = $nextReview['Review']['id'];
		$this->Review->saveField('assignedDate',date("Y-m-d H:i:s", time()));
		$this->Review->saveField('statusCode','2');
		// set worksheet status id to the next one
		if($reviewOrder=='2')
			Classregistry::init('Worksheet')->saveField('statusId','5');
		//debug($nextReview);exit;
		Classregistry::init('Worksheet')->saveField('assignedToId',$nextReview['Review']['reviewerId']);
		}else{
			if($reviewOrder=='2')
				Classregistry::init('Worksheet')->saveField('statusId','4');
			Classregistry::init('Worksheet')->saveField('assignedToId',null);
		}
	}

}
?>

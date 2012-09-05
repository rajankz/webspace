<?php
/**
 * User: rajankz
 * Date: 7/24/12
 * Time: 2:24 PM
 */
class WorksheetsController extends AppController {
	var $name = 'Worksheet';
	var $useTable = 'worksheets';
	var $paginate = array(
		'limit' => 2,
		'order' => array('Worksheet.id' => 'asc')
	);
	var $worksheetId=null;
	
	public function isAuthorized($user){
	     if(in_array($this->action, array('addEdit'))){
	          if($user['role'] != 'admin' || $user['role'] != 'creator'){
	               return false;
	          }
	     }
	     return true;
	}
	
	function admin_index(){
		//$this->set('worksheets',$this->Worksheet->find('all'));
		$data = $this->paginate('Worksheet');
		$this->set('worksheets',$data);
	}
	
	function admin_addWorksheet(){
		$this->redirect(array('action'=>'addEdit','admin'=>true));
	}
	
	function admin_editWorksheet(){
		$id=$this->params['named']['id'];
		$this->redirect(array('action'=>'addEdit','admin'=>true,$id));
	}
	
	function admin_deleteWorksheets(){
		debug($this);
	
	}
	
	function admin_deleteWorksheet(){
		if(empty($this->request['named']['id'])){
			$this->Session->setFlash('Invalid or No Worksheet ID passed',true);
			$this->redirect(array('action'=>'index','admin'=>true));
		}
		if($this->Worksheet->delete($this->request['named']['id'])){
			$this->Session->setFlash('Worksheet Deleted',true);
			$this->redirect(array('action'=>'index','admin'=>true));
		}
		
	
	}
	
	function admin_addEdit($id=null){
		//debug($this);exit;
		if($id==null ){
			$this->set('worksheet',null);
		}else{
			$worksheetId = $id;
			$worksheetData = $this->Worksheet->findById($id);
			if(empty($worksheetData)){
				$this->Session->setFlash('Invalid record ID or Record Deleted.',true);
				$this->redirect(array('action'=>'index','admin'=>true));
			}
			$this->set('worksheet',$worksheetData);
		}
		$this->loadModelData();
	}
	
	function loadModelData(){
		$this->loadModel('Roles');
		$this->loadModel('SelectOptions');
		$this->loadModel('Users');
		$this->loadModel('Review');
		
		$this->set('roleOptions',$this->Roles->find('list',array('fields'=>array('Roles.role_name','Roles.role_name'))));

        $financialBlockOptions = array();
		$financialBlocks = $this->SelectOptions->find('all',array(
            'fields'=>array('SelectOptions.code', 'SelectOptions.name'),
			'conditions'=>array('SelectOptions.type'=>'block','SelectOptions.subtype'=>'financial')
		));
		foreach ($financialBlocks as $row) {
			$financialBlockOptions[$row['SelectOptions']['code']] = $row['SelectOptions']['code'] .' - '. $row['SelectOptions']['name'];
		}
		$this->set('financialBlockOptions', $financialBlockOptions);

        $judicialBlockOptions = array();
        $judicialBlocks = $this->SelectOptions->find('all',array(
            'fields'=>array('SelectOptions.code', 'SelectOptions.name'),
            'conditions'=>array('SelectOptions.type'=>'block','SelectOptions.subtype'=>'judicial')
        ));
        foreach ($judicialBlocks as $row) {
            $judicialBlockOptions[$row['SelectOptions']['code']] = $row['SelectOptions']['code'] .' - '. $row['SelectOptions']['name'];
        }
        $this->set('judicialBlockOptions', $judicialBlockOptions);
        
        $this->set('reviewerOptions',$this->Users->find('list',array('fields'=>array('Users.id','Users.fullName'),
        	'conditions'=>array('Users.role'=>'reviewer')
        )));
        
        $reviewsData = $this->Review->find('all',array(
        	'conditions'=>array('Review.worksheetId'=>$this->viewVars['worksheet']['Worksheet']['id'])
        ));
        //debug($reviewsData);exit;
        $reviewsData = Set::combine($reviewsData,'{n}.Review.reviewOrder','{n}.Review');
        //debug($reviewsData);exit;
        $this->set('reviews',$reviewsData);
        
	}
	
	function admin_submitWorksheetForm(){
		$this->Session->write('worksheetData',$this->params['data']['Worksheet']);
		$this->Session->write('reviewData',$this->params['data']['Review']);

		if(isset($this->params['data']['saveButton'])){
			$this->redirect(array('action'=>'saveWorksheet','admin'=>true));
		}else{
			$this->redirect(array('action'=>'submitWorksheet','admin'=>true));
		}	
	}
	
	function admin_saveWorksheet(){
		$worksheetData = $this->Session->read('worksheetData');
		
		
		$this->loadModel('Review');
		
		if(empty($worksheetData['uid'])){
			$this->Session->setFlash('We need University ID to save/submit form.');
			$this->redirect(array('action'=>'addEdit','admin'=>true));
		}
		
		if(empty($worksheetData['id'])){
			$this->Worksheet->create();
		}
		
		if($worksheetData['statusId']=='0' || $worksheetData['statusId']=='1'){
			$worksheetData['statusId']='1';
		}
		
		
		if($this->Worksheet->save($worksheetData)){
			$this->Session->setFlash('Saved Data sucessfully','flashSuccess');
			$this->handleReviewers();
			$this->redirect(array('action'=>'index','admin'=>true));
		}//end of worksheet save
		
		//if($this->Review
		
		
		/*if($this->Worksheet->id == null){
			$this->Worksheet->create();
		}
		*/
		/*
		if($this->WorksheetData->id == null){
			$this->WorksheetData->create();
		}
		
		$this->redirect(array('action'=>'index','admin'=>true));
		/*
		if($this->Worksheet->WorksheetData->save($worksheetData)){
			$this->setflash('Saved Data sucessfully');
			$this->redirect(array('action'=>'index','admin'=>true));
		}
		*/
	}
	
	private function handleReviewers(){
		
			$reviewData = $this->Session->read('reviewData');
			//debug($reviewData);exit;
			if(!empty($reviewData)){
				$reviewFirst = array();$reviewSecond=array();$reviewThird=array();
				
				if(!empty($reviewData['firstReviewerId'])){
					if(empty($reviewData['Id1'])){
						$this->Review->create();
					}else{
						$this->Review->id = $reviewData['Id1'];
					}
					$reviewFirst['reviewerId']=$reviewData['firstReviewerId'];
					$reviewFirst['worksheetId']=$this->Worksheet->id;
					$reviewFirst['reviewOrder']='01';
					if(!$this->Review->save($reviewFirst)){
						$this->Session->setFlash('Reviewer1 Data Not Saved','flashError');
					}
				}else{
					if(!empty($reviewData['Id1'])){
						if(!$this->Review->delete($reviewData['Id1']))
							$this->Session->setFlash('Unable to remove Reviewer1','flashError');
					}
				}
				
				
				
				if(!empty($reviewData['secondReviewerId'])){
					if(empty($reviewData['Id2'])){
						$this->Review->create();
					}else{
						$this->Review->id = $reviewData['Id2'];
					}
					$reviewSecond['reviewerId']=$reviewData['secondReviewerId'];
					$reviewSecond['worksheetId']=$this->Worksheet->id;
					$reviewSecond['reviewOrder']='02';
					if(!$this->Review->save($reviewSecond)){
						$this->Session->setFlash('Reviewer Data Not Saved','flashError');
					}
				}else{
					if(!empty($reviewData['Id2'])){
						if(!$this->Review->delete($reviewData['Id2']))
							$this->Session->setFlash('Unable to remove Reviewer2','flashError');
					}
				}
				
					
				
				if(!empty($reviewData['thirdReviewerId'])){
					if(empty($reviewData['Id3'])){
						$this->Review->create();
					}else{
						$this->Review->id = $reviewData['Id3'];
					}
					$reviewThird['reviewerId']=$reviewData['thirdReviewerId'];
					$reviewThird['worksheetId']=$this->Worksheet->id;
					$reviewThird['reviewOrder']='03';
					if(!$this->Review->save($reviewThird))
						$this->Session->setFlash('Reviewer Data Not Saved','flashError');
				}else{
					if(!empty($reviewData['Id3'])){
						if(!$this->Review->delete($reviewData['Id3']))
							$this->Session->setFlash('Unable to remove Reviewer3','flashError');
					}
				}

			}
	}
	
	/*
	function admin_saveWorksheet(){
		$worksheetData = $this->Session->read('worksheetData');
		if(empty($worksheetData){
			$this->Session->setFlash('Erro while saving. Empty form found!');
			$this->redirect(array('action'=>'addEdit','admin'=>true));
		}
		if($this->Worksheet->id == null){
			$this->Worksheet->create();
		}
		/*
		if($this->Worksheet->WorksheetData->save($worksheetData)){
			$this->setflash('Saved Data sucessfully');
			$this->redirect(array('action'=>'index','admin'=>true));
		}
	}
	
	
	/*
		
	function admin_submitWorksheet(){
		debug('submit');
		exit;
	}
	

	
	

	
	
	/*

	function creator_add(){
		debug($this);
		exit;
		return $this->setAction('add_edit','creator'=>true);
		//$this->redirect('controller'=>'worksheet','action'=>'add_edit');
	}
	function add(){
		debug($this);exit;
	}
	function creator_edit(){
		return $this->setAction('add_edit',$this->Worksheet);
	}
	
	function admin_add(){
		//debug('here');
		//return $this->setAction('add_edit');
	}
	function admin_edit(){
		return $this->setAction('add_edit',$this->Worksheet);
	}

	function add_edit($worksheet = null){
		$this->set('worksheet',$worksheet);
		$this->loadModelData();
	}
	
	function index(){}
	function creator_index(){}
	

	//public function beforeFilter(){
	//	$this->loadModelData();
	//}

*/
}

?>

<?php
/**
 * User: rajankz
 * Date: 7/24/12
 * Time: 2:24 PM
 */
App::import('Vendor', 'Uploader.Upload');
class WorksheetsController extends AppController {
	var $name = 'Worksheet';
	var $useTable = 'worksheets';
	var $defaultCond=array("NOT"=>array('Worksheet.statusId'=>array('8')));
	var $cond = '';
	var $paginate = array(
		'limit' => 10,
		'order' => array('Worksheet.id' => 'asc')
	);
	var $worksheetId=null;
	
	/** COMMON **/
	public  function isAuthorized($user){
	     if(in_array($this->action, array('addEdit'))){
	          if($user['role'] != 'admin' || $user['role'] != 'creator'){
	               return false;
	          }
	     }
	     return true;
	}
	private function addEdit($id=null){
		if($id==null ){
			$this->set('worksheet',null);
			$copiedWorksheet = $this->Session->read('copiedWorksheet');
			if(!empty($copiedWorksheet)){
				$this->set('copiedWorksheet',$this->Session->read('copiedWorksheet'));
				$this->Session->delete('copiedWorksheet');
			}
			
		}else{
			$worksheetId = $id;
			$worksheetData = $this->Worksheet->findById($id);
			
			if(empty($worksheetData)){
				$this->Session->setFlash('Invalid record ID or Record Deleted.',true);
				$this->redirect(array('action'=>'index','admin'=>true));
			}
			//debug($worksheetData);exit;
			$this->set('worksheet',$worksheetData);
			//$this->Session->write('worksheet',$worksheetData);
		}
		$this->loadModelData();
	}
	private function loadSemesterOptions(){
		if(!ClassRegistry::isKeySet('SelectOptions')){
			$this->loadModel('SelectOptions');
		}
		
		$this->set('semOptions',$this->SelectOptions->find('list',	array(
		'fields'=>array('SelectOptions.code', 'SelectOptions.name'),
		'conditions'=>array('SelectOptions.type'=>'worksheet', 'SelectOptions.subtype'=>'semester')
		)));
	}
	private function loadRoleOptions(){
		if(!ClassRegistry::isKeySet('SelectOptions')){
			$this->loadModel('SelectOptions');
		}
		$this->set('roleOptions',$this->Roles->find('list',array('fields'=>array('Roles.role_name','Roles.role_name'))));
	}
	private function loadWorksheetStatuses(){
		
	}
	private function loadWorksheetSemesters(){
		$this->loadModel('Semester');
		$semesterData = $this->Semester->find('all', array(
        	'conditions'=>array('Semester.worksheetId'=>$this->viewVars['worksheet']['Worksheet']['id'])));
        //$semesterData = Set::combine($semesterData,'{n}.Semester.order')	
        $this->set('semesterData',$semesterData);
		
	}
	private function loadModelData(){
		$this->loadModel('Roles');
		$this->loadModel('SelectOptions');
		$this->loadModel('User');
		$this->loadModel('Review');
		$this->loadWorksheetSemesters();
		
		$this->loadRoleOptions();
		$this->loadSemesterOptions();

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
        
        $this->set('reviewerOptions',$this->User->find('list',array('fields'=>array('User.id','User.fullName'),
        	'conditions'=>array('User.role'=>'reviewer', 'User.is_active'=>true)
        )));
        
        $reviewsData = $this->Review->find('all',array(
        	'conditions'=>array('Review.worksheetId'=>$this->viewVars['worksheet']['Worksheet']['id'])
        ));
        //debug($reviewsData);exit;
        $reviewsData = Set::combine($reviewsData,'{n}.Review.reviewOrder','{n}.Review');
        //debug($reviewsData);exit;
        $this->set('reviews',$reviewsData);
        
	}
	private function filterWorksheet(){
		$this->Session->write('WorksheetFilters',$this->data['WorksheetFilters']);
		if(isset($this->params['data']['applyFilter'])){
			$this->applyFilters();
		}
		if(isset($this->params['data']['restoreDefault'])){
			$this->restoreDefault();
		}	
	}
	private function applyFilters(){
		$filters = $this->Session->read('WorksheetFilters');
		$uid = $filters['uid'];
		$sem = $filters['sem'];
		$studentName = $filters['name'];
		$status=intval($filters['status']);
		$assignedTo=intval($filters['assignedTo']);
		$cond = array(
			'uid LIKE'=>(!empty($uid))?"%$uid%":"%",
			'applicantName LIKE'=>(!empty($studentName))?"%$studentName%":"%",
			'sem LIKE'=>(!empty($sem))?"%$sem%":"%",
			'statusId'=>($status==-1 || $status==0)?array(1,2,3,4,5,6,7):$status,
			'(assignedToId '.($assignedTo>0?'='.$assignedTo.')':(($assignedTo==-1)?'IS NULL)':'IS NULL OR assignedToId IS NOT NULL)')),
						
		);
		//debug($this->cond);
		if(!empty($cond))
			$this->Session->write('WorksheetConditions',$cond);
		else
			$this->Session->write('WorksheetConditions', $this->defaultCond);
		$this->paginate = null;
		$this->redirect(array('action'=>'index'));
	}
	private function restoreDefault(){
		$this->Session->write('WorksheetConditions', $this->defaultCond);
		$this->Session->delete('WorksheetFilters');
		$this->paginate = null;
		$this->redirect(array('action'=>'index'));
	}
	private function duplicateWorksheet(){
		$worksheetData = $this->Session->read('worksheetData');
		unset($worksheetData['id']);
		$worksheetData['statusId']='1';		
		$semesterData = $this->Session->read('semesterData');
		$copiedWorksheet = array('Worksheet'=>$worksheetData,'Semester'=>$semesterData);
		$this->Session->write('copiedWorksheet',$copiedWorksheet);
		$this->redirect(array('action'=>'addEdit'));
	}
	private function handleReviewers(){
		$this->loadModel('Review');
		$reviewData = $this->Session->read('reviewData');
		$worksheetData = $this->Session->read('worksheetData');
		//debug($reviewData);debug($worksheetData);exit;
		if(empty($reviewData)){
			return true;
		}
		$reviewFirst = array();$reviewSecond=array();$reviewThird=array();
		
		if($worksheetData['statusId']<=3){
		if(!empty($reviewData['firstReviewerId'])){
			if(empty($reviewData['Id1'])){
				$this->Review->create();
			}else{
				$this->Review->id = $reviewData['Id1'];
			}
				$reviewFirst['reviewerId']=$reviewData['firstReviewerId'];
				$reviewFirst['worksheetId']=$this->Worksheet->id;
				$reviewFirst['reviewOrder']='01';
				//debug($reviewFirst);exit;
				if(!$this->Review->save($reviewFirst)){
					$this->Session->setFlash('Reviewer1 Data Not Saved','flashError');
				}
		}else{
			if(!empty($reviewData['Id1'])){
				if(!$this->Review->delete($reviewData['Id1']))
					$this->Session->setFlash('Unable to remove Reviewer1','flashError');
			}
		}
		}
		
		if($worksheetData['statusId']<=4){
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
		}
		
		if($worksheetData['statusId']<=6){
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
	private function handlePreviousSemesters(){
		$this->loadModel('Semester');
		$semesterData = $this->Session->read('semesterData');
		$semesterIds = $this->Session->read('semesterIds');
		//debug($semesterData);debug($semesterIds);
		if(empty($semesterData) && empty($semesterIds))
			return true;
		
		//$numPrevSems = count($semesterData);
		$semCounter='0';
		if(!empty($semesterData))
		foreach($semesterData as $oneSemesterData){
			//debug($semesterIds);
			//debug($semesterIds[++$semCounter]);
			if(!isset($semesterIds[++$semCounter])){
				//debug('hello');
				$this->Semester->create();
			}
			else
				$this->Semester->id=$semesterIds[$semCounter];
			//debug($oneSemesterData);
			//$oneSemesterData['id']=$this->Semester->id;
			$oneSemesterData['worksheetId']=$this->Worksheet->id;
			$oneSemesterData['order']=$semCounter;
			//debug($this->Semester->id);
			//debug($oneSemesterData);exit;
			//debug($this->Semester->id);debug($oneSemesterData);
			if(!$this->Semester->save($oneSemesterData)){
				$this->Session->setFlash('Unable to save Semester data','flashError');
				return false;
			}
		}
		//delete extra sems
		while(!empty($semesterIds[++$semCounter])){
			$this->Semester->id=$semesterIds[$semCounter];
			if(!$this->Semester->delete()){
				$this->Session->setFlash('Unable to delete Semester details. Please try later','flashError');
				return false;
			}
		}
		
			
		//debug(count($semesterData));
	}
	private function handleUploads(){
		$this->loadModel('Attachment');
		$newAttachmentData = $this->Session->read('attachmentData');
		$prevAttachmentIds = $this->Session->read('attachmentIds');
		//debug($newAttachmentData);
		//debug($prevAttachmentIds);
		if(empty($newAttachmentData) && empty($prevAttachmentIds))
			return true;
		$this->Uploader = new Uploader(array('tempDir' => TMP));	
		$attachmentCounter = 0;
		if(!empty($newAttachmentData)){
			foreach($newAttachmentData as $oneAttachment){
				//debug($oneAttachment['id']);
				if(!isset($oneAttachment['id'])){
					$this->Attachment->create();
					//debug($oneAttachment);
					$oneAttachment['filename']=$oneAttachment['file']['name'];
				}else{
					//exisiting attachemnt -> remove from attachemnt Ids
					unset($prevAttachmentIds[$oneAttachment['id']]);
					$this->Attachment->id=$oneAttachment['id'];
				}
					
				$oneAttachment['order']=$attachmentCounter++;
				$oneAttachment['worksheetId']=$this->Worksheet->id;
								
				if(!($this->Attachment->save($oneAttachment))){
					$this->Session->setFlash('Unable to upload files','flashError');
					return false;
				}	
			}
		}
			
			//while(!empty($prevAttachmentIds[++$attachmentCounter])){
		if(!empty($prevAttachmentIds))
			foreach($prevAttachmentIds as $onePrevAttachmentId){
				//debug($onePrevAttachmentId);exit;
				$this->Attachment->id=$onePrevAttachmentId;
				if(!$this->Attachment->delete()){
					$this->Session->setFlash('Unable to delete file. Please try later','flashError');
					return false;
				}
			}
		
		return true;		
	}
	private function saveWorksheet($worksheetData=null){
		if(empty($worksheetData))
			$worksheetData = $this->Session->read('worksheetData');
		if(empty($worksheetData['uid'])){
			$this->Session->setFlash('We need University ID to save/submit form.');
			$this->redirect(array('action'=>'addEdit'));
		}
		
		if(empty($worksheetData['id'])){
			$this->Worksheet->create();
			$this->Session->write('worksheetId',$this->Worksheet->id);
		}
		
		if($worksheetData['statusId']=='0' || $worksheetData['statusId']=='1'){
			$worksheetData['statusId']='1';
		}
		
		if($this->Worksheet->save($worksheetData)){
			$this->handlePreviousSemesters();
			if(!$this->handleUploads()){
				$this->Session->setFlash('Failed file upload section','flashError');
				$this->redirect(array('action'=>'index'));
			}
			$this->Session->setFlash('Saved Data sucessfully','flashSuccess');
			if($this->isAdmin()){
				$this->handleReviewers();
			}
		}//end of worksheet save
		else{
			$this->Session->setFlash('Unable to save worksheet. Please retry again','flashError');
		}
		
	}
	private function submitWorksheet($worksheetData=null){
		if(empty($worksheetData))
			$worksheetData = $this->Session->read('worksheetData');
		if($worksheetData['statusId']<2)
			$worksheetData['statusId']='2';
		$this->Session->write('worksheetData',$worksheetData);
		$this->saveWorksheet();
		if($this->isAdmin())
			$this->submitReviewers();
		$this->redirect(array('action'=>'index'));
	}	
	private function submitReviewers($worksheetId=null){
		if($worksheetId==null)
			$worksheetId = $this->Worksheet->id;
		if(empty($worksheetData))
			$worksheetData = $this->Session->read('worksheetData');
		//debug($worksheetId);exit;
		$this->loadModel('Review');
		if($worksheetData['statusId']<3){
			$firstReviewArray = $this->Review->find('all',array(
			'conditions'=>array('worksheetId'=>$worksheetId,'reviewOrder'=>'1')
			));
			//extract first element of array
			foreach ($firstReviewArray as $firstReview) {	}
			if(!empty($firstReview)){
				$firstReview['Review']['statusCode']='2';
				$firstReview['Review']['assignedDate']=date("Y-m-d H:i:s", time());
				$this->Review->save($firstReview);
				$this->Worksheet->saveField('assignedToId',$firstReview['Review']['reviewerId']);
				$this->Worksheet->saveField('statusId','3');
			}else{
				$this->Session->setFlash('Reviewers Not Assigned','flashError');
				$this->redirect(array('action'=>'addEdit','admin'=>true,$worksheetId));
			}
		}
		if($worksheetData['statusId']==5){
			$thirdReviewArray = $this->Review->find('all',array(
			'conditions'=>array('worksheetId'=>$worksheetId,'reviewOrder'=>'3')
			));
			//extract first element of array
			foreach ($thirdReviewArray as $thirdReview) {	}
			if(!empty($thirdReview)){
				$thirdReview['Review']['statusCode']='2';
				$thirdReview['Review']['assignedDate']=date("Y-m-d H:i:s", time());
				$this->Review->save($thirdReview);
				$this->Worksheet->saveField('assignedToId',$thirdReview['Review']['reviewerId']);
				$this->Worksheet->saveField('statusId','6');
			}else{
				$this->Session->setFlash('Reviewers Not Assigned','flashError');
				$this->redirect(array('action'=>'addEdit','admin'=>true,$worksheetId));
			}
		}
	}
	private function worksheetIndex(){
		if($this->Session->check('WorksheetConditions'))
			$cond = $this->Session->read('WorksheetConditions');
		else
			$cond = $this->defaultCond;
		$data = $this->paginate('Worksheet',$cond);
		$this->set('worksheets',$data);
		$this->loadModel('User');
		$this->set('reviewers',$this->User->find('list', 
		array(
		'fields'=>array('User.id','User.fullName'),
		'conditions'=>array('role'=>'reviewer'))));
		$this->loadSemesterOptions();
	}
	
	/** ADMIN  **/
	function admin_index(){
		$this->worksheetIndex();
	}
	function admin_filterWorksheet(){
		$this->filterWorksheet();	
	}
	function admin_addWorksheet(){
		$this->redirect(array('action'=>'addEdit','admin'=>true));
	}
	function admin_editWorksheet(){
		$id=$this->params['named']['id'];
		$this->redirect(array('action'=>'addEdit','admin'=>true,$id));
	}
	function admin_addEdit($id=null){
		$this->addEdit($id);
	}
	function admin_deleteWorksheets(){
		debug($this);
	
	}
	function admin_deleteWorksheet(){
		$worksheetData = $this->Session->read('worksheetData');
		$worksheetId = "";
		if(!empty($worksheetData))
			$worksheetId = $worksheetData['id'];
		if(empty($worksheetId)){
			$this->Session->setFlash('Invalid or No Worksheet ID passed','flashError');
			$this->redirect($this->referer());
		}
		if($this->Worksheet->delete($worksheetId)){
			$this->Session->setFlash('Worksheet Deleted','flashSuccess');
			$this->redirect(array('action'=>'index','admin'=>true));
		}
	}
	function admin_submitWorksheetForm(){
		/** save data to session */
		$worksheetData = $this->params['data']['Worksheet'];
		$this->Session->write('worksheetData',$worksheetData);
		$this->Session->write('reviewData',empty($this->params['data']['Review'])?null:$this->params['data']['Review']);
		$this->Session->write('semesterData',empty($this->params['data']['Semester'])?null:$this->params['data']['Semester']);
		$this->Session->write('semesterIds',empty($this->params['data']['SemesterIds'])?null:$this->params['data']['SemesterIds']);
		//debug($this->params['data']);
		$this->Session->write('attachmentData',empty($this->params['data']['Attachment'])?null:$this->params['data']['Attachment']);
		$this->Session->write('attachmentIds',empty($this->params['data']['AttachmentIds'])?null:$this->params['data']['AttachmentIds']);
		/** foreward to appropirate action/method */
		if(isset($this->params['data']['saveButton'])){
			$this->saveWorksheet();
			$this->redirect(array('action'=>'index'));
		}
		if(isset($this->params['data']['submitButton'])){
			$this->submitWorksheet();
		}
		if(isset($this->params['data']['finalizeButton'])){
			$this->redirect(array('action'=>'finalizeWorksheet','admin'=>true));
		}
		if(isset($this->params['data']['deleteButton'])){
			$this->redirect(array('action'=>'deleteWorksheet','admin'=>true));
		}
		if(isset($this->params['data']['duplicateButton'])){
			$this->duplicateWorksheet();
		}
	}
	function admin_finalizeWorksheet(){
		$worksheetData = $this->Session->read('worksheetData');
		if($worksheetData['statusId']=='7'){
			$worksheetData['statusId']='8';
		}
		if($this->Worksheet->save($worksheetData)){
			$this->Session->setFlash('Worksheet Finalized','flashSuccess');
		}//end of worksheet save
		$this->redirect(array('action'=>'index','admin'=>true));
	}

	/** CREATOR  **/
	function creator_index(){
		$this->worksheetIndex();
	}
	function creator_filterWorksheet(){
		$this->filterWorksheet();	
	}
	function creator_submitWorksheetForm(){
		$this->Session->write('worksheetData',$this->params['data']['Worksheet']);

		if(isset($this->params['data']['saveButton'])){
			$this->saveWorksheet();
			$this->redirect(array('action'=>'index','creator'=>true));
		}else if(isset($this->params['data']['submitButton'])){
			$this->redirect(array('action'=>'submitWorksheet','creator'=>true));
		}	
	}
	function creator_addWorksheet(){
		$this->redirect(array('action'=>'addEdit','creator'=>true));
	}
	function creator_editWorksheet(){
		$id=$this->params['named']['id'];
		$this->redirect(array('action'=>'addEdit','creator'=>true,$id));
	}
	function creator_addEdit($id=null){
		$this->addEdit($id);
	}
	function creator_submitWorksheet(){
		$worksheetData = $this->Session->read('worksheetData');
		
		if(empty($worksheetData['uid'])){
			$this->Session->setFlash('We need University ID to save/submit form.');
			$this->redirect(array('action'=>'addEdit','admin'=>true));
		}
		if(empty($worksheetData['id'])){
			$this->Worksheet->create();
			$this->Session->write('worksheetId',$this->Worksheet->id);
		}
		if($worksheetData['statusId']=='0' || $worksheetData['statusId']=='1'){
			$worksheetData['statusId']='2';
		}
		if($this->Worksheet->save($worksheetData)){
			$this->Session->setFlash('Saved Data sucessfully','flashSuccess');
			$this->handleReviewers();
		}//end of worksheet save
		$this->redirect(array('action'=>'index','creator'=>true));		
	}
	
	/** REVIEWER  **/
	function reviewer_editReview(){
		//debug($this);exit;
		$worksheetId = $this->params->named['worksheetId'];
		$reviewId=$this->params->named['id'];
		if(empty($reviewId)){
			$this->Session->setFlash('Review Information is Inaccessible','flashError');
			$this->redirect(array('controller'=>'review','action'=>'index'));
		}
		$this->loadModel('Review');
		$reviewData = $this->Review->findById($reviewId);
		//debug($reviewData['Review']['reviewerId']);
		if($reviewData['Review']['reviewerId']!=$this->Auth->user('id')){
			$this->Session->setFlash('You do not have access to that review','flashError');
			$this->redirect(array('controller'=>'review','action'=>'index'));
		}
		if(empty($worksheetId)){
			$this->Session->setFlash('Not a valid worksheet. This worksheet could have been deleted','flashError');
			$this->redirect(array('controller'=>'review','action'=>'index'));
			
		}
		if($reviewData['Review']['worksheetId']!=$worksheetId){
			$this->Session->setFlash('This worksheet cannot be opened. Please contact Administrator','flashError');
			$this->redirect(array('controller'=>'review','action'=>'index'));
		}
		
		$worksheetData = $this->Worksheet->findById($worksheetId);
		//debug($worksheetData);
		$this->set('worksheetData',$worksheetData['Worksheet']);
		$this->set('semesterData',$worksheetData['Semester']);
		$this->set('attachmentData',$worksheetData['Attachment']);
		//debug('hello');exit;
		//$this->loadModel('Review');
		$allReviewsData = $this->Review->find('all',array(
		'conditions'=>array('worksheetId'=>$worksheetId, 'invalidReview'=>false)));
		//debug($allReviewsData);exit;
		$this->set('allReviewsData',$allReviewsData);
		$this->set('userId',$this->Auth->user('id'));
		$this->loadReviewerDecisionCodes();
		
		
	}

}

?>

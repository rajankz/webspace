<?php

class StatsController extends AppController{

	/** ADMIN **/
	function admin_index(){
		$this->loadModel('Worksheet');
		$this->loadModel('Reviews');
		$totalWorksheets = $this->Worksheet->find('count');
		$worksheetsIncomplete=$this->Worksheet->find('count',array('conditions'=>array('Worksheet.statusId<2')));
		$worksheetsDecisionMade=$this->Worksheet->find('count',array('conditions'=>array('Worksheet.statusId=7')));
		
		
		
		//debug($worksheetsIncomplete);
	}
		
}
?>
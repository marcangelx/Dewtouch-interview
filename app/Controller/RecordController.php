<?php
	class RecordController extends AppController{
		public $components = array('DataTable', 'RequestHandler');

		/**
		 * Handling Rest API
		 */
		public function beforeFilter(){
			if ($this->request->accepts('application/json')) {
				$this->RequestHandler->renderAs($this, 'json');
			}
			parent::beforeFilter();
		}

		public function index(){
			ini_set('memory_limit','256M');
			set_time_limit(0);

			$this->setFlash('Listing Record page too slow, try to optimize it.');

			// $records = $this->Record->find('all');
			// $this->set('records',$records);

			$this->set('title',__('List Record'));
		}

		/**
		 * Display records by paginate
		 */
		public function display(){
			$this->paginate = array(
				'fields' => array('Record.id','Record.name'),
			);

			$this->DataTable->mDataProp = true;
			$this->set('response', $this->DataTable->getResponse());
			$this->set('_serialize','response');
		}
		
		
// 		public function update(){
// 			ini_set('memory_limit','256M');
			
// 			$records = array();
// 			for($i=1; $i<= 1000; $i++){
// 				$record = array(
// 					'Record'=>array(
// 						'name'=>"Record $i"
// 					)			
// 				);
				
// 				for($j=1;$j<=rand(4,8);$j++){
// 					@$record['RecordItem'][] = array(
// 						'name'=>"Record Item $j"		
// 					);
// 				}
				
// 				$this->Record->saveAssociated($record);
// 			}
			
			
			
// 		}
	}
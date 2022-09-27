<?php
    App::import('Vendor', 'SimpleXLSX');
	use Shuchkin\SimpleXLSX;
	class MigrationController extends AppController{
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

		public function q1(){
			// $this->loadModel('Member');
			// $this->setFlash('Question: Migration of data to multiple DB table');
			// $aMembers = $this->Member->find('all');
			// debug($aMembers);exit;
			
// 			$this->set('title',__('Question: Please change Pop Up to mouse over (soft click)'));
		}
		
		public function q1_instruction(){

			$this->setFlash('Question: Migration of data to multiple DB table');
				
			
			
// 			$this->set('title',__('Question: Please change Pop Up to mouse over (soft click)'));
		}

		/**
		 * Main function for importing data from xlsx file
		 */
		public function import()
		{
			$this->layout = false;
			$data = $this->request->data;
			$file = $data['file']['tmp_name'];
			if ( $xlsx = SimpleXLSX::parse($data['file']['tmp_name']) ) {
				// debug($xlsx->rows());exit;
			} else {
				$this->setError('File must be in xlsx format :' . SimpleXLSX::parseError());
				$this->redirect('/Migration/q1');
			}

			$aFormattedData = $this->_getData($xlsx->rows());
			$aResponse = $this->_getColumns($aFormattedData);
			
			$this->loadModel('Member');
			if ($this->Member->saveAll($aResponse,  array('deep' => true))) {
				$this->setSuccess('Successfuly inserted data');
			} else {
				$this->setError('Failed to save the data');
			}
			
		
			$this->redirect('/Migration/q1');
		}

				/**
		 *  Get member columns
		 */
		protected function _getColumns($aColumns = array())
		{
			$aNewData = array();
			$iNumberTransaction = 0;
			foreach ($aColumns as $sKey => $aValue) {
				$aNewData[] = array(
					'Member' => $this->_getMemberColumns($sKey, $aValue, $iNumberTransaction),
					
				);
				$iNumberTransaction++;
			}
			return $aNewData;
		}

		/**
		 *  Get member columns
		 */
		protected function _getMemberColumns($sKey, $aValue, $iNumberTransaction)
		{

			$aData = explode(' ', $aValue['Member No']);
			$aMember = array(
				'type'    => $aData[0],
				'no'      => $aData[1],
				'name'    => $aValue['Member Name'],
				'company' => $aValue['Member Company'],
				'valid'   => 1,
				'Transaction'     => array(
					$this->_getTransactionColumns($sKey, $aValue, $iNumberTransaction)
				),
			);
			return $aMember;
		}

		/**
		 *  Get transaction columns
		 */
		protected function _getTransactionColumns($sKey, $aValue, $iNumberTransaction)
		{
			$aData = explode(' ', $aValue['Member Name']);
			
			$aYear = explode('-', $aValue['Date']);
			$sMemberType = (!empty($aValue['Member Pay Type']))? $aValue['Member Pay Type'] : ' ';
			$sMemberCompany = (!empty($aValue['Member Company']))? $aValue['Member Company'] : ' ';
			$aTransaction = array(
				'member_name'    => $aValue['Member Name'],
				'member_paytype' => $sMemberType,
				'member_company' => $sMemberCompany,
				'date'           => $aValue['Date'],
				'year'           => $aYear[0],
				'month'          => $aYear[1],
				'ref_no'         => $aValue['Ref No.'],
				'receipt_no'     => $aValue['Receipt No'],
				'payment_method' => $aValue['Payment By'],
				'batch_no'       => (!empty($aValue['Batch No']))? $aValue['Batch No'] : ' ',
				'cheque_no'      => $aValue['Cheque No'],
				'renewal_year'   => (!empty($aValue['Renewal Year']))? $aValue['Renewal Year'] : ' ',
				'subtotal'       => $aValue['subtotal'],
				'tax'            => $aValue['totaltax'],
				'total'          => $aValue['total'],
				'valid'          => 1,
				'TransactionItem' => array(
					$this->_getTransactionItemsColumns($sKey, $aValue, $iNumberTransaction)
					)
			);
				
			return $aTransaction;
		}

		/**
		 *  Get transaction item columns
		 */
		protected function _getTransactionItemsColumns($sKey, $aValue, $iNumberTransaction = 0)
		{
			$aData = explode(' ', $aValue['Member Name']);
			$TransactionItem = array(
				'transaction_id'    => $iNumberTransaction,
				'description'       => 'Being Payment for:' . $aValue['Payment Description'] . ': ' . $aValue['Renewal Year'],
				'quantity'          => $iNumberTransaction,
				'unit_price'        => $aValue['subtotal'],
				'uom'               => null,
				'sum'               => $aValue['subtotal'],
				'valid'             => 1,
				'table'             => 'Member',
				'table_id'          => $aData[2]
			);
			return $TransactionItem;
		}

		/**
		 * Format excel data
		 */
		protected function _getData($oData, $aAllowedData = array())
		{
			$header_values = $rows = [];
			foreach ($oData as $sKey => $aValue) {
				if ($sKey === 0) {
					$header_values = $aValue;
					continue;
				}
	
					$rows[] = array_combine( $header_values, $aValue);
				 
			}
			return $rows;
		}
		
	}
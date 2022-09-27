<?php
	class TransactionItem extends AppModel{
		
		var $belongsTo = array(
            'Transaction' => array(
                'className' => 'Transaction',
                'foreignKey' => 'transaction_id'
            )
        );
      
	}
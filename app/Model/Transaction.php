<?php
	class Transaction extends AppModel{
		
		var $belongsTo = array(
            'Member' => array(
                'className' => 'Member',
                'foreignKey' => 'member_id'
            )
        );

        var $hasMany = array(
            'TransactionItem' => array(
                'className' => 'TransactionItem',
                'conditions' => array(
                    'TransactionItem.valid' => 1
                    )
            )
        );

	}
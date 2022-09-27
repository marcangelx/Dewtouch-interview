<?php

class Member extends AppModel{
	var $hasMany = array(
		'Transaction' => array(
			'className' => 'Transaction',
			'conditions' => array(
				'Transaction.valid' => 1
				)
		)
	);

}
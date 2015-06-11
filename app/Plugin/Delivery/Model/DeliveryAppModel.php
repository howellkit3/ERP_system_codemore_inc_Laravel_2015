<?php

App::uses('AppModel', 'Model');

class DeliveryAppModel extends AppModel {

	public $validate = array(

	'delivery_uuid' => array(
		
		 'Numeric' => array(
            'rule' => 'Numeric',
            'required' => true,
            'message' => 'Delivery Receipt should be numbers only'
        ),
			'unique' => array(
			'rule'    => 'isUnique',
			'message' => 'Delivery receipt should be unique.'
			),				
	)
);




}

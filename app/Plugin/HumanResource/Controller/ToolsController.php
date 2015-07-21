<?php
App::uses('AppController', 'Controller');
App::uses('SessionComponent', 'Controller/Component');


class ToolsController  extends HumanResourceAppController {

	var $helpers = array('HumanResource.CustomText','HumanResource.Country');

	public function find($name = null) {

			$this->layout = false;

			if (!empty($name)) {

			$conditions = array('OR' => 
					array('Tool.name LIKE' => '%'.$name.'%')
					);

			$limit = 10;

			$this->paginate = array(
	            'conditions' => $conditions,
	            'limit' => $limit,
	            //'fields' => array('id', 'status','created'),
	            'order' => 'Tool.name DESC',
	        );

	        $tools = $this->paginate();

	        $this->set(compact('tools'));

		}

	}
	


}
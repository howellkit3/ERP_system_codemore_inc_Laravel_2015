<?php
App::uses('AppController', 'Controller');
App::uses('SessionComponent', 'Controller/Component');


class ToolingsController  extends HumanResourceAppController {

	var $helpers = array('HumanResource.CustomText','HumanResource.Country');

	public function assign() {

		$this->loadModel('HumanResource.Tool');

		$tools = $this->Tool->find('all');

		$this->set(compact($tools));

	}


}
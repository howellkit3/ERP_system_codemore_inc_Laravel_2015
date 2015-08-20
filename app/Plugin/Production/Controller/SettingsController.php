<?php
App::uses('AppController', 'Controller');
App::uses('SessionComponent', 'Controller/Component');

class SettingsController extends ProductionAppController {
	
	public function machines() {

        $this->loadModel('Production.Machine');

        $this->loadModel('Production.Department');

        $this->loadModel('Production.Section');

        $limit = 10;

        $conditions = array();

        $params =  array(
                'conditions' => $conditions,
                'limit' => $limit,
                //'fields' => array('id', 'status','created'),
                'order' => 'Machine.id ASC',
            );

        $this->paginate = $params;

        $machineData = $this->paginate('Machine');

        $departmentList = $this->Department->find('list',array('fields' => array('id','name')));

        $sectionList = $this->Section->find('list',array('fields' => array('id','name')));

        $this->set(compact('machineData','departmentList','sectionList'));
		
    }

}
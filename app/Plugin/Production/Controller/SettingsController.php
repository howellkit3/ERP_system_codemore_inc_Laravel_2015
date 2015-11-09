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
                'order' => 'Machine.id DESC',
            );

        $this->paginate = $params;

        $machineData = $this->paginate('Machine');

        $departmentList = $this->Department->find('list',array('fields' => array('id','name')));

        $sectionList = $this->Section->find('list',array('fields' => array('id','name')));

        $this->loadModel('Production.ProcessDepartment');
        $processDepartmentData = $this->ProcessDepartment->find('list',array('fields' => array('id','name')));

        $this->set(compact('machineData','departmentList','sectionList','processDepartmentData'));
		
    }

    public function departments() {

        $this->loadModel('Production.Department');

        $limit = 10;

        $conditions = array();

        $params =  array(
                'conditions' => $conditions,
                'limit' => $limit,
                //'fields' => array('id', 'status','created'),
                'order' => 'Department.id ASC',
            );

        $this->paginate = $params;

        $departmentData = $this->paginate('Department');

        $this->set(compact('departmentData'));
        
    }

    public function sections() {

        $this->loadModel('Production.Department');

        $this->loadModel('Production.Section');

        $limit = 10;

        $conditions = array();

        $params =  array(
                'conditions' => $conditions,
                'limit' => $limit,
                //'fields' => array('id', 'status','created'),
                'order' => 'Section.id DESC',
            );

        $this->paginate = $params;

        $sectionData = $this->paginate('Section');

        $departmentList = $this->Department->find('list',array('fields' => array('id','name')));

        $this->set(compact('sectionData','departmentList'));
        
    }

    public function processes() {

        $this->loadModel('Production.ProcessDepartment');

        $limit = 10;

        $conditions = array();

        $params =  array(
                'conditions' => $conditions,
                'limit' => $limit,
                //'fields' => array('id', 'status','created'),
                'order' => 'ProcessDepartment.id DESC',
            );

        $this->paginate = $params;

        $process = $this->paginate('ProcessDepartment');

        $this->set(compact('process'));
        
    } 

}
<?php
App::uses('AppController', 'Controller');
App::uses('SessionComponent', 'Controller/Component');

class MachinesController extends ProductionAppController {

    public function add() {

    	$this->loadModel('Production.Department');

    	$this->loadModel('Production.Section');

    	$departmentList = $this->Department->find('list',array('fields' => array('id','name')));

    	$sectionList = $this->Section->find('list',array('fields' => array('id','name')));

    	$auth = $this->Session->read('Auth.User');

		if(!empty($this->request->data)){
			
			$this->Machine->saveMachine($this->request->data,$auth['id']);

			//$save
	 		$this->Session->setFlash('Saving Machine information completed','success');

 		   	$this->redirect( array(
                     'controller' => 'settings', 
                     'action' => 'machines',
                     'tab' => 'machines'
                ));
		}

    	$this->set(compact('departmentList','sectionList'));

    }

    public function edit($id = null) {

        $this->loadModel('Production.Department');

        $this->loadModel('Production.Section');

        $departmentList = $this->Department->find('list',array('fields' => array('id','name')));

        $sectionList = $this->Section->find('list',array('fields' => array('id','name')));

        $auth = $this->Session->read('Auth.User');

        if(!empty($this->request->data)){
            
            $this->Machine->saveMachine($this->request->data,$auth['id']);

            //$save
            $this->Session->setFlash('Saving Machine information completed','success');
            $this->redirect( array(
                     'controller' => 'settings', 
                     'action' => 'machines',
                     'tab' => 'machines'
                ));
        }
        
        if (!empty($id)) {

            $this->request->data = $this->Machine->findById($id);

        }

        $this->set(compact('departmentList','sectionList'));

    }

    public function delete($posId){

        $this->loadModel('HumanResource.Machine');

        if (!empty($posId)) {

            if ($this->Machine->delete($posId)) {
                $this->Session->setFlash(
                    __('Machine Successfully deleted.', h($posId))
                );
            } else {
                $this->Session->setFlash(
                    __('Machine cannot be deleted.', h($posId))
                );
            }

            return $this->redirect( array(
                     'controller' => 'settings', 
                     'action' => 'machines',
                     'tab' => 'machines',
                     'plugin' => 'production'

                ));
        }
    }
    
}
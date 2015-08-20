<?php
App::uses('AppController', 'Controller');
App::uses('SessionComponent', 'Controller/Component');

class SectionsController extends ProductionAppController {

    public function add() {

    	$this->loadModel('Production.Department');

    	$this->loadModel('Production.Section');

    	$departmentList = $this->Department->find('list',array('fields' => array('id','name')));

    	$auth = $this->Session->read('Auth.User');

		if(!empty($this->request->data)){
			
			$this->Section->saveSection($this->request->data,$auth['id']);

			//$save
	 		$this->Session->setFlash('Saving Section information completed','success');

 		   	$this->redirect( array(
                     'controller' => 'settings', 
                     'action' => 'sections',
                     'tab' => 'sections'
                ));
		}

    	$this->set(compact('departmentList'));

    }

    public function edit($id = null) {

        $this->loadModel('Production.Department');

        $this->loadModel('Production.Section');

        $departmentList = $this->Department->find('list',array('fields' => array('id','name')));

        $auth = $this->Session->read('Auth.User');

        if(!empty($this->request->data)){
            
            $this->Section->saveSection($this->request->data,$auth['id']);

            //$save
            $this->Session->setFlash('Saving Section information completed','success');
            $this->redirect( array(
                     'controller' => 'settings', 
                     'action' => 'sections',
                     'tab' => 'sections'
                ));
        }
        
        if (!empty($id)) {

            $this->request->data = $this->Section->findById($id);

        }

        $this->set(compact('departmentList'));

    }

    public function delete($posId){

        if (!empty($posId)) {

            if ($this->Section->delete($posId)) {
                $this->Session->setFlash(
                    __('Section Successfully deleted.', h($posId))
                );
            } else {
                $this->Session->setFlash(
                    __('Section cannot be deleted.', h($posId))
                );
            }

            return $this->redirect( array(
                     'controller' => 'settings', 
                     'action' => 'sections',
                     'tab' => 'sections',
                     'plugin' => 'production'

                ));
        }
    }
    
}
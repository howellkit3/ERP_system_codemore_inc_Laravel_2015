<?php
App::uses('AppController', 'Controller');
App::uses('SessionComponent', 'Controller/Component');

class DepartmentsController extends ProductionAppController {

    public function add() {

    	$auth = $this->Session->read('Auth.User');

		if(!empty($this->request->data)){
			
			$this->Department->saveDepartment($this->request->data,$auth['id']);

			//$save
	 		$this->Session->setFlash('Saving Department information completed','success');

 		   	$this->redirect( array(
                     'controller' => 'settings', 
                     'action' => 'departments',
                     'tab' => 'departments'
                ));
		}

    }

    public function edit($id = null) {

        $auth = $this->Session->read('Auth.User');

        if(!empty($this->request->data)){
            
            $this->Department->saveDepartment($this->request->data,$auth['id']);

            //$save
            $this->Session->setFlash('Saving Machine information completed','success');
            $this->redirect( array(
                     'controller' => 'settings', 
                     'action' => 'departments',
                     'tab' => 'departments'
                ));
        }
        
        if (!empty($id)) {

            $this->request->data = $this->Department->findById($id);

        }

    }

    public function delete($posId){

        if (!empty($posId)) {

            if ($this->Department->delete($posId)) {
                $this->Session->setFlash(
                    __('Department Successfully deleted.', h($posId))
                );
            } else {
                $this->Session->setFlash(
                    __('Department cannot be deleted.', h($posId))
                );
            }

            return $this->redirect( array(
                     'controller' => 'settings', 
                     'action' => 'departments',
                     'tab' => 'departments',
                     'plugin' => 'production'

                ));
        }
    }
    
}
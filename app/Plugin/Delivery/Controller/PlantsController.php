<?php
App::uses('AppController', 'Controller');
App::uses('SessionComponent', 'Controller/Component');

class PlantsController extends DeliveryAppController {

    public function index() {
    	

        $limit = 5;

        $conditions = array();

        $this->paginate = array(
            'conditions' => $conditions,
            'limit' => $limit,
            'order' => 'Plant.name DESC',
        );

      $plants = $this->paginate();
      $noPermissionSales = '';

      $this->set(compact('plants','noPermissionSales'));

    }

    public function add($id = null) {

    	if (!empty($this->request->data)) {

    		if ($this->Plant->save($this->request->data)) {

    			$this->Session->setFlash('Plant Successfully saved','success');

    			$this->redirect(array('controller' => 'plants','action' => 'index'));

    		} else {


    			$this->Session->setFlash('there\'s an error saving plants','error');

    		}

    	}

    }     

      public function edit($id = null) {

        if (!empty($this->request->data)) {

            if ($this->Plant->save($this->request->data)) {

                $this->Session->setFlash('Plant Successfully saved','success');

                $this->redirect(array('controller' => 'plants','action' => 'index'));

            } else {


                $this->Session->setFlash('there\'s an error saving plants','error');

            }

        }

        if (!empty($id)) {

            $this->request->data = $this->Plant->read(null,$id);
        }

    }


    public function delete($id = null) {

        if ($this->Plant->delete($id)) {

            $this->Session->setFlash('Plant Successfully deleted','success');
        } else {

            $this->Session->setFlash('there\'s an error deleting data ','error');

        }
        $this->redirect(array('controller' => 'plants','action' => 'index'));
    }     


}
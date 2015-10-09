<?php
App::uses('AppController', 'Controller');

class MachinesController extends AppController
{
    
  //public $components = array('Session', 'Auth');


	public function find_machine() {
       
         //$userData = $this->Session->read('Auth');

        if ($this->request->is('ajax')) {

                if (!empty($this->request->data)) {

                    $id = $this->request->data['machineId'];

                    $machines = $this->Machine->findById( $id );

                    echo json_encode($machines);
                    exit();
                }
        }

         $this->set(compact('userData'));
		
	}
    

}
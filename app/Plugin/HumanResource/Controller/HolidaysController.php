<?php
App::uses('AppController', 'Controller');
App::uses('SessionComponent', 'Controller/Component');


App::uses('ImageUploader', 'Vendor');

class HolidaysController  extends HumanResourceAppController {


	public function add() {

		$auth = $this->Session->read('Auth.User');

		if ($this->request->is('post')) {
			

			$this->request->data['Holiday']['created_by'] =
			$this->request->data['Holiday']['modified_by'] = $auth['id'];
			
			$this->request->data = $this->Holiday->formatData($this->request->data);
			
			if ($this->Holiday->save($this->request->data)) {
				
				$this->Session->setFlash('Saving Holiday information successfully','success');
		 		   $this->redirect(array(
                             'controller' => 'schedules', 
                             'action' => 'holiday'
                        ));
			} else  {

				$this->Session->setFlash('There\'s an error saving Holiday information','error');

			}
		}

	}

	public function edit($id = null) {

		$auth = $this->Session->read('Auth.User');

		if ($this->request->is('put')) {
			
			$this->request->data['Holiday']['created_by'] =
			$this->request->data['Holiday']['modified_by'] = $auth['id'];

			$this->request->data = $this->Holiday->formatData($this->request->data);
			

			if ($this->Holiday->save($this->request->data)) {
				
				$this->Session->setFlash('Saving Holiday information successfully','success');
		 		
		 		$this->redirect( array(
                             'controller' => 'schedules', 
                             'action' => 'holiday'
                        ));
			} else  {

				$this->Session->setFlash('There\'s an error saving Holiday information','error');

			}
		}

		$this->request->data = $this->Holiday->findById($id);

	}

	public function view($id = null ) {

		if (!empty($id)) {

			$holiday  = $this->Holiday->findById($id);

		}

		$this->set(compact('holiday'));

	}

}
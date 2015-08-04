<?php
App::uses('AppController', 'Controller');
App::uses('SessionComponent', 'Controller/Component');


class BreakTimesController  extends HumanResourceAppController {


	var $helpers = array('HumanResource.CustomText','HumanResource.Country');

	public function add() {


		if ($this->request->is('post')) {

			$auth = $this->Session->read('Auth.User');

			$this->request->data['Breaktime']['created_by'] =
			$this->request->data['Breaktime']['modified_by'] = $auth['id'];

			$this->loadModel('HumanResource.Breaktime');
			
			if ($this->Breaktime->save($this->request->data['Breaktime'])) {
				
				$this->Session->setFlash('Saving Breaktime information successfully','success');
		 		   $this->redirect( array(
                             'controller' => 'schedules', 
                             'action' => 'breaktime',
                             'tab' => 'breaktime',
                             'plugin' => 'human_resource'

                        ));
			} else  {

				$this->Session->setFlash('There\'s an error saving Breaktime information','error');


			}
		}

	}

	public function edit($id = null) {

		$this->loadModel('HumanResource.Breaktime');

		if ($this->request->is('put')) {

			$auth = $this->Session->read('Auth.User');

			$this->request->data['Breaktime']['created_by'] =
			$this->request->data['Breaktime']['modified_by'] = $auth['id'];

			if ($this->Breaktime->save($this->request->data['Breaktime'])) {
				
				$this->Session->setFlash('Saving Breaktime information successfully','success');
		 		   $this->redirect( array(
                             'controller' => 'schedules', 
                             'action' => 'breaktime',
                             'tab' => 'breaktime',
                             'plugin' => 'human_resource'

                        ));
			} else  {

				$this->Session->setFlash('There\'s an error saving Breaktime information','error');


			}
		}

		if (!empty($id)) {

			$this->request->data  = $this->Breaktime->findById($id);
		}

	}


	public function delete($id = null) {


		if (!empty($id)) {

			if ($this->BreakTime->delete($id)) {
                $this->Session->setFlash(
                    __('Successfully deleted.', h($id))
                );
            } else {
                $this->Session->setFlash(
                    __('Breaktime cannot be deleted.', h($id))
                );
            }

            return  $this->redirect( array(
                             'controller' => 'schedules', 
                             'action' => 'breaktime',
                             'tab' => 'breaktime',
                             'plugin' => 'human_resource'

                        ));
		}
           
           

	}


	public function find($name = null) {

			$this->layout = false;

			if (!empty($name)) {

			$conditions = array('OR' => 
					array('Breaktime.name LIKE' => '%'.$name.'%')
					);

			$limit = 10;

			$this->paginate = array(
	            'conditions' => $conditions,
	            'limit' => $limit,
	            //'fields' => array('id', 'status','created'),
	            'order' => 'Breaktime.name DESC',
	        );

	        $tools = $this->paginate();

	        $this->set(compact('tools'));

		}
	}
	


}
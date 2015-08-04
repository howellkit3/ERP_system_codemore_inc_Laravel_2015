<?php
App::uses('AppController', 'Controller');
App::uses('SessionComponent', 'Controller/Component');


class ToolsController  extends HumanResourceAppController {

	var $helpers = array('HumanResource.CustomText','HumanResource.Country');

	public function find($name = null) {

			$this->layout = false;

			if (!empty($name)) {

			$conditions = array('OR' => 
					array('Tool.name LIKE' => '%'.$name.'%')
					);

			$limit = 10;

			$this->paginate = array(
	            'conditions' => $conditions,
	            'limit' => $limit,
	            //'fields' => array('id', 'status','created'),
	            'order' => 'Tool.name DESC',
	        );

	        $tools = $this->paginate();

	        $this->set(compact('tools'));

		}

	}

	public function add() {

		$this->loadModel('HumanResource.Tool');

		$auth = $this->Session->read('Auth.User');

		if(!empty($this->request->data)){
			
			$this->Tool->saveTool($this->request->data,$auth['id']);

			//$save
	 		$this->Session->setFlash('Saving Tool information completed','success');
 		   	$this->redirect( array(
                     'controller' => 'settings', 
                     'action' => 'tool',
                     'tab' => 'tool'
                ));
		}

	}

	public function edit($id = null) {

		$this->loadModel('HumanResource.Tool');

		$auth = $this->Session->read('Auth.User');
		
		if(!empty($this->request->data)){
			
			$this->Tool->saveTool($this->request->data,$auth['id']);

			//$save
	 		$this->Session->setFlash('Saving Tool information completed','success');
 		   	$this->redirect( array(
                     'controller' => 'settings', 
                     'action' => 'tool',
                     'tab' => 'tool'
                ));
		}
		
		if (!empty($id)) {

			$this->request->data = $this->Tool->findById($id);

		}

	}

	public function view($id = null ) {

		$this->loadModel('HumanResource.Tool');

		$auth = $this->Session->read('Auth.User');
		
		
		if (!empty($id)) {

			$toolData = $this->Tool->findById($id);

		}

		$this->set(compact('toolData'));

	}

	public function delete($id){

		$this->loadModel('HumanResource.Tool');

		if (!empty($id)) {

			if ($this->Position->delete($id)) {
                $this->Session->setFlash(
                    __('Tool Successfully deleted.', h($id))
                );
            } else {
                $this->Session->setFlash(
                    __('Tool cannot be deleted.', h($id))
                );
            }

            return $this->redirect( array(
                     'controller' => 'settings', 
                     'action' => 'tool',
                     'tab' => 'tool',
                     'plugin' => 'human_resource'

                ));
		}
	}
	


}
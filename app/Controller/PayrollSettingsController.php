<?php
App::uses('AppController', 'Controller');

class PayrollSettingsController extends AppController
{

	public function settings() {
		
		$this->loadModel('Payroll.Loan');
		
		$limit = 10;

        $conditions = array();

        $this->paginate = array(
            'conditions' => $conditions,
            'order' => 'Loan.name ASC',
        );
		
		$schedules = array(
			'0' => 'AnyTime',
			'1' => 'Once',
			'2' => 'Every Month',
	        '3' => 'Twice a Month', 
	        '4' => 'Yearly'
	      );

		$loans = $this->paginate('Loan');

		$this->set(compact('loans','schedules'));
	}

	public function loan_add() {

		$this->loadModel('Payroll.Loan');

		if ($this->request->is('post')) {
		
			 if ($this->Loan->save($this->request->data)) {

                     $this->Session->setFlash(__('Saving data completed.'),'success');

                        $this->redirect(
                            array('controller' => 'payroll_settings', 'action' => 'settings')
                        );

                } else {

                        $this->Session->setFlash(__('There\'s an error saving data, Please try again'),'error');
                }
		}

	}

	public function loan_edit($id = null) {

		$this->loadModel('Payroll.Loan');

		if ($this->request->is('put')) {

			 if ($this->Loan->save($this->request->data)) {

                     $this->Session->setFlash(__('Saving data completed.'),'success');

                        $this->redirect(
                            array('controller' => 'payroll_settings', 'action' => 'settings')
                        );

                } else {

                        $this->Session->setFlash(__('There\'s an error saving data, Please try again'),'error');
                }

		}


		if (!empty($id)) {	

			$conditions = array('Loan.id' => $id);
			$this->request->data = $this->Loan->find('first',array('conditions' => $conditions));
		}

	}


	public function loan_delete($id = null){

		if (!empty($id)) {

            $this->loadModel('Payroll.Loan');
           
            if ($this->Loan->delete($id)) {

                $this->Session->setFlash(
                    __('Successfully deleted.', h($id)), 'success'
                );

            } else {
                $this->Session->setFlash(
                    __('There\'s an error deleting the data', h($id)),'error'
                );
            }

            return $this->redirect(array('action' => 'settings'));
        }

	}

	public function ot_rates() {

		$this->loadModel('Payroll.DayType');
		$this->loadModel('Payroll.OvertimeRate');

		$limit = 10;

        $conditions = array();

        $this->paginate = array(
            'conditions' => $conditions,
            'order' => 'OvertimeRate.id Desc',
        );
		
		$this->OvertimeRate->bind(array('DayType'));

		$overtimes = $this->paginate('OvertimeRate');

		$this->set(compact('days','overtimes'));
	}


	public function ot_rates_add() {

		$this->loadModel('Payroll.DayType');
		$this->loadModel('Payroll.OvertimeRate');

		if ($this->request->is('post')) {

			if ($this->OvertimeRate->save($this->request->data)) {

                     $this->Session->setFlash(__('Saving data completed.'),'success');

                        $this->redirect(
                            array('controller' => 'payroll_settings', 'action' => 'ot_rates')
                        );

                } else {

                        $this->Session->setFlash(__('There\'s an error saving data, Please try again'),'error');
                }

		}
		
		$days = $this->DayType->find('list',array('order' => 'DayType.id ASC'));

		$this->set(compact('days'));	
	}

	public function ot_rates_edit($id = null) {

		$this->loadModel('Payroll.DayType');

		$this->loadModel('Payroll.OvertimeRate');

		if ($this->request->is('put')) {

			if ($this->OvertimeRate->save($this->request->data)) {

                     $this->Session->setFlash(__('Saving data completed.'),'success');

                        $this->redirect(
                            array('controller' => 'payroll_settings', 'action' => 'ot_rates')
                        );

                } else {

                        $this->Session->setFlash(__('There\'s an error saving data, Please try again'),'error');
                }

		}

		if (!empty($id)) {	

			$conditions = array('OvertimeRate.id' => $id);
			$this->request->data = $this->OvertimeRate->find('first',array('conditions' => $conditions));
		}
		
		$days = $this->DayType->find('list',array('order' => 'DayType.id ASC'));

		$this->set(compact('days'));	
	}


	public function contributions(){
		
		$this->loadModel('Payroll.Contribution');

		$limit = 10;

        $conditions = array();

        $this->paginate = array(
            'conditions' => $conditions,
            'order' => 'Contribution.name ASC',
        );
		
		$schedules = array(
				'1' => 'Semi Monthly(Equal)',
				'2' => 'Semi Monthly(First Payroll)',
				'3' => 'Semi Monthly(Second Payroll)',
				'4' => 'Anytime'
		);

		$contributions = $this->paginate('Contribution');

		$this->set(compact('contributions','schedules'));
	}

	public function contribution_add($id = null) {

		$this->loadModel('Payroll.Contribution');

		if ($this->request->is(array('put','post'))) {
		
			 if ($this->Contribution->save($this->request->data)) {

                     $this->Session->setFlash(__('Saving data completed.'),'success');

                        $this->redirect(
                            array('controller' => 'payroll_settings', 'action' => 'contributions')
                        );

                } else {

                        $this->Session->setFlash(__('There\'s an error saving data, Please try again'),'error');
                }
		}

		if (!empty($id)) {

			$this->request->data = $this->Contribution->read(null,$id);
		}


	}

	public function contribution_delete($id) {

		if (!empty($id)) {

            $this->loadModel('Payroll.Contribution');
           
            if ($this->Contribution->delete($id)) {

                $this->Session->setFlash(
                    __('Successfully deleted.', h($id)), 'success'
                );

            } else {
                $this->Session->setFlash(
                    __('There\'s an error deleting the data', h($id)),'error'
                );
            }

            return $this->redirect(array('action' => 'contributions'));
        }

	}



	public function wages() {

		$this->loadModel('Payroll.Wage');

		$limit = 10;

        $conditions = array();

        $this->paginate = array(
            'conditions' => $conditions,
            'order' => 'Wage.name ASC',
        );
		
		$schedules = array(
			'0' => 'AnyTime',
			'1' => 'Once',
			'2' => 'Every Month',
	        '3' => 'Twice a Month', 
	        '4' => 'Yearly'
	      );

		$wages = $this->paginate('Wage');

		$this->set(compact('wages'));
	}

	public function wage_add() {

		$this->loadModel('Payroll.Wage');

		if ($this->request->is('post')) {

			$auth = $this->Session->read('Auth.User');

			$this->request->data['Payroll']['created_by'] = $auth['id'];
			$this->request->data['Payroll']['modified_by'] = $auth['id']; 


			if ($this->Wage->save($this->request->data)) {

                     $this->Session->setFlash(__('Saving data completed.'),'success');

                        $this->redirect(
                            array('controller' => 'payroll_settings', 'action' => 'wages')
                        );

                } else {

                        $this->Session->setFlash(__('There\'s an error saving data, Please try again'),'error');
                }

		}
	

	}

	public function wage_edit($id = null ) {

		$this->loadModel('Payroll.Wage');

		if ($this->request->is('post')) {

			$auth = $this->Session->read('Auth.User');

			$this->request->data['Payroll']['created_by'] = $auth['id'];
			$this->request->data['Payroll']['modified_by'] = $auth['id']; 


			if ($this->Wage->save($this->request->data)) {

                     $this->Session->setFlash(__('Saving data completed.'),'success');

                        $this->redirect(
                            array('controller' => 'payroll_settings', 'action' => 'wages')
                        );

                } else {

                        $this->Session->setFlash(__('There\'s an error saving data, Please try again'),'error');
                }

		}

		if (!empty($id)) {

			$this->request->data = $this->Wage->findById($id);
		}
	}


	public function findWage($name = '') {

		if (!empty($name)) {

			$this->loadModel('Payroll.Wage');

			$wage = $this->Wage->find('first', array(
				'conditions' => array('Wage.name like' => '%'.$name.'%')
			));

			echo json_encode($wage);
		}

		exit();

	}

} 
?>
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
} 
?>
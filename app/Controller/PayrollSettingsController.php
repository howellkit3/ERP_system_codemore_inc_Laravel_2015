<?php
App::uses('AppController', 'Controller');

class PayrollSettingsController extends AppController
{

	public function settings() {
		
		$this->loadModel('Payroll.Loan');

		if ($this->request->is('post')) {
			
		}

	}


} ?>
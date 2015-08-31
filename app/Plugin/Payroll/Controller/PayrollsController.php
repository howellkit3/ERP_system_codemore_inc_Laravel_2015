<?php
class PayrollsController extends PayrollAppController {


	public function settings() {

		$date = date('Y-m-d');

		$this->set(compact('date'));

	}

	public function checkExisting(){


		$query = $this->request->query;

		if (!empty($query['month']) && !empty($query['date'])) {

			$date = explode(':', $query['date'] );

			$from = date('Y-m-d',strtotime($date[0].'-'.$query['month'])); 

			$to = date('Y-m-d',strtotime($date[1].'-'.$query['month'])); 

			$conditions = array('Payroll.from' => $from ,'Payroll.to' => $to );

			$payroll = $this->Payroll->find('first',array('conditions' => $conditions ));
			
			echo json_encode($payroll);

			exit();
		}
	}

	public function getPayrollBy() {

		$query = $this->request->query;

		if (!empty($query['month']) ) {

			$limit = 10;

			$from = date('Y-m-d',strtotime('01-'.$query['month'])); 

			$to = date('Y-m-t',strtotime('31-'.$query['month'])); 

			$conditions = array('Payroll.from >=' => $from ,'Payroll.to <=' => $to );

			if (!empty($query['status']) && $query['status'] != 'undefined' ) {

				$conditions = array_merge($conditions,array('Payroll.status' => $query['status']));
			}

			$this->paginate = array(
	            'conditions' => $conditions,
	            'limit' => $limit,
	            //'fields' => array('id', 'status','created'),
	            'order' => 'Payroll.date DESC',
	        );

	        $payrolls = $this->paginate('Payroll');

	        $this->set(compact('payrolls'));

			$this->render('Payrolls/ajax/payroll');

		}

	}


	  public function sss_ranges(){

            $this->loadModel('SssRange');
            $conditions = array();
            $ranges = $this->SssRange->find('all',array(
                'conditions' => $conditions,
                'order' => array('SssRange.range_from ASC')
                 ));
            $this->set(compact('ranges'));

            $this->render('accounting/sss_ranges');
        }


        public function sss_ranges_add($id = null){

            $this->loadModel('SssRange');
           
            if ($this->request->is(array('post','put'))) {

                $auth = $this->Session->read('Auth');

                $data = $this->SssRange->formatData($this->request->data,$auth);


                if ($this->SssRange->save($data)) {

                     $this->Session->setFlash(__('Saving data completed.'),'success');

                        $this->redirect(
                            array('controller' => 'settings', 'action' => 'sss_ranges')
                        );

                } else {

                        $this->Session->setFlash(__('There\'s an error saving data, Please try again'),'error');
                }

            }

            if (!empty($id)) {

                $this->request->data = $this->SssRange->read(null,$id);
            }

             $this->render('accounting/sss_ranges_add');
        }

        public function sss_ranges_delete($id){


            $this->loadModel('SssRange');
           
            if ($this->SssRange->delete($id)) {
                   $this->Session->setFlash(
                    __('Successfully deleted.', h($id)), 'success'
                );
            } else {
                $this->Session->setFlash(
                    __('There\'s an erro deleting the data', h($id))
                );
            }

            return $this->redirect(array('action' => 'sss_ranges'));
        }

        public function philhealth_ranges(){

            $this->loadModel('PhilHealthRange');

            $conditions = array();

            $ranges = $this->PhilHealthRange->find('all',array(
                'conditions' => $conditions,
                'order' => array('PhilHealthRange.range_from ASC')
                 ));

            //pr($ranges); exit();
            $this->set(compact('ranges'));

            $this->render('accounting/philhealth_ranges');
        }


        public function philhealth_ranges_add($id = null){

            $this->loadModel('PhilHealthRange');
           
            if ($this->request->is(array('post','put'))) {

                $auth = $this->Session->read('Auth');

                $data = $this->PhilHealthRange->formatData($this->request->data,$auth);

                if ($this->PhilHealthRange->save($data)) {

                     $this->Session->setFlash(__('Saving data completed.'),'success');

                        $this->redirect(
                            array('controller' => 'settings', 'action' => 'philhealth_ranges')
                        );

                } else {

                        $this->Session->setFlash(__('There\'s an error saving data, Please try again'),'error');
                }

            }

            if (!empty($id)) {

                $this->request->data = $this->PhilHealthRange->read(null,$id);
            }

             $this->render('accounting/philhealth_ranges_add');
        }

         public function philhealth_ranges_delete($id){


            $this->loadModel('PhilHealthRange');
           
            if ($this->PhilHealthRange->delete($id)) {

                $this->Session->setFlash(
                    __('Successfully deleted.', h($id)), 'success'
                );

            } else {
                $this->Session->setFlash(
                    __('There\'s an error deleting the data', h($id)),'error'
                );
            }

            return $this->redirect(array('action' => 'philhealth_ranges'));
        }



}
<?php
App::uses('AppController', 'Controller');
App::uses('SessionComponent', 'Controller/Component');

class TicketProcessSchedulesController extends ProductionAppController {

    public function add() {

        $auth = $this->Session->read('Auth.User');

        $this->loadModel('Ticket.JobTicket');

        $this->loadModel('Production.MachineLog');

    	if (!empty($this->request->data)) {
            // /pr($this->request->data);exit();
            $data = $this->request->data;

            $departmentProcess = $data['TicketProcessSchedule'][0]['department_process_id'];
            
            //update status of jobticket
            $this->JobTicket->id = $data['Ticket']['job_ticket_id'];
            $this->JobTicket->saveField('production_status',$departmentProcess);

            $TtcketProcessScheduleID = $this->TicketProcessSchedule->saveTicketProcessSchedule($data,$auth['id']);

            $this->MachineLog->saveMachineLog($TtcketProcessScheduleID);

            if ($this->request->is('ajax')) {
                
                $ajaxData['JobTicket']['status'] = 1;
                $ajaxData['JobTicket']['id'] = $data['Ticket']['job_ticket_id'];

                echo json_encode($ajaxData);
                exit();
            }
            
        }

    }

    public function ticket_data_view($jobTicketID = null ,$schedule = null){

        $this->loadModel('Ticket.JobTicket');

        $this->JobTicket->bindTicket();

        $ticketData = $this->JobTicket->find('first', array(
                                        'conditions' => array('JobTicket.id' => $jobTicketID)
                                        ));

        $this->loadModel('Sales.ProductSpecificationDetail');

        $this->loadModel('Sales.ProductSpecification');

        $this->loadModel('Unit');

        $this->loadModel('SubProcess');

        $this->loadModel('Sales.Product');

        $this->loadModel('Sales.Company');

        $this->loadModel('Sales.ClientOrder');

        $this->ClientOrder->bind(array('ClientOrderDeliverySchedule'));

        $delData = $this->ClientOrder->find('first',array('id' => $ticketData['ClientOrder']['id']));

        $companyData = $this->Company->find('list',
                                            array('fields' => 
                                                array('Company.id',
                                                    'Company.company_name'
                                                 )
                                                ));

        $productData = $this->Product->find('first',array('conditions' => array('Product.uuid' => $ticketData['Product']['uuid'] )));

        $subProcess = $this->SubProcess->find('list',
                                            array('fields' => 
                                                array('SubProcess.id',
                                                    'SubProcess.name'
                                                 )
                                                ));

        //set to cache in first load
        $unitData = Cache::read('unitData');
        
        if (!$unitData) {
            
            $unitData = $this->Unit->find('list', array('fields' => array('id', 'unit'),
                                                            'order' => array('Unit.unit' => 'ASC')
                                                            ));

            Cache::write('unitData', $unitData);
        }

        $specs = $this->ProductSpecification->find('first',array('conditions' => array('ProductSpecification.product_id' => $productData['Product']['id'])));
        
        //find if product has specs
        $formatDataSpecs = $this->ProductSpecificationDetail->findData($ticketData['Product']['uuid']);

        $this->loadModel('Production.ProcessDepartment');
        $processDepartmentData = $this->ProcessDepartment->find('list',array('fields' => array('id','name')));

        $this->set(compact('formatDataSpecs','specs','unitData','subProcess','productData','companyData','delData','ticketData','processDepartmentData'));

        if (!empty($schedule)) {
           $this->render('schedule_process');
        }
       
    }
   
    
}
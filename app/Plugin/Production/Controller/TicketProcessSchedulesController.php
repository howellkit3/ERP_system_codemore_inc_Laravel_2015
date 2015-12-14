<?php
App::uses('AppController', 'Controller');
App::uses('SessionComponent', 'Controller/Component');

class TicketProcessSchedulesController extends ProductionAppController {

    public function add() {

       // pr($this->request->data); exit;

        $auth = $this->Session->read('Auth.User');

        //pr($auth); exit;

        $this->loadModel('Ticket.JobTicket');

        $this->loadModel('Production.MachineLog');

        $this->loadModel('Production.ProcessDepartment');

    	if (!empty($this->request->data)) {

            $data = $this->request->data;

           // fin list department procee

            // $departmentData = $this->ProcessDepartment->find('list', array('fields' => array('id', 'name')));

            // $departmentProcess = $data['TicketProcessSchedule'][0]['department_process_id'];

            // $departmentName = $departmentData[$data['TicketProcessSchedule'][0]['department_process_id']];
            // //update status of jobticket
            // $this->JobTicket->id = $data['Ticket']['job_ticket_id'];
            
            // $this->JobTicket->saveField('status_production_id',$departmentProcess);

            $TicketProcessScheduleID = $this->TicketProcessSchedule->saveTicketProcessSchedule($data,$auth['id']);

            $this->MachineLog->saveMachineLog($TicketProcessScheduleID, $auth['id']);

            if ($this->request->is('ajax')) {

                $ajaxData['JobTicket']['status'] = 1;
                $ajaxData['JobTicket']['id'] = $data['Ticket']['job_ticket_id'];
                $ajaxData['JobTicket']['process_name'] = $departmentName;

                pr($ajaxData);
                echo json_encode($ajaxData);
                exit();
            }

            $this->Session->setFlash(__('Process/es has been logged to machine.'));

            $this->redirect( array(
                     'controller' => 'jobs', 
                     'action' => 'plans'
    
             ));
            
        }

    }

    public function ticket_data_view($jobTicketID = null ,$schedule = null){

        // $this->loadModel('Ticket.JobTicket');

        // $this->JobTicket->bindTicket();

        // $ticketData = $this->JobTicket->find('first', array(
        //                                 'conditions' => array('JobTicket.id' => $jobTicketID)
        //                                 ));

        // pr($ticketData);

        // $this->loadModel('Sales.ProductSpecificationDetail');

        // $this->loadModel('Sales.ProductSpecification');

        // $this->loadModel('Unit');

        // $this->loadModel('SubProcess');

        // $this->loadModel('Sales.Product');

        // $this->loadModel('Sales.Company');

        // $this->loadModel('Sales.ClientOrder');

        // $this->ClientOrder->bind(array('ClientOrderDeliverySchedule'));

        // $delData = $this->ClientOrder->find('first',array('id' => $ticketData['ClientOrder']['id']));

        // $companyData = $this->Company->find('list',
        //                                     array('fields' => 
        //                                         array('Company.id',
        //                                             'Company.company_name'
        //                                          )
        //                                         ));

        // $productData = $this->Product->find('first',array('conditions' => array('Product.uuid' => $ticketData['Product']['uuid'] )));

        // $subProcess = $this->SubProcess->find('list',
        //                                     array('fields' => 
        //                                         array('SubProcess.id',
        //                                             'SubProcess.name'
        //                                          )
        //                                         ));


        // $specs = $this->ProductSpecification->find('first',array('conditions' => array('ProductSpecification.product_id' => $productData['Product']['id'])));
        
        // //find if product has specs
        // $formatDataSpecs = $this->ProductSpecificationDetail->findData($ticketData['Product']['uuid']);

        // $this->loadModel('Production.ProcessDepartment');
        // $
            
            $this->loadModel('Unit');

            $this->loadModel('Ticket.JobTicket');

            //machines
            $this->loadModel('Machine');

            //process
            $this->loadModel('SubProcess');

            $this->loadModel('Sales.Product');

            $this->loadModel('Sales.Company');

            $this->loadModel('Sales.ClientOrder');

            $this->loadModel('Sales.ProductSpecificationDetail');

            $this->loadModel('Sales.ProductSpecification');

            $this->loadModel('Production.ProcessDepartment');

            $subProcessData = $this->SubProcess->find('list',
                                            array('fields' => 
                                                array('SubProcess.id',
                                                    'SubProcess.name'
                                                 )
                                                ));

            $machines = $this->Machine->find('list', array('fields' => 
                                                array('id',
                                                    'name'
                                                 )
                                                ));
            
            //$subProcess =  $subProcess['SubProcess'];
            $conditions = array('id' => $jobTicketID);   

            $processDepartmentData = $this->ProcessDepartment->find('list',array('fields' => array('id','name'))); 


            //set to cache in first load
            $unitData = Cache::read('unitData');
            
            if (!$unitData) {
                
                $unitData = $this->Unit->find('list', array('fields' => array('id', 'unit'),
                                                                'order' => array('Unit.unit' => 'ASC')
                                                                ));

                Cache::write('unitData', $unitData);
            }

            $this->JobTicket->bind(array('ClientOrder','ClientOrderDeliverySchedule','Product'));

            $jobTickets = $this->JobTicket->find('first',array(
                'conditions' => $conditions
            ));

            $specs = $this->ProductSpecification->find('first',array('conditions' => array('ProductSpecification.product_id' => $jobTickets['JobTicket']['product_id'])));
        
            //find if product has specs
            $formatDataSpecs = $this->ProductSpecificationDetail->findData($jobTickets['Product']['uuid']);

            $companyData = $this->Company->find('list',
                                            array('fields' => 
                                                array('Company.id',
                                                    'Company.company_name'
                                                 )
                                                ));

            if (!empty($_GET['test'])) {

                pr($jobTickets);

                pr($formatDataSpecs);
                exit();
            }


            $this->set(compact('formatDataSpecs','specs','unitData','subProcess','productData','companyData','delData','ticketData','processDepartmentData','jobTickets','subProcessData'));

            if (!empty($schedule)) {
               $this->render('schedule_process');
            }
       
    }

    public function set_process() {

   
        $auth = $this->Session->read('Auth.User');

        //pr($auth); exit;

        $this->loadModel('Ticket.JobTicket');

        $this->loadModel('Production.MachineLog');

        $this->loadModel('Production.ProcessDepartment');


        if (!empty($this->request->data)) {

            $data = $this->request->data;


            if (!empty($data['TicketProcessSchedule']['production_date'])) {

                $dates = explode('-', $data['TicketProcessSchedule']['production_date']);
                
                $data['TicketProcessSchedule']['production_date_from'] = date('Y-m-d',strtotime($dates[0]));

                $data['TicketProcessSchedule']['production_date_to'] = date('Y-m-d',strtotime($dates[1]));

            }


            $TicketProcessScheduleID = $this->TicketProcessSchedule->saveProcess($data,$auth['id']);
            $this->MachineLog->saveMachineLog($TicketProcessScheduleID, $auth['id']);

            if ($this->request->is('ajax')) {

                echo "1";
                exit();


            } else {

            $this->Session->setFlash(__('Process/es has been logged to machine.'));

            $this->redirect( array(
                     'controller' => 'jobs', 
                     'action' => 'view',
                     $data['TicketProcessSchedule']['job_ticket_id']
    
             ));

            }
            
            
        }
    }
   
    
}
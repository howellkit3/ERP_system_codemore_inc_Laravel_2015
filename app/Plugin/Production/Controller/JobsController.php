<?php
App::uses('AppController', 'Controller');
App::uses('SessionComponent', 'Controller/Component');

class JobsController extends ProductionAppController {


  //  var $helpers = array('Production.Process');
    //,'HumanResource.Country'

    public function index() {

        $this->loadModel('Ticket.JobTicket');
    }

    public function plans() {

        $limit = 10;

        $this->loadModel('Ticket.JobTicket');

        $this->loadModel('Sales.ClientOrderDeliverySchedule');

        $this->loadModel('Sales.Company');

        $this->loadModel('Production.Machine');

        $this->loadModel('Production.ProcessDepartment');

        $this->loadModel('Production.RecievedTicket');

        $departmentProcess = $this->ProcessDepartment->find('list', array('fields' => array('id', 'name')));

        // $this->loadModel('Sales.ProductSpecificationProcess');

        // $this->loadModel('Sales.ProductSpecificationProcessHolder');

        $companyData = $this->Company->find('list',array('fields' => array('id','company_name')));

        $machineData = $this->Machine->find('list',array('fields' => array('id','name')));

      //  $this->JobTicket->bindTicketJob(); 

        $this->JobTicket->bind(array('ClientOrder', 'Product', 'ClientOrderDeliverySchedule','TicketProcessSchedule'));


        $query = $this->request->query;

        if (!empty( $query['data']['date'])) {

            $dateSplit = explode('-',$query['data']['date']);

            $date1 =  date('Y-m-d',strtotime($dateSplit[0]));

            $date2 =  date('Y-m-d',strtotime($dateSplit[1]));

            $conditions = array('date(JobTicket.created) BETWEEN ? AND ?' => array($date1,$date2));
            
            $dateSelected =  $query['data']['date'];    
            
        } else {


            $date = date('Y-m-01');

            $date2 = date('Y-m-d');

            $conditions =array('date(JobTicket.created) BETWEEN ? AND ?' => array($date,$date2));

            $dateSelected = date('Y/m/d',strtotime($date)).' - '.date('Y/m/d',strtotime($date2));

        }

        $clientOrderUUID = $this->ClientOrderDeliverySchedule->find('list',array('fields' => array('client_order_id','uuid')));

        $clientOrderQuantity = $this->ClientOrderDeliverySchedule->find('list',array('fields' => array('client_order_id','quantity')));

        $params =  array(
                'conditions' => $conditions,
                'limit' => $limit,
                //'group' => array('Attendance.date'),
                'order' => 'JobTicket.id DESC',
        );

        $this->paginate = $params;
        
        $jobData = $this->paginate('JobTicket');

        $jobData = $this->RecievedTicket->checkStatus( $jobData);

        //  $jobData = $this->JobTicket->find('all',array('order' => 'JobTicket.id DESC','conditions' => $conditions ));

        //pr($jobData ); exit;
        // foreach ($jobData as $key => $jobList) {

        //     //find if product has specs

        //     $formatData = $this->ProductSpecificationProcess->find('first',array('conditions' => array('product_id' => $jobList['Product']['id'])));

        //     $processData = $this->ProductSpecificationProcessHolder->find('all',array('conditions' => array('product_specification_process_id' => $formatData['ProductSpecificationProcess']['id']),
        //                                             'fields' => array('id','product_specification_process_id','process_id','sub_process_id','order')));

        //     $jobData[$key]['Process'] = $processData;

        // }
        //pr($jobData);exit();
        $this->set(compact('jobData','companyData','machineData','processDepartmentData', 'clientOrderUUID', 'clientOrderQuantity','dateSelected','departmentProcess'));
        
    }

    public function view($jobId = null) {

        if (!empty($jobId)) {

            $this->loadModel('HumanResource.Employee');

            $this->loadModel('HumanResource.Position');

            $this->loadModel('Ticket.JobTicket');

            $this->loadModel('Sales.ClientOrderDeliverySchedule');

            $this->loadModel('Sales.Company');

            $this->loadModel('Production.Machine');

            $this->loadModel('Production.ProcessDepartment');

            $this->loadModel('Production.RecievedTicket');

            $this->loadModel('Production.TicketProcessSchedule');

            $this->loadModel('Sales.ProductSpecificationProcessHolder');

            $this->loadModel('Sales.Product');

            $this->loadModel('Sales.ProductSpecificationDetail');

            $this->loadModel('Sales.ProductSpecification');

            $this->loadModel('Sales.ClientOrder');

            $this->loadModel('Sales.ClientOrderDeliverySchedule');

            $this->loadModel('Unit');

            $this->loadModel('Machine');

            $this->loadModel('SubProcess');

            $this->JobTicket->bind(array('ClientOrder'));

            $jobData = $this->JobTicket->findById($jobId);

            $schedules = $this->ClientOrderDeliverySchedule->find('all',array(
                    'conditions' => array(
                            'ClientOrderDeliverySchedule.client_order_id' =>  $jobData['JobTicket']['client_order_id']  
                        )
            ));

            $RecievedTicket = $this->RecievedTicket->find('first',array('conditions' => array(
                    'job_ticket_id' => $jobId
            )));

            $subProcessData = $this->SubProcess->find('list',
                                            array('fields' => 
                                                array('SubProcess.id',
                                                    'SubProcess.name'
                                                 )
                                                ));


            $departmentProcess = $this->ProcessDepartment->find('list', array('fields' => array('id', 'name')));

            $companyData = $this->Company->find('list',array('fields' => array('id','company_name')));

            $machines = $this->Machine->find('list',array('fields' => array('id','name')));
            
            $conditions = array('Product.id' => $jobData['JobTicket']['product_id']);

            $productData = $this->Product->find('first',array('conditions' => $conditions ,'order' => 'Product.id DESC'));

            $specs = $this->ProductSpecification->find('first',array('conditions' => array('ProductSpecification.product_id' => $productData['Product']['id'])));
            
            //get operators
            $conditions = array();
            $employees =  $this->Employee->getOperator('list',$conditions);   

            //$this->ProductSpecificationProcessHolder->bind(array('TicketProcessSchedule'));

            $formatDataSpecs = $this->ProductSpecificationDetail->findData($productData['Product']['uuid'],null,true);

            // pr( $formatDataSpecs );
            // exit();

            $unitData = Cache::read('unitData');

            if (!$unitData) {
                
                $unitData = $this->Unit->find('list', array('fields' => array('id', 'unit'),
                                                                'order' => array('Unit.unit' => 'ASC')
                                                                ));
                Cache::write('unitData', $unitData);
            }


            //find if product has specs
            //$formatDataSpecs = $this->ProductSpecificationDetail->findData($productUuid);

            // pr($productData);    
            
         //   exit();
            $this->set(compact('employees','jobData','departmentProcess','companyData','subProcessData','machineData','productData','specs','unitData','schedules','RecievedTicket','formatDataSpecs','machines'));
        }
    }

    public function recieved_tickets($id = null) {

        if (!empty($id)) {

            $this->loadModel('Production.RecievedTicket');

            $auth = $this->Session->read('Auth.User');

            $saveData = array();

            $saveData['id'] = '';
            $saveData['job_ticket_id'] = $id;
            $saveData['status'] = 'recieved';
            $saveData['recieved_by'] = $auth['id'];
            $saveData['created_by'] = $auth['id'];
            $saveData['modified_by'] = $auth['id'];

            if ($this->RecievedTicket->save($saveData)) {

              $this->Session->setFlash('Ticket has been recieved','success');

            } else { 

              $this->Session->setFlash('There\'s an error recieving tickets','error');

            }
            
            return $this->redirect(array('controller' => 'jobs', 
                        'action' => 'view',$id));

        }
    }

    public function view_process($id = null) {

        if (!empty($id)) {

            $limit = 10;

            $this->loadModel('Production.ProcessDepartment');

            $this->loadModel('Sales.Company');

            $this->loadModel('Ticket.JobTicket');

            $this->loadModel('Production.Machine');

            $this->loadModel('Production.MachineLog');

            $this->loadModel('Sales.Product');

            $this->loadModel('Production.TicketProcess');

            $companyData = $this->Company->find('list',array('fields' => array('id','company_name')));

            $machineData = $this->Machine->find('list',array('fields' => array('id','name')));

            $productName = $this->Product->find('list',array('fields' => array('id','name')));

            $processDepartment = $this->ProcessDepartment->findById($id);

            //process_department =

            $machineScheduleData = $this->MachineLog->find('all');

            $conditions = array('TicketProcessSchedule.department_process_id' => $id);
            
            $params =  array(
                    'conditions' => $conditions,
                    'limit' => $limit,
                    //'group' => array('Attendance.date'),
                    'order' => 'MachineLog.id DESC',
            );

            $this->paginate = $params;
            
            $this->MachineLog->bindTicket(); 

            $machineScheduleData = $this->paginate('MachineLog');

            //get Jobticket 
            $machineScheduleData = $this->JobTicket->addTicket( $machineScheduleData );
     
            $this->set(compact('machineScheduleData','companyData','machineData','productName','processDepartment'));

            $this->render('Jobs/processes/default');
           
        }
    }

    public function sheeting(){
        
        $limit = 10;

        $this->loadModel('Sales.Company');

        $this->loadModel('Ticket.JobTicket');

        $this->loadModel('Production.Machine');

        $this->loadModel('Production.MachineLog');

        $this->loadModel('Sales.Product');

        $this->loadModel('Production.TicketProcess');

        $companyData = $this->Company->find('list',array('fields' => array('id','company_name')));

        $machineData = $this->Machine->find('list',array('fields' => array('id','name')));

        $productName = $this->Product->find('list',array('fields' => array('id','name')));


        //process_department =

        $machineScheduleData = $this->MachineLog->find('all');

         $conditions = array('TicketProcessSchedule.department_process_id' => 1);
         $params =  array(
                'conditions' => $conditions,
                'limit' => $limit,
                //'group' => array('Attendance.date'),
                'order' => 'MachineLog.id DESC',
        );

        $this->paginate = $params;
        
        $this->MachineLog->bindTicket(); 

        $machineScheduleData = $this->paginate('MachineLog');

        pr( $machineScheduleData );
        exit();

        //get Jobticket 
        $machineScheduleData = $this->JobTicket->addTicket( $machineScheduleData );
 
        $this->set(compact('machineScheduleData','companyData','machineData','productName'));

    }

    public function printing(){

        $this->loadModel('Sales.Company');

        $this->loadModel('Ticket.JobTicket');

        $this->loadModel('Production.Machine');

        $companyData = $this->Company->find('list',array('fields' => array('id','company_name')));

        $machineData = $this->Machine->find('list',array('fields' => array('id','name')));

        //calling data
       // $machineScheduleData = $this->_find_machine_schedule_data(2);
        //pr($machineScheduleData);exit();
        $this->set(compact('machineScheduleData','companyData','machineData'));

    }

    public function coating(){

        $this->loadModel('Sales.Company');

        $this->loadModel('Ticket.JobTicket');

        $this->loadModel('Production.Machine');

        $companyData = $this->Company->find('list',array('fields' => array('id','company_name')));

        $machineData = $this->Machine->find('list',array('fields' => array('id','name')));

        //calling data
        //$machineScheduleData = $this->_find_machine_schedule_data(3);
        //pr($machineScheduleData);exit();
        $this->set(compact('machineScheduleData','companyData','machineData'));

    }

    public function corrugated_lamination(){

        $this->loadModel('Sales.Company');

        $this->loadModel('Ticket.JobTicket');

        $this->loadModel('Production.Machine');

        $companyData = $this->Company->find('list',array('fields' => array('id','company_name')));

        $machineData = $this->Machine->find('list',array('fields' => array('id','name')));

        //calling data
     // $machineScheduleData = $this->_find_machine_schedule_data(4);
        //pr($machineScheduleData);exit();
        $this->set(compact('machineScheduleData','companyData','machineData'));

    }

    public function diecutting(){

        $this->loadModel('Sales.Company');

        $this->loadModel('Ticket.JobTicket');

        $this->loadModel('Production.Machine');

        $companyData = $this->Company->find('list',array('fields' => array('id','company_name')));

        $machineData = $this->Machine->find('list',array('fields' => array('id','name')));

        //calling data
        //$machineScheduleData = $this->_find_machine_schedule_data(5);
        //pr($machineScheduleData);exit();
        $this->set(compact('machineScheduleData','companyData','machineData'));

    }

    public function stripping(){

        $this->loadModel('Sales.Company');

        $this->loadModel('Ticket.JobTicket');

        $this->loadModel('Production.Machine');

        $companyData = $this->Company->find('list',array('fields' => array('id','company_name')));

        $machineData = $this->Machine->find('list',array('fields' => array('id','name')));

        //calling data
       // $machineScheduleData = $this->_find_machine_schedule_data(6);
        //pr($machineScheduleData);exit();
        $this->set(compact('machineScheduleData','companyData','machineData'));

    }

    public function browsing(){

        $this->loadModel('Sales.Company');

        $this->loadModel('Ticket.JobTicket');

        $this->loadModel('Production.Machine');

        $companyData = $this->Company->find('list',array('fields' => array('id','company_name')));

        $machineData = $this->Machine->find('list',array('fields' => array('id','name')));

        //calling data
      //  $machineScheduleData = $this->_find_machine_schedule_data(7);
        //pr($machineScheduleData);exit();
        $this->set(compact('machineScheduleData','companyData','machineData'));

    }

    public function gluing(){

        $this->loadModel('Sales.Company');

        $this->loadModel('Ticket.JobTicket');

        $this->loadModel('Production.Machine');

        $companyData = $this->Company->find('list',array('fields' => array('id','company_name')));

        $machineData = $this->Machine->find('list',array('fields' => array('id','name')));

        //calling data
      //  $machineScheduleData = $this->_find_machine_schedule_data(8);
        //pr($machineScheduleData);exit();
        $this->set(compact('machineScheduleData','companyData','machineData'));

    }

    public function final_inspection(){

        $this->loadModel('Sales.Company');

        $this->loadModel('Ticket.JobTicket');

        $this->loadModel('Production.Machine');

        $companyData = $this->Company->find('list',array('fields' => array('id','company_name')));

        $machineData = $this->Machine->find('list',array('fields' => array('id','name')));

        //calling data
       // $machineScheduleData = $this->_find_machine_schedule_data(9);
        //pr($machineScheduleData);exit();
        $this->set(compact('machineScheduleData','companyData','machineData'));

    }

    public function scrap_items(){

        $this->loadModel('Sales.Company');

        $this->loadModel('Ticket.JobTicket');

        $this->loadModel('Production.Machine');

        $companyData = $this->Company->find('list',array('fields' => array('id','company_name')));

        $machineData = $this->Machine->find('list',array('fields' => array('id','name')));

        //calling data
       // $machineScheduleData = $this->_find_machine_schedule_data(10);
        //pr($machineScheduleData);exit();
        $this->set(compact('machineScheduleData','companyData','machineData'));

    }

    public function packing(){

        $this->loadModel('Sales.Company');

        $this->loadModel('Ticket.JobTicket');

        $this->loadModel('Production.Machine');

        $companyData = $this->Company->find('list',array('fields' => array('id','company_name')));

        $machineData = $this->Machine->find('list',array('fields' => array('id','name')));

        //calling data
     //   $machineScheduleData = $this->_find_machine_schedule_data(11);
        //pr($machineScheduleData);exit();
        $this->set(compact('machineScheduleData','companyData','machineData'));

    }

    public function _find_machine_schedule_data($conditionsProcess){

      //  pr($conditionsProcess); exit;

        $this->loadModel('Production.MachineSchedule');

        $this->MachineSchedule->bind(array('JobTicket','MachineLog'));

        $conditions = array('MachineSchedule.process_status' => $conditionsProcess);

        $conditions = array_merge($conditions,array('MachineSchedule.created >=' => date('Y-m-d')));

        $machineScheduleData = $this->MachineSchedule->find('all',array('order' => 'MachineSchedule.id DESC','conditions' => $conditions));

        return $machineScheduleData;

    }

    public function set_dates() {

        if (!empty($this->request->data)) {

            pr($this->request->data);
            exit();
        }
    }

}
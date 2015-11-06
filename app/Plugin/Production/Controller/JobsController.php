<?php
App::uses('AppController', 'Controller');
App::uses('SessionComponent', 'Controller/Component');

class JobsController extends ProductionAppController {

    public function plans() {


        $limit = 10;

        $this->loadModel('Ticket.JobTicket');

        $this->loadModel('Sales.ClientOrderDeliverySchedule');

        $this->loadModel('Sales.Company');

        $this->loadModel('Production.Machine');

        $this->loadModel('Production.ProcessDepartment');


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



        $conditions =array('date(JobTicket.created) BETWEEN ? AND ?' => array($date1,$date2));


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

}
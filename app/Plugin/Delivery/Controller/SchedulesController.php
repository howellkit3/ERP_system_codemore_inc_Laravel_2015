<?php
App::uses('AppController', 'Controller');
App::uses('SessionComponent', 'Controller/Component');

class SchedulesController extends DeliveryAppController {

    public function index() {
    
   }

    public function add($id = null) {
        pr($id);die;

        

    }     

    public function view($id = null) {

        $salesOrderId = $id;
       
        
        $scheduleInfo = $this->Schedule->find('first', array(
                                              'conditions' => array(
                                              'sales_order_id' => $salesOrderId
                                                )
                                            ));
                                    
        
        if($scheduleInfo['Schedule']['status'] == "Accepted"){

            $this->redirect( array(
                                 'controller' => 'schedules', 
                                 'action' => 'approved', $id
                                 //'plugin' => 'delivery'
                            ));

        }
       

        $this->set(compact('scheduleInfo'));
        
    }
    public function approved($id = null){
        $this->loadModel('Sales.RequestDeliverySchedule');
        $requestScheduleInfo = $this->RequestDeliverySchedule->find('first', array(
                                                                        'conditions' => array(
                                                                            'sales_order_id' => $id
                                                                        )
                                                                    ));
        //pr($requestScheduleInfo);die;
        $this->Schedule->bind(array('TruckSchedule'));
        $scheduleInfo = $this->Schedule->find('first', array(
                                                 'conditions' =>  array(
                                                     'Schedule.sales_order_id' => $id
                                                      )
                                             ));
        $this->set(compact('requestScheduleInfo','scheduleInfo'));

    }
     public function delivery_receipt($id = null){
       
        $this->layout = 'pdf';
        Configure::write('debug',2);

        $this->loadModel('Sales.Quotation');
        $this->Quotation->bind(array('QuotationField','Product'));
        $ticketDetails = $this->Quotation->find('first', array(
                                                    'conditions' => array(
                                                        'unique_id' => $id
                                                        )
                                                    ));

        $this->loadModel('Sales.Company');
        if(!empty($ticketDetails['Quotation']['inquiry_id'])){

            $this->Company->bind(array('Address','Contact','Email','Inquiry'));
            $companyName = $this->Company->Inquiry->find('first', array(
                                            'conditions' => array(
                                                'Inquiry.id' => $ticketDetails['Quotation']['inquiry_id']
                                                )
                                            ));
        }   

        else{

            $this->Company->bind(array('Address','Contact','Email'));
            $companyName = $this->Company->find('first', array(
                                                    'conditions' => array(
                                                        'id' => $ticketDetails['Quotation']['company_id'])
                                            ));
        }
        //pr($ticketDetails);die;
        $this->set(compact('ticketDetails','companyName'));

    }

     
}
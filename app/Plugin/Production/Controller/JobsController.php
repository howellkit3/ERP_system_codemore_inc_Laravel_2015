<?php
App::uses('AppController', 'Controller');
App::uses('SessionComponent', 'Controller/Component');

class JobsController extends ProductionAppController {

    public function plans() {

        $this->loadModel('Ticket.JobTicket');

        $this->loadModel('Sales.ClientOrder');

        $this->JobTicket->bindJobTicket(); 

        $jobData = $this->JobTicket->find('all',array('fields' => array('id','client_order_id','product_id')));

        foreach ($jobData as $key => $jobList) {

            $this->ClientOrder->bind(array('Quotation','ClientOrderDeliverySchedule','QuotationItemDetail','QuotationDetail','Product','Company'));

            $clientData = $this->ClientOrder->find('first',array('conditions' => array('ClientOrder.id' => $jobList['JobTicket']['client_order_id'])));

            $jobData[$key]['ClientData']['client_order_id'] = $clientData['ClientOrder']['id'];
            $jobData[$key]['ClientData']['product_name'] = $clientData['Product']['name'];
            $jobData[$key]['ClientData']['company_name'] = $clientData['Company']['company_name'];
            //$jobData[$key]['ClientData']['shedule_no'] = $clientData['ClientOrderDeliverySchedule']['uuid'];
           

        }
       
        $this->set(compact('jobData'));
        
    }

    public function view(){

    }

    public function schedule($clientId = null){
        
    }
    
}
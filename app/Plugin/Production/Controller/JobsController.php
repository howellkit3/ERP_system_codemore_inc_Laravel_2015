<?php
App::uses('AppController', 'Controller');
App::uses('SessionComponent', 'Controller/Component');

class JobsController extends ProductionAppController {

    public function plans() {

        $this->loadModel('Ticket.JobTicket');

        $this->loadModel('Sales.ClientOrder');

        $this->loadModel('Sales.Company');

        $this->loadModel('Sales.ProductSpecificationProcess');

        $this->loadModel('Sales.ProductSpecificationProcessHolder');

        $companyData = $this->Company->find('list',array('fields' => array('id','company_name')));

        $this->JobTicket->bindJobTicket(); 

        $jobData = $this->JobTicket->find('all',array('order' => 'JobTicket.id DESC'));

        foreach ($jobData as $key => $jobList) {

            //find if product has specs
           
            $formatData = $this->ProductSpecificationProcess->find('first',array('conditions' => array('product_id' => $jobList['Product']['id'])));

            $processData = $this->ProductSpecificationProcessHolder->find('all',array('conditions' => array('product_specification_process_id' => $formatData['ProductSpecificationProcess']['id']),
                                                    'fields' => array('id','product_specification_process_id','process_id','sub_process_id','order')));
            
            $jobData[$key]['Process'] = $processData;
           
        }
        //pr($jobData);exit();
        $this->set(compact('jobData','companyData'));
        
    }

    public function printing(){

    }

    public function coating(){

    }

    public function corrugated_lamination(){

    }

    public function diecutting(){

    }

    public function stripping(){

    }

    public function browsing(){

    }

    public function gluing(){

    }

    public function final_inspection(){

    }

    public function scrap_items(){

    }

    public function packing(){

    }

}
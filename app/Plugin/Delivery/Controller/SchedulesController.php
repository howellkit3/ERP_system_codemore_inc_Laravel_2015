<?php
App::uses('AppController', 'Controller');
App::uses('SessionComponent', 'Controller/Component');

class SchedulesController extends DeliveryAppController {

    public function index() {
    //     $scheduleData = $this->Schedule->find('all');
    // //     $this->set(compact('scheduleData'));
   }

    public function add($id = null) {
        $userData = $this->Session->read('Auth');
        $this->loadModel('Sales.Quotation');
        $quotationId = $this->Quotation->find('first', array(
                                    'condition'=> array(
                                    'id'=> $id
                                    )
                                ));
        $this->loadModel('Delivery.Schedule');

        $this->Schedule->bind(array('Truck'));
        
        $this->Schedule->Truck->bind(array('TruckAvailability'));

        $this->Schedule->Truck->TruckAvailability->bind('Truck');

        $truckId = $this->Schedule->Truck->TruckAvailability->find('list', array(
                                                    'fields'=> array('id','Truck.plate_number'),
                                                    'conditions' => array(
                                                            'status' => 'available'
                                                            )
                                                    ));
                            

        // if($this->request->is('post')){
        //     $this->loadModel('Production.Schedule');
        //     $this->Schedule->addSchedule($this->request->data, $userData['User']['id']);
        //     $this->redirect(
        //                 array(
        //                     'controller' => 'schedules', 
        //                     'action' => 'index'
        //                 ));
    
        // }
        $this->set(compact('quotationId','truckId'));
        
    }

    public function find_data($id = null) {
        // $this->loadModel('Sales.Company');
        // $this->layout = false;
        // $this->Company->bind(array('Quotation','Inquiry'));
        
        // $inquiryData = $this->Company->Inquiry->find('first', array(
        //                                              'condition' => array(
        //                                              'Inquiry.company_id' => $id
        //                                                     )
        //                                             ));
        
        // $uniqueId = $this->Company->Quotation->find('first', array(
        //                                             'conditions'=> array(
        //                                                                 'Quotation.company_id' => $id
        //                                                                 )
                
        //                                             ));

        // echo json_encode($uniqueId);
        // $this->autoRender = false;
    }
     
}
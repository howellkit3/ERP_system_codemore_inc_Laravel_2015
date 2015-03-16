<?php
App::uses('AppController', 'Controller');
App::uses('SessionComponent', 'Controller/Component');

class TruckSchedulesController extends DeliveryAppController {

	public $uses = array('Delivery.Schedule');
    

	public function index() {
    
   }

	 public function add($id = null) {

        $scheduleInfo = $this->Schedule->find('first', array(
                                              'conditions' => array(
                                              'sales_order_id' => $id
                                                )
        
                                              ));
        $this->loadModel('Delivery.Truck');
        $truckId = $this->Truck->find('list', array(
                                         'fields' => array(
                                         'id','plate_number'
                                            )
                                         ));


        $this->set(compact('scheduleInfo','truckId'));
        
    }


    public function save($id = null) {

        $userData = $this->Session->read('Auth');
        if($this->request->is('post')){
            if(!empty($this->request->data)){
                $this->loadModel('Delivery.TruckSchedule');
                $this->TruckSchedule->addTruckSchedule($this->request->data, $userData['User']['id']);

                $this->Schedule->updateStatus($this->request->data, $userData['User']['id']);

                $this->loadModel('Sales.RequestDeliverySchedule');
                $this->RequestDeliverySchedule->updateRequest($this->request->data, $userData['User']['id']);

                $this->redirect( array(
                                     'controller' => 'deliveries', 
                                     'action' => 'index',
                                     'plugin' => 'delivery'
                                ));
    
            }
        }
    }

    public function get_product_schedule() {
        $this->loadModel('Delivery.TruckSchedule');

        if(isset($this->request->data['time_from'])){
          
           $count = $this->TruckSchedule->find('count', array(
                                                  'conditions' => array(
                                                      'truck_id' => $this->request->data['plate_number'],
                                                      'date' => $this->request->data['sched_date'],
                                                      'time_from' => $this->request->data['time_from']),
                                                  'fields' => array(
                                                      'time_from', 'time_to', 'location'
                                                    )
                                               ));
        }
        
        $data = $this->TruckSchedule->find('all', array(
                                              'conditions' => array(
                                                  'truck_id' => $this->request->data['plate_number'],
                                                  'date' => $this->request->data['sched_date']),
                                              'fields' => array(
                                                  'time_from', 'time_to', 'location'
                                                )
                                           ));

        if(!empty($count)){
            if($count == "0"){
              $message = "Without Conflict";

            }
            else{
                $message = "Conflict";
            }

        }
        
       $this->set(compact('data','message'));

    }
}
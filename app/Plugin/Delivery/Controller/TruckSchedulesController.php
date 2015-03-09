<?php
App::uses('AppController', 'Controller');
App::uses('SessionComponent', 'Controller/Component');

class TruckSchedulesController extends DeliveryAppController {

	public $uses = array('Delivery.Schedule');
    

	public function index() {
    //     $scheduleData = $this->Schedule->find('all');
    // //     $this->set(compact('scheduleData'));
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
        // $str = ("11:58");
        // list($hour, $minute) = split(":",$str);
        // pr($hour);die;

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

        $this->layout = false;
  
        $this->loadModel('Delivery.TruckSchedule');
        
        $data = $this->TruckSchedule->find('all', array(
                                              'conditions' => array(
                                                  'truck_id' => $this->request->data['plate_number'],
                                                  'date' => $this->request->data['sched_date']),
                                              'fields' => array(
                                                  'time_from', 'time_to', 'location'
                                                )
                                           ));
        //pr($this->request->data);die;
       $this->set(compact('data'));
        
        // echo json_encode($data);



        // $this->autoRender = false;

    }
}
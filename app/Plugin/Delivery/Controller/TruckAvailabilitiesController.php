<?php
App::uses('AppController', 'Controller');
App::uses('SessionComponent', 'Controller/Component');

class TruckAvailabilitiesController extends DeliveryAppController {

	public $uses = array('Delivery.Schedule');

	public function index() {
    //     $scheduleData = $this->Schedule->find('all');
    // //     $this->set(compact('scheduleData'));
   }

	 public function view($id = null) {

	 	$this->Schedule->bind(array('Truck', 'TruckAvailability'));
	 	$schedules = $this->Schedule->find('all');
	 	pr($schedules); die;




        $userData = $this->Session->read('Auth');
        $truckAvailability = $this->TruckAvailability->find('first', array(
																'conditions' => array(
																	'sales_order_id' => $id
																)));
        //pr($truckAvailability);exit();
        $quotationId = $id;
        $this->loadModel('Delivery.Schedule');
        $scheduleInfo = $this->Schedule->find('first', array(
                                                'conditions' => array(
                                                    'sales_order_id' => $quotationId
                                                )));

       
        // $this->Schedule->bind(array('Truck'));

        // $this->Schedule->Truck->bind(array('TruckAvailability'));

        // $this->Schedule->Truck->TruckAvailability->bind('Truck');

        // $truckId = $this->Schedule->Truck->TruckAvailability->find('list', array(
        //                                                            'fields'=> array('Truck.id','Truck.plate_number'),
                                                                   
                                                    
        //                                 ));
        //pr($truckId);exit();

        $this->loadModel('Delivery.Truck');
        $truckId = $this->Truck->find('list',array(
        								'fields' => array('id','plate_number')
        							));

        $this->Truck->bind(array('TruckAvailability'));

        $specificTruck = $this->Truck->find('all');
        //pr($specificTruck);exit();

        $this->set(compact('truckId','scheduleInfo','truckAvailability'));
        
    }


    public function save($id = null) {

        $userData = $this->Session->read('Auth');
        if($this->request->is('post')){
            //pr($this->request->data);exit();
                if(!empty($this->request->data)){
                    $this->TruckAvailability->addSchedule($this->request->data, $userData['User']['id']);
                    $this->redirect(
                             array(
                                 'controller' => 'deliveries', 
                                 'action' => 'index',
                                 'plugin' => 'delivery'
                             ));
        
                }
        }
    }

    public function accept($id = null) {

        //pr($id);exit();
        $this->loadModel('Delivery.Schedule');
        $this->Schedule->updateStatus($id,'Accepted');

    	$this->redirect(

         array('controller' => 'deliveries', 
            	'action' => 'index'

          ));
       
    }
    public function decline($id = null) {

        //pr($id);exit();
        $this->loadModel('Delivery.Schedule');
        $this->Schedule->updateStatus($id,'Declined');

    	$this->redirect(

         array('controller' => 'deliveries', 
            	'action' => 'index'

          ));
       
    }
}
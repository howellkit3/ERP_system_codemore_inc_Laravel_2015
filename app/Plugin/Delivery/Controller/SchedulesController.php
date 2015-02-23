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

        
            if($this->request->is('post')){
            //pr($this->request->data);exit();
                if(!empty($this->request->data)){
                    $this->Schedule->addSchedule($this->request->data, $userData['User']['id']);
                    $this->redirect(
                             array(
                                 'controller' => 'sales_orders', 
                                 'action' => 'index',
                                 'plugin' => 'sales'
                             ));
        
                  }
            }
             
            $this->loadModel('Sales.Quotation');
            $quotationId = $this->Quotation->find('first', array(
                                    'conditions'=> array(
                                    'id'=> $id
                                    )
                                ));

            $this->loadModel('Delivery.Schedule');
        //pr($quotationId);exit();
            $salesOrderIdHolder = $this->Schedule->find('first', array(
                                                            'conditions' => array(
                                                                                   'sales_order_id' => $quotationId['Quotation']['unique_id']
                                                                                )
                                                        ));

            if(empty($salesOrderIdHolder)){
                $salesOrderId = Null;
            }
            else{
            
                $salesOrderId = $salesOrderIdHolder;
            }

            $this->Schedule->bind(array('Truck'));

        
            $this->Schedule->Truck->bind(array('TruckAvailability'));

            $this->Schedule->Truck->TruckAvailability->bind('Truck');

            $truckId = $this->Schedule->Truck->TruckAvailability->find('list', array(
                                                    'fields'=> array('Truck.id','Truck.plate_number'),
                                                    'conditions' => array(
                                                            'status' => 'available'
                                                            )
                                                    ));
           
            $this->set(compact('quotationId','truckId','salesOrderId'));
         

    }     

    public function view($id = null) {

        $userData = $this->Session->read('Auth');

        $quotationId = $id;
        
        $scheduleInfo = $this->Schedule->find('first', array(
                                                'conditions' => array(
                                                                        'sales_order_id' => $quotationId
                                                                    )

                                            ));

       
        $this->Schedule->bind(array('Truck'));

        $this->Schedule->Truck->bind(array('TruckAvailability'));

        $this->Schedule->Truck->TruckAvailability->bind('Truck');

        $truckId = $this->Schedule->Truck->TruckAvailability->find('list', array(
                                                                   'fields'=> array('Truck.id','Truck.plate_number'),
                                                                   'conditions' => array(
                                                                            'status' => 'available'
                                                    )
                                            ));

        $this->set(compact('truckId','scheduleInfo'));

    }
    public function save($id = null) {

        $userData = $this->Session->read('Auth');

        
    }
     
}
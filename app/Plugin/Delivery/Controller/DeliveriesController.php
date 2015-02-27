<?php
App::uses('AppController', 'Controller');
App::uses('SessionComponent', 'Controller/Component');

class DeliveriesController extends DeliveryAppController {

    public function index() {
        $this->loadModel('Delivery.Schedule');
        $scheduleData = $this->Schedule->find('all');
        //pr($scheduleData);
        $this->set(compact('scheduleData'));
   }

   public function createDeliveryReceipts(){
   		
   }
     
}
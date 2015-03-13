<?php
App::uses('AppController', 'Controller');
App::uses('SessionComponent', 'Controller/Component');

class SalesInvoiceController extends AccountingAppController {

	public function index(){

		
		$this->loadModel('Delivery.Schedule');
        $scheduleData = $this->Schedule->find('all', array(
        										'conditions' => array(
        												'status' => "Approved"
        											)
        									));

        $this->set(compact('scheduleData'));
	}

	public function add(){

		
		$salesId = $this->SalesInvoice->find('list', array(
                                                'fields' => array(
                                                    'delivery_id'
                                                  )
                                            ));
		$this->loadModel('Delivery.Delivery');
      	$detailValue = $this->Delivery->find('list', array(
                                          			'fields' => array(
                                              			'sales_order_id'),
                                        		));
      	

		$this->loadModel('Delivery.Schedule');
		$deliveryNo = $this->Schedule->find('list', array(
												'fields' => array(
													'sales_order_id','sales_order_id'),
												'conditions' => array(
													'id NOT' => $salesId, 
													'sales_order_id' => $detailValue

													)
											));
		

		$this->set(compact('deliveryNo'));
		
	}

	public function find_data($id = null){

		$this->layout = false;
		$this->loadModel('Delivery.Schedule');
		$scheduleInfo = $this->Schedule->find('first', array(
												'conditions' => array(
													'sales_order_id' => $id)
											));
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

        $this->loadModel('Delivery.Delivery');
        $deliveryDetails = $this->Delivery->find('all', array(
		                                            'conditions' => array(
		                                                'sales_order_id' => $id
		                                              ),
		                                            'order' => array(
		                                            	'delivery_details_id ASC'
		                                            )
		                                        ));

		//pr($deliveryDetails);die;

		$data = array($scheduleInfo, $ticketDetails, $companyName, $deliveryDetails);
		//pr($data);die;
		echo json_encode($data);
		$this->autoRender = false;
	}

	public function get_data(){
		

	}
}
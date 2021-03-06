<?php
App::uses('AppController', 'Controller');
App::uses('SessionComponent', 'Controller/Component');

class SalesOrdersController extends SalesAppController {

	public $uses = array('Sales.Quotation','Sales.ClientOrder','Sales.Company');

	public function beforeFilter() {

        parent::beforeFilter();

        $this->Auth->allow('index');

        $this->loadModel('User');
        $userData = $this->User->read(null,$this->Session->read('Auth.User.id'));//$this->Session->read('Auth');
        $this->set(compact('userData'));

    }
	    	    
	public function index() {

    $this->loadModel('Sales.Product');

		$userData = $this->Session->read('Auth');
		
		$this->Quotation->bind(array('ClientOrder'));

		//$clientOrder = $this->Quotation->ClientOrder->find('all', array('order' => 'ClientOrder.id DESC'));
    $this->Quotation->ClientOrder->bind(array('QuotationItemDetail','QuotationDetail','Company','Product'));

    $limit = 10;

    $conditions = array('ClientOrder.status_id' => null);

    if ($this->request->is('ajax')) {

      $query = $this->request->query;


      if (!empty($query['name'])) {

        $this->loadModel('Sales.Product');
        $this->Quotation->bind(array('ClientOrder'));
        $this->Quotation->ClientOrder->bind(array('QuotationItemDetail','QuotationDetail','Company','Product'));
        

        // $clientOrder = $this->ClientOrder->find('all');
       
        // $conditions = array('ClientOrder.status_id' => null);
        // $conditions = array_merge($conditions,array(
        //   'OR' => array(
        //       'ClientOrder.uuid like' => '%'. $query['name'] . '%',
        //       //'Company.company_name like' => '%'. $query['name'] . '%',
        //       'Product.name like' => '%'. $query['name'] . '%',
        //     )
        // ));

        $conditions = array('ClientOrder.status_id' => null, 'OR' => array(
                        array('ClientOrder.po_number LIKE' => '%' . $query['name'] . '%'),
                        array('ClientOrder.uuid LIKE' => '%' . $query['name'] . '%'),
                          array('Product.name LIKE' => '%' . $query['name'] . '%'),
                          array('Company.company_name LIKE' => '%' . $query['name'] . '%')
                          ));

        $clientOrder = $this->ClientOrder->find('all',array(
                      'group' => array('ClientOrder.id'),
                      'conditions' => $conditions,
                      'limit' => 10
                      )); 


        // $clientOrder = $this->ClientOrder->find('all',array(
        //           'order' => 'ClientOrder.id DESC',
        //           'conditions' => array(
        //             'OR' => array(
        //               array('ClientOrder.status_id' => null),
        //               array('ClientOrder.uuid LIKE' => '%' .  $query['name'] . '%'),
        //               array('Product.name LIKE' => '%' . $query['name'] . '%')
        //               )
        //             )
        //         )
        // );

       
      }

    } else {
        $this->paginate = array(
            'conditions' => $conditions,
            'limit' => $limit,
            'order' => 'ClientOrder.id DESC',
            'group' => 'ClientOrder.id'
        );

        $clientOrder = $this->paginate('ClientOrder');
    }

		$this->loadModel('Sales.Company');

		$this->Company->bind(array('Inquiry'));

		$companyData = $this->Company->find('list',array(
     											'fields' => array('id','company_name')
     										));

		$inquiryId = $this->Company->Inquiry->find('list',array(
     													'fields' => array('company_id')
     												));

		$quoteName = $this->Quotation->find('list',array('id','name'));

    //no permission sales/Receivable Staff/Accounting Head
    if ($userData['User']['role_id'] == 6 || $userData['User']['role_id'] == 9 ) {

        $noPermission = 'disabled not-active';

    }else{
      $noPermission = ' ';
    }
		
		$this->set(compact('clientOrder','quoteName','companyData','inquiryId','noPermission'));

     if ($this->request->is('ajax')) {
      
      $this->render('SalesOrders/ajax/index');
     
     }
	}

	public function view($clientOrderId = null){

    $this->loadModel('Currency');
    
    $this->loadModel('Unit');

    $this->loadModel('Sales.ProductSpecification');

    $userData = $this->Session->read('Auth');

    if (!empty($this->request->data)) {
 
      $this->ClientOrder->save($this->request->data);

      $this->Session->setFlash(__('P.O. number was  updated'),'success');

      $this->redirect(
                array('controller' => 'sales_orders','action' => 'view',$this->request->data['ClientOrder']['id']  )
            );
    }



    $currencies = $this->Currency->getList();

    $units = $this->Unit->getList();

		$this->loadModel('PaymentTermHolder');
       
		$this->Quotation->bind(array('QuotationDetail','QuotationItemDetail','Product','ContactPerson'));

		$this->ClientOrder->bind(array('ClientOrderDeliverySchedule', 'QuotationItemDetail'));

		$clientOrderData = $this->ClientOrder->find('first',array('conditions' => array('ClientOrder.id' => $clientOrderId)));

		$quotationData = $this->Quotation->findById($clientOrderData['ClientOrder']['quotation_id']);

  //pr($clientOrderData); exit;

    $checkSpec = $this->ProductSpecification->find('first',array('conditions' => array('ProductSpecification.product_id' => $quotationData['QuotationDetail']['product_id'])));
    
		$companyName = $this->Company->find('list',array(
     													'fields' => array('id','company_name')
     												));

		//$quotationItemDetail = $this->Quotation->QuotationItemDetail->find('first',array('conditions' => array('QuotationItemDetail.id' => $clientOrderData['ClientOrder']['client_order_item_details_id'])));
      
		$paymentTermData = $this->PaymentTermHolder->find('list',array('fields' => array('id','name')));
					
    $noPermission = ' ';

		$this->set(compact('noPermission','checkSpec','clientOrderData','quotationData','companyName','quotationItemDetail','paymentTermData','currencies','units'));

	}

	public function add_schedule() {

      //new code bienskie noted:all adding schedule can use this controller
      $this->loadModel('Sales.ClientOrderDeliverySchedule');

      $this->loadModel('Sales.QuotationItemDetail');

      $this->ClientOrder->bind(array('ClientOrderDeliverySchedule', 'Quotation',  'QuotationItemDetail'));

      $userData = $this->Session->read('Auth');

      $schedData2 = $this->QuotationItemDetail->findById('80');

      $schedData = $this->ClientOrder->find('all', array('conditions' => array('ClientOrder.id' => $this->request->data['ClientOrderDeliverySchedule']['client_order_id'])));

     $abc = $schedData[0]['QuotationItemDetail']['quantity']; 

      //pr($this->request->data['ClientOrderDeliverySchedule']); exit;
             
      if ($this->request->is('post')) {

        if ($this->request->data['ClientOrderDeliverySchedule']['delivery_type'] == "Once") {

            $schedHolderId = array();
               
                  foreach ($this->request->data as $key => $idList) {
                          array_push($schedHolderId, $idList['id']); 
                  }

                    $dataHolder = array();

                    foreach ($schedData[0]['ClientOrderDeliverySchedule'] as $key => $sched) { 

                        if(in_array($schedData[0]['ClientOrderDeliverySchedule'][$key]['id'], $schedHolderId)){

                            $result['ClientOrderDeliverySchedule'] = Set::classicExtract($this->request->data,'{s}');

                            $this->request->data['ClientOrderDeliverySchedule']['quantity'] = $abc;
                           
                            $this->ClientOrder->ClientOrderDeliverySchedule->editClientOrderDeliverySchedule($result,$userData['User']['id'],$this->request->data['ClientOrderDeliverySchedule']['client_order_id']);
                                        
                        }else{
                         
                             $this->ClientOrderDeliverySchedule->delete($schedData[0]['ClientOrderDeliverySchedule'][$key]['id']);
                        }
                     }

                        $this->Session->setFlash(__('Client order delivery details has been updated'), 'success');

                      return $this->redirect(array('controller' => 'sales_orders','action' => 'view',$this->request->data['ClientOrderDeliverySchedule']['client_order_id']));     
        
        }else{
            

        if (!empty($this->request->data)) {

               if (!empty($this->request->data['ClientOrderDeliverySchedule']['location']) && ($this->request->data['ClientOrderDeliverySchedule']['quantity']) && ($this->request->data['ClientOrderDeliverySchedule']['schedule'])) {

                      $result['ClientOrderDeliverySchedule'] = Set::classicExtract($this->request->data,'{s}');
                     
                      $this->ClientOrder->ClientOrderDeliverySchedule->editClientOrderDeliverySchedule($result,$userData['User']['id'],$this->request->data['ClientOrderDeliverySchedule']['client_order_id']);
                    
                      $this->Session->setFlash(__('Client order delivery details has been updated'), 'success');

                      return $this->redirect(array('controller' => 'sales_orders','action' => 'view',$this->request->data['ClientOrderDeliverySchedule']['client_order_id']));

                }else{

            $this->Session->setFlash(__('Delivery details must be complete'),'error');

            return $this->redirect(array('controller' => 'sales_orders','action' => 'view',$this->request->data['ClientOrderDeliverySchedule']['client_order_id']));

          }

        }

      }
		}
	}


	  public function status() {

        $userData = $this->Session->read('Auth');

        $productData = $this->AddProduct->find('all', array('order' => 'StatusFieldHolder.id DESC'));
        if ($this->request->is('post')) {
            
            if (!empty($this->request->data)) {
               // pr($this->request->data); exit;

              //  pr($this->StatusFieldHolder->ItemTypeHolder->saveItemType($this->request->data['id'], $this->id));exit();

                $this->StatusFieldHolder->create();

                $this->id = $this->StatusFieldHolder->saveStatus($this->request->data['StatusFieldHolder'], $userData['User']['id']);

            
                $this->Session->setFlash(__('Add Status Complete.'));

                $this->redirect(
                    array('controller' => 'settings', 'action' => 'status')
                );
            }
        }

       // $categoryData = $this->ItemCategoryHolder->find('all', array('order' => 'StatusFieldHolder.id DESC'));
        $this->set(compact('productData'));
        //$this->set(compact('categoryData'));
    }

    public function terminate($id = null) {

     // pr('d'); exit;

      $userData = $this->Session->read('Auth');

      $this->ClientOrder->id = $id;

      $this->ClientOrder->saveField('status_id', 1);

      $this->ClientOrder->saveField('modified_by', $userData['User']['id']);

      $this->Session->setFlash(__('Client Order has been removed'), 'success');
      
        $this->redirect( array(
            'controller' => 'sales_orders',   
            'action' => 'index'
        ));  

    }
	
}
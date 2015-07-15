<?php
App::uses('AppController', 'Controller');
App::uses('SessionComponent', 'Controller/Component');

class RequestsController extends PurchasingAppController {

	public $helpers = array('Purchasing.Country');

	public $uses = array('Purchasing.Supplier');

	public function index() {

		$this->Supplier->bind(array('Address','Email','Contact','SupplierContactPerson'));

		$limit = 10;

		$conditions = array();

         $this->paginate = array(
            'conditions' => $conditions,
            'limit' => $limit,
            'fields' => array('id', 'name', 'description','website','created','tin'),
            'order' => 'Supplier.created DESC',
        );

		$suppliers = $this->paginate();

		$this->set(compact('suppliers'));

	}

	public function create() {

		$userData = $this->Session->read('Auth');

		$this->loadModel('Purchasing.Request');

		$this->loadModel('Purchasing.PurchasingItem');

		$this->loadModel('Purchasing.PurchasingType');

	 	$purchasingTypeData = $this->PurchasingType->find('list', array(
														'fields' => array('PurchasingType.id', 'PurchasingType.name'),
														));

	 	$this->loadModel('Unit');

		$unitData = $this->Unit->find('list', array('fields' => array('id', 'unit'),
															'order' => array('Unit.unit' => 'ASC')
															));

		$this->loadModel('GeneralItem');

		$itemData = $this->GeneralItem->find('list', array('fields' => array('id', 'name'),
															'order' => array('GeneralItem.name' => 'ASC')
															));

	 	if ($this->request->is(array('post','put'))) {

	 		$month = date("m"); 

		    $year = date("y");

		    $hour = date("H");

		    $minute = date("i");

		    $seconds = date("s");

		    $random = rand(1000, 10000);
	        
			$code =  $year. $month .$random;

			$this->request->data['Request']['uuid'] = $code;

	 		foreach ($this->request->data['PurchasingItem'] as $key => $requestValue) 

				{

					 $requestValue['item_group_uuid'] = $code;

					 $this->PurchasingItem->save($requestValue);

				}

			$this->Request->saveRequest($this->request->data['Request'],$userData['User']['id']);

			



			

			
				
	 		$this->Session->setFlash(__('Request has been added.'));

            $this->redirect( array(
	                                     'controller' => 'requests', 
	                                     'action' => 'request_list'
	                              
	                             ));

        }

		$this->set(compact('purchasingTypeData', 'unitData','itemData'));
			
	}


	public function request_list(){

		$this->loadModel('Purchasing.Request');

		$this->loadModel('Purchasing.PurchasingItem');

		$this->loadModel('StatusFieldHolder');

		$this->loadModel('GeneralItem');

		$this->loadModel('Substrate');

		$this->loadModel('CorrugatedPaper');

		$this->loadModel('CompoundSubstrate');

		$itemGroupData = $this->PurchasingItem->find('all');

		$this->Request->bindRequest();

		$requestData = $this->Request->find('all', array('order' => array('Request.created' => 'DESC')
															));

		 foreach ($requestData as $key => $value) {

	 		if($value['PurchasingItem']['model'] == 'GeneralItem'){

	 			$itemData = $this->GeneralItem->find('list',array('fields' => array('id', 'name')));
	 			$requestData[$key]['PurchasingItem']['name'] = $itemData[$value['PurchasingItem']['foreign_key']];
	 		}

	 		if($value['PurchasingItem']['model'] == 'CorrugatedPaper'){

	 			$itemData = $this->CorrugatedPaper->find('list',array('fields' => array('id', 'name')));
	 			$requestData[$key]['PurchasingItem']['name'] = $itemData[$value['PurchasingItem']['foreign_key']];
	 		}

	 		if($value['PurchasingItem']['model'] == 'Substrate'){

	 			$itemData = $this->Substrate->find('list',array('fields' => array('id', 'name')));
	 			$requestData[$key]['PurchasingItem']['name'] = $itemData[$value['PurchasingItem']['foreign_key']];
	 		}

	 		if($value['PurchasingItem']['model'] == 'CompoundSubstrate'){

	 			$itemData = $this->CompoundSubstrate->find('list',array('fields' => array('id', 'name')));
	 			$requestData[$key]['PurchasingItem']['name'] = $itemData[$value['PurchasingItem']['foreign_key']];
	 		}

	     } 


		$statusData = $this->StatusFieldHolder->find('list', array('fields' => array('id', 'status'),
															'order' => array('StatusFieldHolder.status' => 'ASC')
															));

		$this->set(compact('requestData','statusData', 'itemGroupData', 'itemData'));
		
	}

	 public function item_search($itemGroupId = null, $searchHint = null ,$dynamicId) {

    	//$this->bind->GeneralItem('ItemCategoryHolder','ItemTypeHolder');

    		if($itemGroupId == 1) {
    		$ModelName = 'GeneralItem';
    		$searchedProduct = $this->GeneralItem->find('all',array(
											'order' => 'GeneralItem.name ASC',
											'limit' => 10
											));
    		
    	}
    	if($itemGroupId == 2) {
    		$ModelName = 'Substrate';
    		$searchedProduct = $this->Substrate->find('all',array(
    										'order' => 'Substrate.name ASC',
    										'limit' => 10
											));
    		
    	}
    	if($itemGroupId == 3) {
    		$ModelName = 'CompoundSubstrate';
    		$searchedProduct = $this->CompoundSubstrate->find('all',array(
											'order' => 'CompoundSubstrate.name ASC',
											'limit' => 10
											));
    		
    	}
    	if($itemGroupId == 4) {
    		$ModelName = 'CorrugatedPaper';
    		$searchedProduct = $this->CorrugatedPaper->find('all',array(
											'order' => 'CorrugatedPaper.name ASC',
											'limit' => 10
											));
    		
    	}
    	//pr($searchedProduct);
    	$this->set(compact('searchedProduct','ModelName','dynamicId'));

    	$this->render('find_product_details');

    }

    public function item_details($itemGroupId = null){
    	
    	$this->loadModel('GeneralItem');

    	$this->loadModel('CompoundSubstrate');

    	$this->loadModel('CorrugatedPaper');

    	$this->loadModel('Substrate');
    	
    	if($itemGroupId == 1) {
    		$ModelName = 'GeneralItem';
    		$searchedProduct = $this->GeneralItem->find('all',array(
											'order' => 'GeneralItem.name ASC',
											'limit' => 10
											));
    		
    	}
    	if($itemGroupId == 2) {
    		$ModelName = 'Substrate';
    		$searchedProduct = $this->Substrate->find('all',array(
    										'order' => 'Substrate.name ASC',
    										'limit' => 10
											));
    		
    	}
    	if($itemGroupId == 3) {
    		$ModelName = 'CompoundSubstrate';
    		$searchedProduct = $this->CompoundSubstrate->find('all',array(
											'order' => 'CompoundSubstrate.name ASC',
											'limit' => 10
											));
    		
    	}
    	if($itemGroupId == 4) {
    		$ModelName = 'CorrugatedPaper';
    		$searchedProduct = $this->CorrugatedPaper->find('all',array(
											'order' => 'CorrugatedPaper.name ASC',
											'limit' => 10
											));
    		
    	}
    	$this->set(compact('searchedProduct','ModelName','dynamicId'));

    	$this->render('item_details');
		
    }


}
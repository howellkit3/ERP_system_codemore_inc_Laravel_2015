<?php
App::uses('SalesAppController', 'Sales.Controller');
/**
 * Sales Controller
 *
 */
class SalesController extends SalesAppController {

/**
 * Scaffold
 *
 * @var mixed
 */
	//public $scaffold;
		
	public $useDbConfig = 'koufu_sale';
	public $uses = array('Sales.Company');


	// public $paginate = array(
 //        'limit' => 25,
 //        'conditions' => array('status' => '1'),
 //        'order' => array('Sale.company_name' => 'asc' )
 //    );

	public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('add','index');
    }
	    
		    
	public function index() {
		$this->Company->setDataSource('koufu_sale');
		$this->loadModel('Sales.Company');
		
	}

	public function add(){
		$this->Session->read('Auth');
		$this->Company->setDataSource('koufu_sale');
		$this->loadModel('Sales.Company');
		
		$this->Company->bind('Customer');
		//pr($this->request->data);exit();
		if ($this->request->is('post')) {
            if (!empty($this->request->data)) {
            	 
            	//$this->Company->create();
            	$company = $this->Company->save($this->request->data);
            	if (!empty($company)) {
            		$this->loadModel('Sales.Customer');
            		//pr($company);exit();
		            $this->request->data['Customer']['company_id'] = $this->Company->id;
		            //$this->Customer->create();
		            $this->Company->Customer->save($this->request->data['Customer']);
		            	 $this->Session->setFlash(__('Customer Info is successfully added in the system.'));
		            	$this->redirect(
		                    array('controller' => 'sales', 'action' => 'index','plugin' => 'sales')
		                );
		           
	            }
            	
            	
            }
        }
		
	}

}

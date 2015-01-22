<?php
App::uses('SalesAppController', 'Companies.Controller');
/**
 * Sales Controller
 *
 */
class CompaniesController extends SalesAppController {

/**
 * Scaffold
 *
 * @var mixed
 */
	//public $scaffold;
		
	public $useDbConfig = 'koufu_sale';
	public $uses = array('Sales.Company,Sales.Customer');
	public $paginate = array(
        'limit' => 25,
        'conditions' => array('status' => '1'),
        'order' => array('Sale.company_name' => 'asc' )
    );

	public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('add','index');
    }
	    
		    
	public function index() {
		$this->Company->setDataSource('koufu_sale');
		$this->loadModel('Sales.Company');
		
	}

	public function add(){
		
		//$this->Company->setDataSource('koufu_sale');
		//$this->Customer->setDataSource('koufu_sale');
		$this->loadModel('Sales.Company');
		$this->loadModel('Sales.Customer');
		//$this->Company->bind('Customer');
		//pr($this->request->data);exit();
		if ($this->request->is('post')) {
			pr($this->request->data);exit();
            if (!empty($this->request->data)) {
            	 
            	$this->Customer->create();
            	$oo = $this->Customer->save($this->request->data);
            	if ($this->Customer->save($this->request->data)) {
            		pr($oo);
            		echo "yes";exit();
            		
		            $this->request->data['Customer']['company_id'] = $this->Company->id;
		            //$this->Customer->create();
		            $this->Company->Customer->saveAll($this->request->data['Customer']);
		            	 $this->Session->setFlash(__('Customer Info is successfully added in the system.'));
		            	$this->redirect(
		                    array('controller' => 'customers', 'action' => 'add','plugin' => 'sales')
		                );
		           
	            }else{
	            	echo "mmmm";exit();
	            }
            	
            	
            }
        }
		
	}

}

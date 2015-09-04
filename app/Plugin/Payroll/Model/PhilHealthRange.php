<?php
App::uses('AppModel', 'Model');
//namespace Sales\Model\Entity;
/**
 * User Model
 *
 */
class PhilHealthRange extends AppModel {

    public $useDbConfig = 'koufu_payrolls';

    public $name = 'PhilHealthRange';

    var $useTable = 'philhealth_ranges';

    public $recursive = -1;
    
	public $actsAs = array('Containable');

    public $validate = array(

        'salary_base' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
            ),
        ),
     
        'employers' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
            ),
        ),
        'employees' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
            ),
        ),  
    );

     public function bind($model = array('Group')){

        // $this->bindModel(array(
            
        // //     'belongsTo' => array(
        // //         'RolePermission' => array(
        // //             'className' => 'RolePermission',
        // //             'foreignKey' => 'permission_id',
        // //             'dependent' => true
        // //         ),
        // //     )
        // // ));

        // $this->contain($model);
    }

    public function formatData($data = null, $auth = null){

        if (!empty($data)) {

            $data[$this->alias]['range_to'] = strtolower( $data[$this->alias]['range_to']);
            
            if (in_array($data[$this->alias]['range_to'],array('above','below'))) {
             
                switch ($data[$this->alias]['range_to']) {
                    case 'below':
                        $data[$this->alias]['condition'] = 'below';
                        break;
                    case 'above':
                        $data[$this->alias]['range_to'] = 'above';
                        break;
                }
            }


            $data[$this->alias]['created_by'] = $auth['User']['id'];
            $data[$this->alias]['modified_by'] = $auth['User']['id'];
            
        }
        return $data;
    }




}
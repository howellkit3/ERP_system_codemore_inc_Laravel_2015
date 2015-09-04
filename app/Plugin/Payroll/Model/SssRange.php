<?php
App::uses('AppModel', 'Model');
//namespace Sales\Model\Entity;
/**
 * User Model
 *
 */
class SssRange extends AppModel {

	public $useDbConfig = 'koufu_payrolls';

    public $name = 'SssRange';

    var $useTable = 'sss_ranges';

    public $recursive = -1;
    
	public $actsAs = array('Containable');

    public $validate = array(

        'bounds' => array(
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
        'employee_compensations' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
            ),
        )    
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

            $data[$this->alias]['created_by'] = $auth['User']['id'];
            $data[$this->alias]['modified_by'] = $auth['User']['id'];
            
        }
        return $data;
    }




}
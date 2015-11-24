<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
App::uses('AuthComponent', 'Controller/Component');
//namespace Sales\Model\Entity;
/**
 * User Model
 *
 */
class ItemSpec extends AppModel {

    public $useDbConfig = 'koufu_warehouse';
    
  	public $name = 'ItemSpec';


  	public function saveSpec($id = null,$data = array(),$units = array()) {

  		if (!empty($data)) {
  			//delete existing
  			$this->deleteAll(array('ItemSpec.items_id' => $id));

  			$newData = array();

  			foreach ($data['ItemSpec'] as $key => $list) {

  				$newData[$key] = $list;
  				$newData[$key]['items_id'] = $id;
  				$newData[$key]['type'] = $data['Item']['type'];
  				$newData[$key]['item_group'] = $data['Item']['item_group'];

          if (is_numeric( $list['unit_width'])) {
            
              $newData[$key]['unit_width'] = $units[$list['unit_width']];
              $newData[$key]['unit_width_id'] = $list['unit_width'];
          
          }

          if (is_numeric( $list['unit_length'] )) {
            
              $newData[$key]['unit_length'] = $units[$list['unit_length']];
              $newData[$key]['unit_length_id'] = $list['unit_length'];
          
          }
				//save specs
  			}
  			return $this->saveAll($newData);
		  }
  	}


  	public function removeItemSpec($id = null) {


  		if (!empty($id)) {

  			return $this->deleteAll(array('ItemSpec.items_id' => $id));
  		
  		}
  	}

  	
}
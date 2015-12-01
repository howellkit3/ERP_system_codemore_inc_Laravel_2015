<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class TaxHistory extends AppModel {

    public $useDbConfig = 'koufu_human_resource';

    public $name = 'TaxHistory';

    public $actsAs = array('Containable');

   
    public function saveHistory($data = array(),$auth = null) {



    }


}
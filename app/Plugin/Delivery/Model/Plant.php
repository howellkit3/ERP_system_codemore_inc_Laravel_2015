<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class Plant extends AppModel {

    public $useDbConfig = 'koufu_delivery_system';
    public $name = 'Plant';

 
}
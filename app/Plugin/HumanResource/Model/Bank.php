<?php
App::uses('AppModel', 'Model');

class Bank extends AppModel {

    public $useDbConfig = 'koufu_human_resource';

    public $name = 'Bank';

    public $actsAs = array('Containable');


}
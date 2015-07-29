<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class Absence extends AppModel {

    public $useDbConfig = 'koufu_human_resource';

    public $name = 'Absence';

}
<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class Absence extends AppModel {

    public $useDbConfig = 'koufu_human_resource';

    public $name = 'Absence';
	
	public function formatData($data = null,$auth = null) {

		if (!empty($data)) {

			$data[$this->alias]['created_by'] = $auth;
			$data[$this->alias]['modified_by'] = $auth;
			$data[$this->alias]['from'] = date('Y-m-d', strtotime($data['Absence']['from']));
			$data[$this->alias]['to'] = date('Y-m-d', strtotime($data['Absence']['to']));


			return $data;
		}

    }
}
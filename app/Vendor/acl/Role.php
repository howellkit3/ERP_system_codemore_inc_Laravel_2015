<?php

	class Role {

		protected $permissions;

		// protected function __construct() {
		// $this->permissions = array();
		// }

	    // return a role object with associated permissions
	    public static function getRolePerms($role_id) {

	        $userModel = ClassRegistry::init('RolesPermission');
	        
	        $userData = $userModel->find('list',array('conditions' => array('RolesPermission.role_id' => $role_id)));
	       
	        $permModel = ClassRegistry::init('Permission');

	        $permData = $permModel->find('all',array('conditions' => array('Permission.id' => $userData)));
	        
	        $arrayPerm = array();
	        foreach ($permData as $key => $permDataList) {
	        	$perm = $permDataList['Permission']['name'];

	        	array_push($arrayPerm, $perm);
	        }
	        
	       	return $arrayPerm;

	    }
	 
	    // check if a permission is set
	    public function hasPerm($permission) {
	        return isset($this->permissions[$permission]);
	    }
	}

?>

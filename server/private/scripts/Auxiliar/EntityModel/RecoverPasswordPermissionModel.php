<?php

namespace App\Auxiliar\EntityModel;

/*
 * This class offers an interface to perform operations on recover password
 * permissions.
 */
class RecoverPasswordPermissionModel extends EntityModel {
	
	/*
	 * Returns an entity of the type of this model. If it doesn't exist, null is
	 * returned.
	 * 
	 * It receives the entity's ID.
	 */
	public function get($id) {
		$app = $this->app;
		
		// Gets the recover password permission
		return $app->webServerDatabase->getRecoverPasswordPermission($id);
	}
	
}

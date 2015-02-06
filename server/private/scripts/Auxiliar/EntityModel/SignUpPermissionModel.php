<?php

namespace App\Auxiliar\EntityModel;

/*
 * This class offers an interface to perform operations on sign up permissions.
 */
class SignUpPermissionModel extends EntityModel {
	
	/*
	 * Returns an entity of the type of this model. If it doesn't exist, null is
	 * returned.
	 * 
	 * It receives the entity's ID.
	 */
	public function get($id) {
		$app = $this->app;
		
		// Gets the sign up permission
		return $app->webServerDatabase->getSignUpPermission($id);
	}
	
}

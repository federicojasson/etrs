<?php

namespace App\Auxiliar\EntityModel;

/*
 * This class offers operations to manage sign up permissions.
 */
class SignUpPermissionModel extends EntityModel {
	
	/*
	 * Returns a sign up permission. If it doesn't exist, null is returned.
	 * 
	 * It receives the sign up permission's ID.
	 */
	public function get($id) {
		$app = $this->app;
		
		// Gets the sign up permission
		return $app->webServerDatabase->getSignUpPermission($id);
	}
	
}

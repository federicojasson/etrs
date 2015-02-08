<?php

namespace App\Auxiliar\EntityModel;

/*
 * This class offers operations to manage recover password permissions.
 */
class RecoverPasswordPermissionModel extends EntityModel {
	
	/*
	 * Creates a recover password permission.
	 * 
	 * It receives the recover password permission's data.
	 */
	public function create($id, $user, $passwordHash, $salt, $keyStretchingIterations) {
		$app = $this->app;
		
		// Creates the recover password permission
		$app->webServerDatabase->createRecoverPasswordPermission($id, $user, $passwordHash, $salt, $keyStretchingIterations);
	}
	
	/*
	 * Returns a recover password permission. If it doesn't exist, null is
	 * returned.
	 * 
	 * It receives the recover password permission's ID.
	 */
	public function get($id) {
		$app = $this->app;
		
		// Gets the recover password permission
		return $app->webServerDatabase->getRecoverPasswordPermission($id);
	}
	
}

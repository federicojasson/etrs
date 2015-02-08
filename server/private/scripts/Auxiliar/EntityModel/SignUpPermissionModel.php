<?php

namespace App\Auxiliar\EntityModel;

/*
 * This class offers operations to manage sign up permissions.
 */
class SignUpPermissionModel extends EntityModel {
	
	/*
	 * Creates a sign up permission.
	 * 
	 * It receives the sign up permission's data.
	 */
	public function create($id, $creator, $passwordHash, $salt, $keyStretchingIterations, $role) {
		$app = $this->app;
		
		// Creates the sign up permission
		$app->webServerDatabase->createSignUpPermission($id, $creator, $passwordHash, $salt, $keyStretchingIterations, $role);
	}
	
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

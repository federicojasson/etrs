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
		
		// Starts a read-write transaction
		$app->webServerDatabase->startReadWriteTransaction();
		
		// Deletes the user's recover password permission (if there is any)
		$app->webServerDatabase->deleteUserRecoverPasswordPermission($user);
		
		// Creates the recover password permission
		$app->webServerDatabase->createRecoverPasswordPermission($id, $user, $passwordHash, $salt, $keyStretchingIterations);
		
		// Commits the transaction
		$app->webServerDatabase->commitTransaction();
	}
	
	/*
	 * Deletes a recover password permission.
	 * 
	 * It receives the recover password permission's ID.
	 */
	public function delete($id) {
		$app = $this->app;
		
		// Deletes the recover password permission
		$app->webServerDatabase->deleteRecoverPasswordPermission($id);
	}
	
	/*
	 * Deletes the old recover password permissions.
	 * 
	 * It receives the maximum age of a recover password permission (in hours).
	 */
	public function deleteOld($maximumAge) {
		$app = $this->app;
		
		// Deletes the old recover password permissions
		$app->webServerDatabase->deleteOldRecoverPasswordPermissions($maximumAge);
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

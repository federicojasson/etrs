<?php

namespace App\Auxiliar\EntityModel;

/*
 * This class offers operations to manage users.
 */
class UserModel extends EntityModel {
	
	/*
	 * Creates a user.
	 * 
	 * It receives the user's data.
	 */
	public function create($id, $creator, $passwordHash, $salt, $keyStretchingIterations, $role, $firstName, $lastName, $gender, $emailAddress) {
		$app = $this->app;
		
		// Creates the user
		$app->webServerDatabase->createUser($id, $creator, $passwordHash, $salt, $keyStretchingIterations, $role, $firstName, $lastName, $gender, $emailAddress);
	}
	
	/*
	 * Deletes a user.
	 * 
	 * It receives the user's ID.
	 */
	public function delete($id) {
		$app = $this->app;
		
		// Starts a read-write transaction
		$app->webServerDatabase->startReadWriteTransaction();
		
		// Deletes the user's recover password permissions
		$recoverPasswordPermissions = $app->webServerDatabase->getUserRecoverPasswordPermissions($id);
		foreach ($recoverPasswordPermissions as $recoverPasswordPermission) {
			$app->data->recoverPasswordPermission->delete($recoverPasswordPermission['id']);
		}
		
		// Deletes the user
		$app->webServerDatabase->deleteUser($id);
		
		// Commits the transaction
		$app->webServerDatabase->commitTransaction();
	}
	
	/*
	 * Edits a user.
	 * 
	 * It receives the user's data.
	 */
	public function edit($id, $passwordHash, $salt, $keyStretchingIterations, $firstName, $lastName, $gender, $emailAddress) {
		$app = $this->app;
		
		// Edits the user
		$app->webServerDatabase->editUser($id, $passwordHash, $salt, $keyStretchingIterations, $firstName, $lastName, $gender, $emailAddress);
	}
	
	/*
	 * Determines whether a user exists.
	 * 
	 * It receives the user's ID.
	 */
	public function exists($id) {
		$app = $this->app;
		
		// Determines whether the user exists
		return $app->webServerDatabase->userExists($id);
	}
	
	/*
	 * Filters a user for presentation and returns the result.
	 * 
	 * It receives the user.
	 */
	public function filter($user) {
		$app = $this->app;
		
		// Gets the accessible fields
		$accessibleFields = $app->accessValidator->getAccessibleFields('user');
		
		// Filters the user's fields
		$newUser = filterArray($user, $accessibleFields);
		
		// Applies conversions
		
		if (isset($newUser['passwordHash'])) {
			$newUser['passwordHash'] = bin2hex($user['passwordHash']);
		}
		
		if (isset($newUser['salt'])) {
			$newUser['salt'] = bin2hex($user['salt']);
		}
		
		return $newUser;
	}
	
	/*
	 * Returns a user. If it doesn't exist, null is returned.
	 * 
	 * It receives the user's ID.
	 */
	public function get($id) {
		$app = $this->app;
		
		// Gets the user
		return $app->webServerDatabase->getUser($id);
	}
	
}

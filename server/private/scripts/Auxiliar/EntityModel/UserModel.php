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
		// TODO: implement
		return $user;
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

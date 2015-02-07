<?php

namespace App\Helper;

/*
 * This helper manages the authentication state.
 */
class Authentication extends Helper {
	
	/*
	 * Returns the signed in user. If it doesn't exist, the user is signed out
	 * and the execution is halted.
	 */
	public function getSignedInUser() {
		$app = $this->app;
		
		// Gets the user's ID
		$id = $app->session->getData(SESSION_DATA_USER);
		
		// Gets the user
		$user = $app->data->user->get($id);
		
		if (is_null($user)) {
			// The user doesn't exist
			
			// Signs out the user from the system
			$this->signOutUser();
			
			// Halts the execution
			$app->halt(HTTP_STATUS_NOT_FOUND, [
				'error' => ERROR_NON_EXISTENT_USER
			]);
		}
		
		return $user;
	}
	
	/*
	 * Determines whether the user is signed in.
	 */
	public function isUserSignedIn() {
		$app = $this->app;
		
		// Checks whether the session contains a data entry to store the user
		return $app->session->containsData(SESSION_DATA_USER);
	}
	
	/*
	 * Signs in a user in the system.
	 * 
	 * It receives the user's ID.
	 */
	public function signInUser($id) {
		$app = $this->app;
		
		// Regenerates the session's ID
		$app->session->regenerateId();
		
		// Sets a data entry in the session to store the user
		$app->session->setData(SESSION_DATA_USER, $id);
		
		// Logs the event
		$app->log->info('The user ' . $id . ' has been signed in.');
	}
	
	/*
	 * Signs out the user from the system.
	 */
	public function signOutUser() {
		$app = $this->app;
		
		// Gets the user's ID
		$id = $app->session->getData(SESSION_DATA_USER);
		
		// Clears the session's data entry that stores the user
		$app->session->clearData(SESSION_DATA_USER);
		
		// Regenerates the session's ID
		$app->session->regenerateId();
		
		// Logs the event
		$app->log->info('The user ' . $id . ' has been signed out.');
	}
	
	/*
	 * Signs up a user in the system. After the registration, the user is signed
	 * in.
	 * 
	 * It receives the user's data.
	 */
	public function signUpUser($id, $creator, $passwordHash, $salt, $keyStretchingIterations, $role, $firstName, $lastName, $gender, $emailAddress) {
		$app = $this->app;
		
		// Creates the user
		$app->data->user->create($id, $creator, $passwordHash, $salt, $keyStretchingIterations, $role, $firstName, $lastName, $gender, $emailAddress);
		
		// Logs the event
		$app->log->info('The user ' . $id . ' has been signed up.');
		
		// Signs in the user in the system
		$this->signInUser($id);
	}
	
}

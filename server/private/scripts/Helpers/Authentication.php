<?php

namespace App\Helpers;

/*
 * This helper manages the authentication state.
 */
class Authentication extends \App\Helpers\Helper {
	
	/*
	 * Returns the signed in user.
	 */
	public function getSignedInUser() {
		$app = $this->app;
		
		// Gets the user's ID
		$id = $app->session->getData(SESSION_DATA_USER);
		
		// Gets the user
		$user = $app->webServerDatabase->getUser($id);
		
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
		
		// Checks whether the session contains a data entry to store the user's
		// ID and returns the result
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
		
		// Sets a session data entry to store the user's ID
		$app->session->setData(SESSION_DATA_USER, $id);
	}
	
	/*
	 * Signs out the user from the system.
	 */
	public function signOutUser() {
		$app = $this->app;
		
		// Clears the session data entry that stores the user's ID
		$app->session->clearData(SESSION_DATA_USER);
		
		// Regenerates the session's ID
		$app->session->regenerateId();
	}
	
}

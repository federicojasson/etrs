<?php

namespace App\Helpers;

/*
 * This helper manages the authentication state.
 */
class Authentication extends \App\Helpers\Helper {
	
	/*
	 * The signed in user.
	 */
	private $signedInUser;
	
	/*
	 * Returns the signed in user.
	 */
	public function getSignedInUser() {
		$app = $this->app;
		
		if (! isset($this->signedInUser)) {
			// The signed in user has not been initialized yet
			
			// Gets the user's ID
			$id = $app->session->getData(SESSION_DATA_USER);
			
			// Gets the user
			$this->signedInUser = $app->webServerDatabase->getUser($id);
		}
		
		return $this->signedInUser;
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
	}
	
}

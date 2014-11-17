<?php

/*
 * This manager handles user authentication related tasks.
 */
class AuthenticationManager extends Manager {
	
	/*
	 * The logged in user.
	 */
	private $loggedInUser;
	
	/*
	 * Returns the logged in user.
	 */
	public function getLoggedInUser() {
		if ($this->isUserLoggedIn() && is_null($this->loggedInUser)) {
			// The user is logged in but the reference has to be initialized
			
			$app = $this->app;
			
			// Gets the logged in user ID
			$loggedInUserId = $app->session->get(SESSION_KEY_LOGGED_IN_USER_ID);
			
			// Gets the user data
			$userData = $app->businessLogicDatabase->getUser($loggedInUserId);
			
			// Initializes the logged in user
			$this->loggedInUser = User.createFromData($userData);
		}
		
		return $this->loggedInUser;
	}
	
	/*
	 * Determines whether the user is logged in.
	 */
	public function isUserLoggedIn() {
		return $this->app->session->contains(SESSION_KEY_LOGGED_IN_USER_ID);
	}
	
}

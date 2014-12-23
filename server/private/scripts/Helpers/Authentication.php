<?php

/*
 * This helper manages the authentication state.
 */
class Authentication extends Helper {
	
	/*
	 * Returns the logged in user.
	 */
	public function getLoggedInUser() {
		$app = $this->app;
		
		// Gets the logged in user's ID
		$loggedInUserId = $app->session->getData(SESSION_DATA_LOGGED_IN_USER_ID);
		
		// Gets and returns the logged in user
		return $app->data->getUser($loggedInUserId);
	}
	
	/*
	 * Determines whether the user is logged in.
	 */
	public function isUserLoggedIn() {
		return $this->app->session->containsData(SESSION_DATA_LOGGED_IN_USER_ID);
	}
	
	/*
	 * Logs in a user in the system.
	 * 
	 * It receives the user's ID.
	 */
	public function logInUser($userId) {
		$this->app->session->setData(SESSION_DATA_LOGGED_IN_USER_ID, $userId);
	}
	
	/*
	 * Logs out the logged in user from the system.
	 */
	public function logOutUser() {
		$this->app->session->clearData(SESSION_DATA_LOGGED_IN_USER_ID);
	}
	
}

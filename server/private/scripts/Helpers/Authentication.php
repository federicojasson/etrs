<?php

/*
 * This helper manages the authentication state.
 */
class Authentication extends Helper {
	
	/*
	 * Returns the logged in user.
	 */
	public function getLoggedInUser() {
		// Gets the logged in user's ID
		$loggedInUserId = $this->app->session->getData(SESSION_DATA_LOGGED_IN_USER_ID);
		
		// Gets and returns the logged in user
		return $this->app->data->getUser($loggedInUserId, ['mainData']);
	}
	
	/*
	 * Determines whether the user is logged in.
	 */
	public function isUserLoggedIn() {
		return $this->app->session->containsData(SESSION_DATA_LOGGED_IN_USER_ID);
	}
	
}

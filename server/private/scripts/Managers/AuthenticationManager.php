<?php

/*
 * This manager handles user authentication related tasks.
 */
class AuthenticationManager extends Manager {
	
	/*
	 * Returns the logged in user's ID.
	 */
	public function getLoggedInUserId() {
		return $this->app->session->get(SESSION_KEY_LOGGED_IN_USER_ID);
	}
	
	/*
	 * Determines whether the user is logged in.
	 */
	public function isUserLoggedIn() {
		return $this->app->session->contains(SESSION_KEY_LOGGED_IN_USER_ID);
	}
	
	/*
	 * Logs in a user.
	 * 
	 * It receives the user's ID.
	 */
	public function logInUser($userId) {
		$this->app->session->set(SESSION_KEY_LOGGED_IN_USER_ID, $userId);
	}
	
	/*
	 * Logs out the user.
	 */
	public function logOutUser() {
		$this->app->session->clear(SESSION_KEY_LOGGED_IN_USER_ID);
	}
	
}

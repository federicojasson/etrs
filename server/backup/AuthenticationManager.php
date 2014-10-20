<?php

/*
 * This class offers services to handle user authentication and other related
 * tasks, like login and logout.
 */
class AuthenticationManager {
	
	/*
	 * TODO
	 */
	private $businessDatabase;
	
	/*
	 * The session.
	 */
	private $session;
	
	/*
	 * Creates an instance of this class.
	 * It receives the session.
	 */
	public function __construct($businessDatabase, $session) {
		$this->businessDatabase = $businessDatabase;
		$this->session = $session;
	}
	
	/*
	 * TODO
	 */
	public function authenticateUser($id, $password) {
		$authenticationData = $this->businessDatabase->getUserAuthenticationData($id);
		
		if (is_null($authenticationData))
			return false;
		
		$passwordHash = hash_pbkdf2(PASSWORD_HASH_ALGORITHM, $password, $authenticationData->getSalt(), PASSWORD_KEY_STRETCHING_ITERATIONS, 0, true);
		
		return $passwordHash == $authenticationData->getPasswordHash();
	}
	
	/*
	 * Returns the logged in user.
	 * If the user hasn't been logged in, null is returned.
	 */
	public function getLoggedInUser() {
		return $this->session->get(SESSION_KEY_LOGGED_IN_USER);
	}
	
	/*
	 * Determines whether the user is logged in.
	 */
	public function isUserLoggedIn() {
		return $this->session->contains(SESSION_KEY_LOGGED_IN_USER);
	}
	
	/*
	 * Logs in a user.
	 */
	public function logInUser($user) {
		$this->session->set(SESSION_KEY_LOGGED_IN_USER, $user);
	}
	
	/*
	 * Logs out the user.
	 */
	public function logOutUser() {
		$this->session->clear(SESSION_KEY_LOGGED_IN_USER);
	}
	
}

<?php

/*
 * This class offers services to handle user authentication and other related
 * tasks, like login and logout.
 */
class AuthenticationManager {
	
	/*
	 * The business database where the users are registered.
	 */
	private $businessDatabase;
	
	/*
	 * The session.
	 */
	private $session;
	
	/*
	 * Creates an instance of this class.
	 * It receives the business database and the session.
	 */
	public function __construct($businessDatabase, $session) {
		$this->businessDatabase = $businessDatabase;
		$this->session = $session;
	}
	
	/*
	 * Authenticates a user.
	 * It receives the user ID and the password.
	 */
	public function authenticateUser($id, $password) {
		// Gets the user's authentication data
		$userDataObject = $this->businessDatabase->getUserAuthenticationData($id);
		
		if (is_null($userDataObject))
			// The user has not been found
			return false;
		
		// Hashes the received password using the salt of the user
		$passwordHash = hash_pbkdf2(PASSWORD_HASH_ALGORITHM, $password, $userDataObject->getSalt(), PASSWORD_KEY_STRETCHING_ITERATIONS, 0, true);
		
		// Compares the hash values and returns the outcome
		return $passwordHash == $userDataObject->getPasswordHash();
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
	 * It receives the user data object.
	 */
	public function logInUser($userDataObject) {
		$this->session->set(SESSION_KEY_LOGGED_IN_USER, $userDataObject);
	}
	
	/*
	 * Logs out the user.
	 */
	public function logOutUser() {
		$this->session->clear(SESSION_KEY_LOGGED_IN_USER);
	}
	
}

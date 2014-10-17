<?php

/*
 * This class offers services to handle user authentication and other related
 * tasks, like login and logout.
 */
class AuthenticationManager {
	
	/*
	 * The session.
	 */
	private $session;
	
	/*
	 * Creates an instance of this class.
	 * It receives the session.
	 */
	public function __construct($session) {
		$this->session = $session;
	}
	
	/*
	 * Returns the logged in user.
	 * If the user hasn't been logged in, null is returned.
	 */
	public function getLoggedInUser() {
		return $this->session->get('logged-in-user');
	}
	
	/*
	 * Determines whether the user is logged in.
	 */
	public function isUserLoggedIn() {
		return $this->session->contains('logged-in-user');
	}
	
	/*
	 * Logs in a user.
	 */
	public function logInUser($user) {
		$this->session->set('logged-in-user', $user);
	}
	
	/*
	 * Logs out the user.
	 */
	public function logOutUser() {
		$this->session->clear('logged-in-user');
	}
	
}

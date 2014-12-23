<?php

/*
 * This helper offers an interface to access the session.
 */
class Session extends Helper {
	
	/*
	 * Clears a data entry.
	 * 
	 * It receives the entry's key.
	 */
	public function clearData($entryKey) {
		unset($_SESSION[$entryKey]);
	}
	
	/*
	 * Determines whether a certain data entry exists.
	 * 
	 * It receives the entry's key.
	 */
	public function containsData($entryKey) {
		return isset($_SESSION[$entryKey]);
	}
	
	/*
	 * Destroys the session entirely. This includes its data and the client's
	 * cookie associated with it.
	 */
	public function destroy() {
		// Clears all the data entries
		$_SESSION = array();
		
		// Destroys the client's session cookie
		$this->destroySessionCookie();
		
		// Destroys the PHP session
		session_destroy();
	}
	
	/*
	 * Returns the value of a data entry.
	 * 
	 * It receives the entry's key.
	 */
	public function getData($entryKey) {
		return $_SESSION[$entryKey];
	}
	
	/*
	 * Sets the value of a data entry.
	 * 
	 * It receives the entry's key and the value to be set.
	 */
	public function setData($entryKey, $entryValue) {
		$_SESSION[$entryKey] = $entryValue;
	}
	
	/*
	 * Sets a session storage handler to manage the data persistence.
	 * 
	 * It receives the session storage handler.
	 */
	public function setStorageHandler($sessionStorageHandler) {
		session_set_save_handler(
			[ $sessionStorageHandler, 'onOpen' ],
			[ $sessionStorageHandler, 'onClose' ],
			[ $sessionStorageHandler, 'onRead' ],
			[ $sessionStorageHandler, 'onWrite' ],
			[ $sessionStorageHandler, 'onDestroy' ],
			[ $sessionStorageHandler, 'onGarbageCollection' ]
		);
	}
	
	/*
	 * Resumes the session or creates a new one.
	 */
	public function start() {
		// Starts the PHP session
		session_start();
	}
	
	/*
	 * Destroys the client's session cookie.
	 */
	private function destroySessionCookie() {
		$name = session_name();
		$value = ''; // This will clear the cookie's data
		$expire = time() - 42000; // This will expire the cookie immediately
		
		$cookieParameters = session_get_cookie_params();
		$path = $cookieParameters["path"];
		$domain = $cookieParameters["domain"];
		$secure = $cookieParameters["secure"];
		$httpOnly = $cookieParameters["httponly"];
		
		// Sends a new cookie to the client to override the old one
		setcookie($name, $value, $expire, $path, $domain, $secure, $httpOnly);
	}
	
}

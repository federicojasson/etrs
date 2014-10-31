<?php

/*
 * This manager offers an interface to access the PHP session.
 */
class SessionManager extends Manager {
	
	/*
	 * Removes an entry from the session data.
	 */
	public function clear($key) {
		unset($_SESSION[$key]);
	}
	
	/*
	 * Determines whether exists a certain entry in the session data.
	 */
	public function contains($key) {
		return isset($_SESSION[$key]);
	}
	
	/*
	 * Returns the value of a certain entry in the session data.
	 * If the entry doesn't exist, null is returned.
	 */
	public function get($key) {
		if (! $this->contains($key)) {
			// The entry doesn't exist
			return null;
		}
		
		return $_SESSION[$key];
	}
	
	/*
	 * Sets the value of a certain entry in the session data.
	 * If the entry already exists, its value is replaced.
	 */
	public function set($key, $value) {
		$_SESSION[$key] = $value;
	}
	
	/*
	 * Sets a storage handler to manage the data persistence process.
	 */
	public function setStorageHandler($storageHandler) {
		session_set_save_handler(
			[ $storageHandler, 'onOpen' ],
			[ $storageHandler, 'onClose' ],
			[ $storageHandler, 'onRead' ],
			[ $storageHandler, 'onWrite' ],
			[ $storageHandler, 'onDestroy' ],
			[ $storageHandler, 'onGarbageCollection' ]
		);
	}
	
	/*
	 * Resumes the PHP session or creates a new one.
	 */
	public function start() {
		session_start();
	}
	
}

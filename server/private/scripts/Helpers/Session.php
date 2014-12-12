<?php

/*
 * This helper offers an interface to access the PHP session.
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
	 * Resumes the PHP session or creates a new one.
	 */
	public function start() {
		session_start();
	}
	
}

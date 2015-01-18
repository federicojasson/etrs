<?php

namespace App\Helpers;

/*
 * This helper offers an interface to access the session.
 */
class Session extends \App\Helpers\Helper {
	
	/*
	 * Clears a data entry.
	 * 
	 * It receives the entry's key.
	 */
	public function clearData($key) {
		unset($_SESSION[$key]);
	}
	
	/*
	 * Determines whether a certain data entry exists.
	 * 
	 * It receives the entry's key.
	 */
	public function containsData($key) {
		return isset($_SESSION[$key]);
	}
	
	/*
	 * Destroys the session.
	 */
	public function destroy() {
		// Clears all the data entries
		$_SESSION = array();
		
		// Destroys the PHP session
		session_destroy();
	}
	
	/*
	 * Returns the value of a data entry.
	 * 
	 * It receives the entry's key.
	 */
	public function getData($key) {
		return $_SESSION[$key];
	}
	
	/*
	 * Sets the value of a data entry.
	 * 
	 * It receives the entry's key and the value to be set.
	 */
	public function setData($key, $value) {
		$_SESSION[$key] = $value;
	}
	
	/*
	 * Sets a storage handler to manage the data persistence.
	 * 
	 * It receives the storage handler.
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
	 * Resumes the session or creates a new one.
	 */
	public function start() {
		// Starts the PHP session
		session_start();
	}
	
}

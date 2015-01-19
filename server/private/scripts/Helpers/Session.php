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
	 * Returns the value of a data entry.
	 * 
	 * It receives the entry's key.
	 */
	public function getData($key) {
		return $_SESSION[$key];
	}
	
	/*
	 * Regenerates the session's ID.
	 * 
	 * This method doesn't clear the session's data.
	 */
	public function regenerateId() {
		// Regenerates the PHP session's ID
		session_regenerate_id(true);
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

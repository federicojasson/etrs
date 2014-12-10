<?php

/*
 * TODO: comments
 */
class Session extends Helper {
	
	/*
	 * Clears a data entry.
	 * 
	 * It receives the entry's key.
	 */
	public function clearData($key) {
		unset($_SESSION[$key]);
	}
	
	/*
	 * Returns the value of a data entry.
	 * 
	 * It receives the data's key.
	 */
	public function getData($key) {
		return $_SESSION[$key];
	}
	
	/*
	 * Sets the value of a data entry.
	 */
	public function setData($key, $value) {
		$_SESSION[$key] = $value;
	}
	
	/*
	 * Sets a storage handler to manage the data persistence.
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

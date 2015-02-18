<?php

namespace App\Helper;

/*
 * This helper offers an interface to interact with the session.
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
	 * Configures the generation of the session IDs.
	 * 
	 * It receives the hash function that will be used to generate the IDs and
	 * how many bits are stored in each character when the binary hash is
	 * converted to a readable format.
	 */
	public function configureIdsGeneration($hashFunction, $bitsPerCharacter) {
		ini_set('session.hash_function', $hashFunction);
		ini_set('session.hash_bits_per_character', $bitsPerCharacter);
	}
	
	/*
	 * Determines whether a certain data entry exists.
	 * 
	 * It receives the entry's key.
	 */
	public function containsData($key) {
		return array_key_exists($key, $_SESSION);
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
	 * Note that this method doesn't clear the session's data.
	 */
	public function regenerateId() {
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
		session_start();
	}
	
}

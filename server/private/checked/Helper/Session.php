<?php

namespace App\Helper;

/*
 * This helper offers an interface to interact with the session.
 */
class Session extends Helper {
	// TODO: implement methods
	
	/*
	 * Configures the generation of the session IDs.
	 * 
	 * It receives the hash function that should be used to generate the IDs and
	 * how many bits are stored in each character when the binary hash is
	 * converted to a readable format.
	 */
	public function configureIdsGeneration($hashFunction, $bitsPerCharacter) {
		ini_set('session.hash_function', $hashFunction);
		ini_set('session.hash_bits_per_character', $bitsPerCharacter);
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

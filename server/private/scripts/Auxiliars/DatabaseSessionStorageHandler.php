<?php

namespace App\Auxiliars;

/*
 * This class offers methods to manage the session's data persistence in a
 * database.
 * 
 * It implements the SessionStorageHandler interface.
 */
class DatabaseSessionStorageHandler implements \App\Auxiliars\SessionStorageHandler {
	
	/*
	 * The BusinessLogicDatabase helper.
	 */
	private $webServerDatabase;
	
	/*
	 * Creates an instance of this class.
	 * 
	 * It receives the BusinessLogicDatabase helper.
	 */
	public function __construct($webServerDatabase) {
		$this->webServerDatabase = $webServerDatabase;
	}
	
	/*
	 * Invoked when the session is closed.
	 * 
	 * It returns whether the operation succeeded.
	 */
	public function onClose() {
		// TODO: DatabaseSessionStorageHandler.php
	}
	
	/*
	 * Invoked when the session is destroyed or regenerated.
	 * 
	 * It returns whether the operation succeeded.
	 * 
	 * It receives the new session's ID, in case it is regenerated.
	 */
	public function onDestroy($id) {
		// TODO: DatabaseSessionStorageHandler.php
	}
	
	/*
	 * Invoked periodically in order to purge old sessions' data.
	 * 
	 * It returns whether the operation succeeded.
	 * 
	 * It receives the idle lifetime of a session.
	 */
	public function onGarbageCollection($idleLifetime) {
		// TODO: DatabaseSessionStorageHandler.php
	}
	
	/*
	 * Invoked when the session is being opened.
	 * 
	 * It returns whether the operation succeeded.
	 * 
	 * It receives the path where to save the session (for those cases where
	 * direct file management is necessary) and the session's name.
	 */
	public function onOpen($path, $name) {
		// TODO: DatabaseSessionStorageHandler.php
	}
	
	/*
	 * Invoked when the data of the session needs to be read.
	 * 
	 * It returns the session's serialized data, or an empty string if there is
	 * no data to read.
	 * 
	 * It receives the session's ID.
	 */
	public function onRead($id) {
		// TODO: DatabaseSessionStorageHandler.php
	}
	
	/*
	 * Invoked when the data of the session needs to be stored.
	 * 
	 * It returns whether the operation succeeded.
	 * 
	 * It receives the session's ID and its data.
	 */
	public function onWrite($id, $data) {
		// TODO: DatabaseSessionStorageHandler.php
	}
	
}

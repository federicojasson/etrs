<?php

namespace App\Auxiliars;

/*
 * This class offers methods to handle the session's data persistence using a
 * database.
 * 
 * It implements the SessionStorageHandler interface.
 */
class DatabaseSessionStorageHandler implements \App\Auxiliars\SessionStorageHandler {
	
	/*
	 * The application.
	 */
	private $app;
	
	/*
	 * Creates an instance of this class.
	 */
	public function __construct() {
		$this->app = \Slim\Slim::getInstance();
	}
	
	/*
	 * Invoked when the session is closed.
	 * 
	 * It returns whether the operation succeeded.
	 */
	public function onClose() {
		// There's nothing to do
		return true;
	}
	
	/*
	 * Invoked when the session is destroyed.
	 * 
	 * It returns whether the operation succeeded.
	 * 
	 * It receives the session's ID.
	 */
	public function onDestroy($id) {
		$app = $this->app;
		
		// Erases the session
		$app->webServerDatabase->eraseSession($id);
		
		return true;
	}
	
	/*
	 * Invoked periodically in order to purge old sessions' data.
	 * 
	 * It returns whether the operation succeeded.
	 * 
	 * It receives the idle lifetime in seconds of the session.
	 */
	public function onGarbageCollection($idleLifetime) {
		$app = $this->app;
		
		// Erases the idle sessions
		$app->webServerDatabase->eraseIdleSessions($idleLifetime);
		
		return true;
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
		// There's nothing to do
		return true;
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
		$app = $this->app;
		
		// Gets the session
		$session = $app->webServerDatabase->getSession($id);

		if (is_null($session)) {
			// The session doesn't exist
			return '';
		}

		// Returns the session's data
		return $session['data'];
	}
	
	/*
	 * Invoked when the data of the session needs to be written.
	 * 
	 * It returns whether the operation succeeded.
	 * 
	 * It receives the session's ID and its data.
	 */
	public function onWrite($id, $data) {
		$app = $this->app;
		
		// Creates or edits the session
		$app->webServerDatabase->createOrEditSession($id, $data);
		
		return true;
	}
	
}

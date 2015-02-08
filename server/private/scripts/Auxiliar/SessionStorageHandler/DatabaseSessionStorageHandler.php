<?php

namespace App\Auxiliar\SessionStorageHandler;

/*
 * This class offers methods to manage the session's data persistence using a
 * database.
 * 
 * Implements the SessionStorageHandler interface.
 */
class DatabaseSessionStorageHandler implements SessionStorageHandler {
	
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
		
		// Converts the ID to binary
		$id = hex2bin($id);
		
		// Deletes the session
		$app->data->session->delete($id);
		
		return true;
	}
	
	/*
	 * Invoked periodically in order to purge inactive sessions.
	 * 
	 * It returns whether the operation succeeded.
	 * 
	 * It receives the maximum time that a session can remain inactive (in
	 * seconds).
	 */
	public function onGarbageCollection($maximumInactiveTime) {
		$app = $this->app;
		
		// Deletes the inactive sessions
		$app->data->session->deleteInactives($maximumInactiveTime);
		
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
	 * It returns the session's data, or an empty string if there is no data to
	 * read.
	 * 
	 * It receives the session's ID.
	 */
	public function onRead($id) {
		$app = $this->app;
		
		// Converts the ID to binary
		$id = hex2bin($id);
		
		// Gets the session
		$session = $app->data->session->get($id);
		
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
	 * It receives the session's ID and data.
	 */
	public function onWrite($id, $data) {
		$app = $this->app;
		
		// Converts the ID to binary
		$id = hex2bin($id);
		
		// Creates or edits the session
		$app->data->session->createOrEdit($id, $data);
		
		return true;
	}
	
}

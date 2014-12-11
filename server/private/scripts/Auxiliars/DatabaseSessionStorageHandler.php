<?php

/*
 * This class offers methods to manage the session's data persistence in a
 * database. It implements the SessionStorageHandler interface.
 */
class DatabaseSessionStorageHandler implements SessionStorageHandler {
	
	/*
	 * The database where the session data is stored.
	 */
	private $database;
	
	/*
	 * Creates an instance of this class.
	 */
	public function __construct($database) {
		$this->database = $database;
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
	 * Invoked when the session is destroyed or regenerated.
	 * 
	 * It receives the new session's ID, in case it is regenerated.
	 * 
	 * It returns whether the operation succeeded.
	 */
	public function onDestroy($sessionId) {
		// Deletes the session from the database
		$this->database->deleteSession($sessionId);
		
		return true;
	}
	
	/*
	 * Invoked periodically in order to purge old sessions' data.
	 * 
	 * It receives the idle lifetime of the sessions.
	 * 
	 * It returns whether the operation succeeded.
	 */
	public function onGarbageCollection($idleLifetime) {
		// Deletes the expired sessions from the database
		$this->database->deleteExpiredSessions(SESSION_IDLE_LIFETIME);
		
		return true;
	}
	
	/*
	 * Invoked when the session is being opened.
	 * 
	 * It receives the path where to save the session (for those cases where
	 * direct file management is necessary) and the session's name.
	 * 
	 * It returns whether the operation succeeded.
	 */
	public function onOpen($savePath, $sessionName) {
		// There's nothing to do
		return true;
	}
	
	/*
	 * Invoked when the data of the session needs to be read.
	 * 
	 * It receives the session's ID.
	 * 
	 * It returns the session's serialized data, or an empty string if there is
	 * no data to read.
	 */
	public function onRead($sessionId) {
		// Selects the session in the database
		$session = $this->database->selectSession($sessionId);

		if (is_null($session)) {
			// The session doesn't exist
			return '';
		}

		// Returns the session's data
		return $session['data'];
	}
	
	/*
	 * Invoked when the data of the session needs to be stored.
	 * 
	 * It receives the session's ID and its data.
	 * 
	 * It returns whether the operation succeeded.
	 */
	public function onWrite($sessionId, $sessionData) {
		// Inserts or updates the session in the database
		$this->database->insertOrUpdateSession($sessionId, $sessionData);
		
		return true;
	}
	
}

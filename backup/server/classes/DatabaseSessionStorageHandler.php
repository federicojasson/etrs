<?php

/*
 * This class offers methods to handle the session storage process in a
 * database.
 */
class DatabaseSessionStorageHandler implements SessionStorageHandler {
	
	/*
	 * The server database where the session information is stored.
	 */
	private $serverDatabase;
	
	/*
	 * Creates an instance of this class.
	 * It receives the server database.
	 */
	public function __construct($serverDatabase) {
		$this->serverDatabase = $serverDatabase;
	}
	
	/*
	 * It doesn't do anything.
	 */
	public function onClose() {
		return true;
	}

	/*
	 * Removes the session data from the database.
	 */
	public function onDestroy($sessionId) {
		try {
			$this->serverDatabase->deleteSession($sessionId);
			return true;
		} catch (Exception $exception) {
			// An error occurred
			return false;
		}
	}

	/*
	 * Removes old session data from the database.
	 */
	public function onGc($lifetime) {
		try {
			$this->serverDatabase->deleteExpiredSessions($lifetime);
			return true;
		} catch (Exception $exception) {
			// An error occurred
			return false;
		}
	}

	/*
	 * It doesn't do anything.
	 */
	public function onOpen($savePath, $sessionName) {
		return true;
	}

	/*
	 * Reads the session data from the database.
	 */
	public function onRead($sessionId) {
		// Calls the session garbage collector to ensure that the session is not
		// expired before reading its data
		$lifetime = ini_get(PHP_DIRECTIVE_SESSION_LIFETIME);
		$this->onGc($lifetime);
		
		try {
			$sessionDataObject = $this->serverDatabase->getSessionData($sessionId);

			if (is_null($sessionDataObject))
				// The session has not been found
				return '';
			
			return $sessionDataObject->getData();
		} catch (Exception $exception) {
			// An error occurred
			return '';
		}
	}

	/*
	 * Writes the session data in the database.
	 */
	public function onWrite($sessionId, $data) {
		try {
			$this->serverDatabase->insertOrUpdateSession($sessionId, $data);
			return true;
		} catch (Exception $exception) {
			// An error occurred
			return false;
		}
	}

}

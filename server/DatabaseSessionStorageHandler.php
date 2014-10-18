<?php

/*
 * This class offers methods to handle the session storage process in a
 * database.
 */
class DatabaseSessionStorageHandler implements SessionStorageHandler {
	
	/*
	 * TODO
	 */
	private $etrsServerDatabase;
	
	/*
	 * TODO
	 */
	public function __construct($etrsServerDatabase) {
		$this->etrsServerDatabase = $etrsServerDatabase;
	}
	
	/*
	 * Closes the connection with the DBMS.
	 */
	public function onClose() {
		return true;
	}

	/*
	 * Removes the session data from the database.
	 */
	public function onDestroy($sessionId) {
		try {
			$this->etrsServerDatabase->deleteSession($sessionId);
			return true;
		} catch (Exception $exception) {
			return false;
		}
	}

	/*
	 * Removes old session data from the database.
	 */
	public function onGc($lifetime) {
		try {
			$this->etrsServerDatabase->deleteExpiredSessions($lifetime);
			return true;
		} catch (Exception $exception) {
			return false;
		}
	}

	/*
	 * Opens a connection with the DBMS.
	 */
	public function onOpen($savePath, $sessionName) {
		return true;
	}

	/*
	 * Reads the session data from the database.
	 */
	public function onRead($sessionId) {
		// Calls the session garbage collector to ensure that the session isn't
		// expired before getting its data
		$lifetime = ini_get('session.gc_maxlifetime');
		$this->onGc($lifetime);
		
		try {
			$sessionData = $this->etrsServerDatabase->getSessionData($sessionId);

			if (is_null($sessionData))
				return '';
			
			return $sessionData;
		} catch (Exception $exception) {
			return '';
		}
	}

	/*
	 * Writes the session data in the database.
	 */
	public function onWrite($sessionId, $data) {
		try {
			$this->etrsServerDatabase->insertOrUpdateSession($sessionId, $data);
			return true;
		} catch (Exception $exception) {
			return false;
		}
	}

}

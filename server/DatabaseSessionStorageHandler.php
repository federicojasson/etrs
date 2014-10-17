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
		// TODO
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
		echo 'onGc<br>';
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
		// TODO
		return true;
	}

	/*
	 * Reads the session data from the database.
	 */
	public function onRead($sessionId) {
		try {
			$sessionData = $this->etrsServerDatabase->getSessionData($sessionId);

			if (! is_null($sessionData))
				return $sessionData;
			else
				return '';
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

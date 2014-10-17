<?php

/*
 * This class offers methods to handle the session storage process in a
 * database.
 */
class DatabaseSessionStorageHandler implements SessionStorageHandler {
	
	/*
	 * Closes the connection with the DBMS.
	 */
	public function onClose() {
		// TODO
		return true;
	}

	/*
	 * Deletes the session data from the database.
	 */
	public function onDestroy($sessionId) {
		// TODO
		return true;
	}

	/*
	 * Deletes old session data from the database.
	 */
	public function onGc($lifetime) {
		// TODO
		return true;
	}

	/*
	 * Opens a connection with the DBMS.
	 */
	public function onOpen($savePath, $sessionName) {
		// TODO
		return true;
	}

	/*
	 * Read the session data from the database.
	 */
	public function onRead($sessionId) {
		// TODO
		return true;
	}

	/*
	 * Writes the session data in the database.
	 */
	public function onWrite($sessionId, $data) {
		// TODO
		return true;
	}

}

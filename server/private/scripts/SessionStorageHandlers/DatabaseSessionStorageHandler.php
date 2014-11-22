<?php

/*
 * This class offers methods to handle the session storage process in a
 * database. It implements the session storage handler interface.
 */
class DatabaseSessionStorageHandler implements SessionStorageHandler {
	
	/*
	 * TODO: comments
	 */
	public function onClose() {
		return true;
	}
	
	/*
	 * TODO: comments
	 */
	public function onDestroy($sessionId) {
		try {
			// Deletes the session from the database
			$this->app->webServerDatabase->deleteSession($sessionId);
			
			return true;
		} catch (Exception $exception) {
			return false;
		}
	}
	
	/*
	 * TODO: comments
	 */
	public function onGarbageCollection($idleLifetime) {
		try {
			// Deletes the expired sessions from the database
			$this->app->webServerDatabase->deleteExpiredSessions($idleLifetime);
			
			return true;
		} catch (Exception $exception) {
			return false;
		}
	}
	
	/*
	 * TODO: comments
	 */
	public function onOpen($savePath, $sessionName) {
		return true;
	}
	
	/*
	 * TODO: comments
	 */
	public function onRead($sessionId) {
		try {
			// TODO: implement
			$sessionData = $this->app->webServerDatabase->getSessionData($sessionId);
			
			if (is_null($sessionData)) {
				return '';
			}
			
			return $sessionData;
		} catch (Exception $exception) {
			return '';
		}
	}
	
	/*
	 * TODO: comments
	 */
	public function onWrite($sessionId, $sessionData) {
		try {
			// TODO: implement
			$this->app->webServerDatabase->insertOrUpdateSession($sessionId, $sessionData);
			return true;
		} catch (Exception $exception) {
			return false;
		}
	}
	
}

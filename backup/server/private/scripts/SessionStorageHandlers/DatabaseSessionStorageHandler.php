<?php

/*
 * This class offers methods to handle the session storage process in a
 * database. It implements the session storage handler interface.
 */
class DatabaseSessionStorageHandler implements SessionStorageHandler {
	
	/*
	 * TODO
	 */
	public function onClose() {
		return true;
	}
	
	/*
	 * TODO
	 */
	public function onDestroy($sessionId) {
		// TODO
	}
	
	/*
	 * TODO
	 */
	public function onGarbageCollection($idleLifetime) {
		// TODO
	}
	
	/*
	 * TODO
	 */
	public function onOpen($savePath, $sessionName) {
		return true;
	}
	
	/*
	 * TODO
	 */
	public function onRead($sessionId) {
		// TODO
	}
	
	/*
	 * TODO
	 */
	public function onWrite($sessionId, $sessionData) {
		// TODO
	}
	
}
<?php

/*
 * This interface offers methods to handle the session storage process.
 */
interface SessionStorageHandler {
	
	/*
	 * Invoked when the session is closed.
	 * 
	 * It returns whether the operation succeeded.
	 */
	public function onClose();
	
	/*
	 * Invoked when the session is destroyed or regenerated.
	 * 
	 * It receives the new session ID for the regeneration case.
	 * 
	 * It returns whether the operation succeeded.
	 */
	public function onDestroy($sessionId);
	
	/*
	 * Invoked periodically in order to purge old session data.
	 * 
	 * It receives the idle lifetime of the session data.
	 * 
	 * It returns whether the operation succeeded.
	 */
	public function onGarbageCollection($idleLifetime);
	
	/*
	 * Invoked when the session is being opened.
	 * 
	 * It receives the path where to save the session files (for those cases
	 * where direct file management is necessary) and the session name.
	 * 
	 * It returns whether the operation succeeded.
	 */
	public function onOpen($savePath, $sessionName);
	
	/*
	 * Invoked when the session data needs to be read.
	 * 
	 * It receives the session ID.
	 * 
	 * It returns the serialized session data, or an empty string if there is no
	 * data to read.
	 */
	public function onRead($sessionId);
	
	/*
	 * Invoked when the session data needs to be written.
	 * 
	 * It receives the session ID and the data.
	 * 
	 * It returns whether the operation succeeded.
	 */
	public function onWrite($sessionId, $sessionData);
	
}

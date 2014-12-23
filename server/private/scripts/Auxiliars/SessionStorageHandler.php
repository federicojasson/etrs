<?php

/*
 * This interface offers methods to manage the session's data persistence.
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
	 * It receives the new session's ID, in case it is regenerated.
	 * 
	 * It returns whether the operation succeeded.
	 */
	public function onDestroy($sessionId);
	
	/*
	 * Invoked periodically in order to purge old sessions' data.
	 * 
	 * It receives the idle lifetime of a session.
	 * 
	 * It returns whether the operation succeeded.
	 */
	public function onGarbageCollection($sessionIdleLifetime);
	
	/*
	 * Invoked when the session is being opened.
	 * 
	 * It receives the path where to save the session (for those cases where
	 * direct file management is necessary) and the session's name.
	 * 
	 * It returns whether the operation succeeded.
	 */
	public function onOpen($path, $sessionName);
	
	/*
	 * Invoked when the data of the session needs to be read.
	 * 
	 * It receives the session's ID.
	 * 
	 * It returns the session's serialized data, or an empty string if there is
	 * no data to read.
	 */
	public function onRead($sessionId);
	
	/*
	 * Invoked when the data of the session needs to be stored.
	 * 
	 * It receives the session's ID and its data.
	 * 
	 * It returns whether the operation succeeded.
	 */
	public function onWrite($sessionId, $sessionData);
	
}

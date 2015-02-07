<?php

namespace App\Auxiliar\SessionStorageHandler;

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
	 * Invoked when the session is destroyed.
	 * 
	 * It returns whether the operation succeeded.
	 * 
	 * It receives the session's ID.
	 */
	public function onDestroy($id);
	
	/*
	 * Invoked periodically in order to purge inactive sessions.
	 * 
	 * It returns whether the operation succeeded.
	 * 
	 * It receives the maximum time that a session can remain inactive (in
	 * seconds).
	 */
	public function onGarbageCollection($maximumInactiveTime);
	
	/*
	 * Invoked when the session is being opened.
	 * 
	 * It returns whether the operation succeeded.
	 * 
	 * It receives the path where to save the session (for those cases where
	 * direct file management is necessary) and the session's name.
	 */
	public function onOpen($path, $name);
	
	/*
	 * Invoked when the data of the session needs to be read.
	 * 
	 * It returns the session's data, or an empty string if there is no data to
	 * read.
	 * 
	 * It receives the session's ID.
	 */
	public function onRead($id);
	
	/*
	 * Invoked when the data of the session needs to be written.
	 * 
	 * It returns whether the operation succeeded.
	 * 
	 * It receives the session's ID and data.
	 */
	public function onWrite($id, $data);
	
}
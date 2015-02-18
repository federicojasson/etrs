<?php

namespace App\Controller;

/*
 * This class encapsulates the logic of a synchronized internal service.
 * 
 * Subclasses must implement the getLockFilePath function to define the path of
 * the file used as lock.
 */
abstract class SynchronizedInternalController extends InternalController {
	
	/*
	 * Serves the request.
	 */
	public function serveRequest() {
		// Gets the path of the lock file
		$path = $this->getLockFilePath();
		
		// Opens the file
		$file = fopen($path, 'c');

		// Acquires the lock (or waits until it is released)
		flock($file, LOCK_EX);
		
		// Invokes the parent's function
		parent::serveRequest();
		
		// Releases the lock
		flock($file, LOCK_UN);
	}
	
	/*
	 * Returns the path of the file used as lock.
	 */
	protected abstract function getLockFilePath();
	
}

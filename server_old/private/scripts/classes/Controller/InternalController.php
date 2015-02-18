<?php

namespace App\Controller;

/* 
 * This class encapsulates the logic of an internal service.
 * 
 * Subclasses must implement the call function.
 */
abstract class InternalController extends Controller {
	
	/*
	 * Serves the request.
	 */
	public function serveRequest() {
		// Calls the controller
		$this->call();
	}
	
	/*
	 * Calls the controller.
	 */
	protected abstract function call();
	
}

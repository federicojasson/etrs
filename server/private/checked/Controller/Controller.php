<?php

namespace App\Controller;

/*
 * This class encapsulates the logic of a service.
 * 
 * Subclasses must implement the serveRequest function.
 */
abstract class Controller {
	
	/*
	 * The application.
	 */
	protected $app;
	
	/*
	 * Creates an instance of this class.
	 */
	public function __construct() {
		$this->app = \Slim\Slim::getInstance();
	}
	
	/*
	 * Serves the request.
	 */
	public abstract function serveRequest();
	
}

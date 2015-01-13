<?php

namespace App\Helpers;

/*
 * This class represents a helper. Helpers are singletons that offer very
 * specific functionalities.
 * 
 * Subclasses must implement the helper's logic. Optionally, an initialization
 * function can be overridden to perform bootstrapping tasks.
 */
abstract class Helper {
	
	/*
	 * The application.
	 */
	protected $app;
	
	/*
	 * Creates an instance of this class.
	 */
	public function __construct() {
		$this->app = \Slim\Slim::getInstance();
		
		// Initializes the helper
		$this->initialize();
	}
	
	/*
	 * Performs initialization tasks.
	 */
	protected function initialize() {}
	
}

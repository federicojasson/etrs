<?php

namespace App\Helper;

/*
 * This class represents a helper. Helpers are singletons that offer very
 * specific functionalities.
 * 
 * Subclasses can, optionally, override the initialize function to perform
 * initialization tasks.
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
	protected function initialize() {
		// By default, no initialization tasks need to be performed
	}
	
}

<?php

/*
 * This class represents a helper of the application. Helpers are singletons
 * that offer very specific functionalities.
 * 
 * Subclasses must implement the helper's logic. Optionally, the initialize
 * function can be overridden to execute initialization tasks.
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
		$this->initialize();
	}
	
	/*
	 * Performs initialization tasks.
	 */
	protected function initialize() {}
	
}

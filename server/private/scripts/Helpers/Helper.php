<?php

/*
 * This class represents a helper of the application. Helpers are singletons
 * that offer very specific functionalities.
 * 
 * Subclasses must implement the helper's logic.
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
	}
	
}

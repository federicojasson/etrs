<?php

/*
 * This class represents a manager of the application. Managers are singletons
 * that offer very specific functionalities.
 * 
 * Subclasses must implement the manager's logic.
 */
abstract class Manager {
	
	/*
	 * The app.
	 */
	protected $app;
	
	/*
	 * Creates an instance of this class.
	 */
	protected function __construct() {
		$this->app = \Slim\Slim::getInstance();
	}
	
}

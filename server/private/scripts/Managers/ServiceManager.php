<?php

/*
 * This manager allows to define and configure the server services.
 * 
 * A service is defined by its URL, the HTTP method through which it is invoked
 * and the controller that serves the requests.
 */
class ServiceManager extends Manager {
	
	/*
	 * Defines a service.
	 * 
	 * It receives the service URL, the HTTP method and the controller
	 * responsible for handling the requests.
	 */
	public function define($url, $method, $controller) {
		$this->app->map($url, function() use ($controller) {
			// Calls the controller to serve the request
			$controller->call();
		})->via($method);
	}
	
}

<?php

/*
 * This helper allows to define and configure the services of the server.
 * 
 * A service is defined by its URL, the HTTP method through which it is invoked
 * and the controller that serves the requests.
 */
class Services extends Helper {
	
	/*
	 * Defines a service.
	 * 
	 * It receives the service URL, the HTTP method and the controller
	 * responsible for handling the requests.
	 */
	public function define($url, $method, $controller) {
		// Defines the routing rule for the service
		$this->app->map($url, function() use ($controller) {
			// Serves the request through the controller
			$controller->serve();
		})->via($method);
	}
	
}

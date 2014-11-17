<?php

/*
 * This manager allows to define and configure the application services.
 * 
 * // TODO: check spelling
 * In order to handle the requests, controllers must be bound to the services.
 */
class ServiceManager extends Manager {
	
	/*
	 * Defines a service.
	 * 
	 * It receives the service route, the HTTP method and the controller
	 * responsible for handling the requests.
	 */
	public function define($route, $method, $controller) {
		// TODO: method
		
		$this->app->post($route, function() use ($controller) {
			// Calls the controller to serve the POST request
			$controller->call();
		});
	}
	
}

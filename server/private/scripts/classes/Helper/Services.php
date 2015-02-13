<?php

namespace App\Helper;

/*
 * This helper allows to define services.
 * 
 * A service is defined by a URL, the HTTP method through which it is invoked
 * and the controller that serves the requests.
 */
class Services extends Helper {
	
	/*
	 * Defines a service.
	 * 
	 * It receives the service's URL, the HTTP method and the controller
	 * responsible for handling the requests.
	 */
	public function define($url, $method, $controller) {
		$app = $this->app;
		
		// Defines the routing rule for the service
		$app->map($url, function() use ($controller) {
			// Serves the request using the controller
			$controller->serveRequest();
		})->via($method);
	}
	
}

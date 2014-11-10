<?php

/*
 * This manager takes care of the route-controller binding, allowing to easily
 * associate a controller with a certain service route.
 * 
 * It must be pointed out that the manager defines only POST services.
 */
class ControllerManager extends Manager {
	
	/*
	 * Binds controllers with routes belonging to a certain group.
	 * 
	 * It receives the route group and an associative array containing
	 * route-controller pairs.
	 */
	public function bind($routeGroup, $controllers) {
		$this->app->group($routeGroup, function() use ($controllers) {
			// Defines the services in the route group
			foreach ($controllers as $route => $controller) {
				$this->defineService($route, $controller);
			}
		});
	}
	
	/*
	 * It defines a service in a route handled by a certain controller.
	 * 
	 * The service defined by this method accepts only POST requests.
	 */
	private function defineService($route, $controller) {
		$this->app->post($route, function() use ($controller) {
			// Calls the controller to serve the POST request
			$controller->call();
		});
	}
	
}

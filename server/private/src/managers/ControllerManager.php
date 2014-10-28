<?php

/*
 * This manager takes care of the route-controller binding, allowing to easily
 * associate a controller with a certain service route.
 */
class ControllerManager {
	
	/*
	 * Binds controllers with routes belonging to a certain group.
	 * It receives the route group and an associative array containing
	 * route-controller pairs.
	 */
	public function bindControllers($routeGroup, $controllers) {
		// Gets the app
		$app = \Slim\Slim::getInstance();
		
		// Binds the controllers with the route group
		$app->group($routeGroup, function() use ($controllers) {
			foreach ($controllers as $route => $controller) {
				$this->bindController($route, $controller);
			}
		});
	}
	
	/*
	 * Binds a controller with a certain route.
	 */
	private function bindController($route, $controller) {
		// Gets the app
		$app = \Slim\Slim::getInstance();
		
		// Binds the controller with the route
		$app->post($route, function() use ($controller) {
			$controller->call();
		});
	}
	
}

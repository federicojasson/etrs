<?php

/*
 * TODO
 */
class RouteMiddleware extends \Slim\Middleware {
	
	/*
	 * TODO
	 */
	public function call() {
		// Gets the app
		$app = $this->app;
		
		// Hooks some functionality before the dispatch
		$app->hook('slim.before.dispatch', function() use ($app) {
			// Gets the requested route
			$route = $app->router()->getCurrentRoute()->getPattern();
			
			// Executes the actions associated with the route
			$app->routeManager->executeRouteActions($route);
		});
		
		// Calls the next middleware
		$this->next->call();
	}
	
}

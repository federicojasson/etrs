<?php

/*
 * TODO
 */
class AuthorizationMiddleware extends \Slim\Middleware {
	
	/*
	 * TODO
	 */
	public function call() {
		// Gets the app
		$app = $this->app;
		
		// TODO
		$app->hook('slim.before.dispatch', function() use ($app) {
			// Gets the requested route
			$route = $app->router()->getCurrentRoute()->getPattern();

			$userRoleRouteGroups = [
				USER_ROLE_DOCTOR => ROUTE_GROUP_DOCTOR,
				USER_ROLE_OPERATOR => ROUTE_GROUP_OPERATOR,
				USER_ROLE_RESEARCHER => ROUTE_GROUP_RESEARCHER
			];
			
			foreach ($userRoleRouteGroups as $userRole => $routeGroup)
				if ($this->belongsToRouteGroup($route, $routeGroup)) {
					$this->checkLoggedInUserRole($userRole);
					return;
				}
		});
		
		// Calls the next middleware
		$this->next->call();
	}
	
	/*
	 * TODO
	 */
	private function belongsToRouteGroup($route, $routeGroup) {
		return substr($route, 0, strlen($routeGroup)) === $routeGroup;
	}
	
	/*
	 * TODO
	 */
	private function checkLoggedInUserRole($userRole) {
		// Gets the app
		$app = $this->app;
		
		// Gets the authentication manager
		$authenticationManager = $app->authenticationManager;
		
		if (! $authenticationManager->isUserLoggedIn())
			// The user is not logged in
			$app->halt(HTTP_STATUS_UNAUTHORIZED);
		
		if ($authenticationManager->getLoggedInUser()->getRole() !== $userRole)
			// The logged in user doesn't have the expected role
			$app->halt(HTTP_STATUS_UNAUTHORIZED);
	}
	
}

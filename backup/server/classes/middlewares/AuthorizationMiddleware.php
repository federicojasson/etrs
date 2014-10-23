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
		
		// Hooks some functionality before the dispatch
		$app->hook('slim.before.dispatch', function() use ($app) {
			// Gets the route manager
			$routeManager = $app->routeManager;
			
			// Checks if the user is authorized to proceed according to its role
			// and the route group
			
			// Anonymous services are accessible by all users
			
			$routeManager->addGroupAction(ROUTE_GROUP_DOCTOR, function() {
				$this->checkLoggedInUserRole(USER_ROLE_DOCTOR);
			});
			
			$routeManager->addGroupAction(ROUTE_GROUP_OPERATOR, function() {
				$this->checkLoggedInUserRole(USER_ROLE_OPERATOR);
			});
			
			$routeManager->addGroupAction(ROUTE_GROUP_RESEARCHER, function() {
				$this->checkLoggedInUserRole(USER_ROLE_RESEARCHER);
			});
		});
		
		// Calls the next middleware
		$this->next->call();
	}
	
	/*
	 * TODO
	 */
	private function checkLoggedInUserRole($role) {
		// Gets the app
		$app = $this->app;
		
		// Gets the authentication manager
		$authenticationManager = $app->authenticationManager;
		
		if (! $authenticationManager->isUserLoggedIn()) {
			// The user is not logged in
			$app->halt(HTTP_STATUS_UNAUTHORIZED);
		}
		
		if ($authenticationManager->getLoggedInUser()->getRole() !== $role) {
			// The logged in user doesn't have the authorized role
			$app->halt(HTTP_STATUS_FORBIDDEN);
		}
	}
	
}

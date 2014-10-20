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
			
			$routeGroupActions = [
				ROUTE_GROUP_DOCTOR => 'onDoctor',
				ROUTE_GROUP_OPERATOR => 'onOperator',
				ROUTE_GROUP_RESEARCHER => 'onResearcher'
			];
			
			foreach ($routeGroupActions as $routeGroup => $function)
				if ($this->belongsToRouteGroup($route, $routeGroup)) {
					call_user_func($function);
					return;
				}
			
			$this->onAnonymous();
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
	
	/*
	 * TODO
	 */
	private function connect($userName, $password) {
		// Gets the business database
		$businessDatabase = $this->app->businessDatabase;
		
		$businessDatabase->connect($userName, $password);
	}
	
	/*
	 * TODO
	 */
	private function onAnonymous() {
		$this->connect('etrs_anonymous', 'password'); // TODO
	}
	
	/*
	 * TODO
	 */
	private function onDoctor() {
		$this->checkLoggedInUserRole(USER_ROLE_DOCTOR);
		$this->connect('etrs_doctor', 'password'); // TODO
	}
	
	/*
	 * TODO
	 */
	private function onOperator() {
		$this->checkLoggedInUserRole(USER_ROLE_OPERATOR);
		$this->connect('etrs_operator', 'password'); // TODO
	}
	
	/*
	 * TODO
	 */
	private function onResearcher() {
		$this->checkLoggedInUserRole(USER_ROLE_RESEARCHER);
		$this->connect('etrs_researcher', 'password'); // TODO
	}
	
}

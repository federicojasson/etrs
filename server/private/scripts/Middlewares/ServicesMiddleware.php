<?php

/*
 * This middleware defines the services of the application.
 */
class ServicesMiddleware extends \Slim\Middleware {
	
	/*
	 * Executes the middleware.
	 */
	public function call() {
		// Defines the services
		$this->defineServices();
		
		// Calls the next middleware
		$this->next->call();
	}
	
	/*
	 * Defines the services.
	 */
	private function defineServices() {
		$services = $this->app->services;
		
		// URL:		/server/get-authentication-state
		// Method:	POST
		$services->define(
			'/get-authentication-state',
			HTTP_METHOD_POST,
			new GetAuthenticationStateController()
		);

		// URL:		/server/log-in
		// Method:	POST
		$services->define(
			'/log-in',
			HTTP_METHOD_POST,
			new LogInController()
		);

		// URL:		/server/log-out
		// Method:	POST
		$services->define(
			'/log-out',
			HTTP_METHOD_POST,
			new LogOutController()
		);
	}
	
}

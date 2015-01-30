<?php

namespace App\Middlewares;

/*
 * This middleware defines the services.
 */
class Services extends \Slim\Middleware {
	
	/*
	 * Calls the middleware.
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
		$app = $this->app;
		
		/*// URL:		/server/account/change-password
		// Method:	POST
		$app->services->define(
			'/account/change-password',
			HTTP_METHOD_POST,
			new \App\Controllers\Account\ChangePassword()
		);*/
	}
	
}

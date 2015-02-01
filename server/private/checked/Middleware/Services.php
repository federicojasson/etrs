<?php

namespace App\Middleware;

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
		
		// Defines the services
		
		// TODO: remove this service
		// URL:		/server/account/edit
		// Method:	POST
		/*$app->services->define(
			'/account/edit',
			'POST',
			new \App\Controller\Account\Edit()
		);*/
	}
	
}

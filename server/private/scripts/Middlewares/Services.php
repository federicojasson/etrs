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
		
		// URL:		/server/authentication/get-state
		// Method:	POST
		$app->services->define(
			'/authentication/get-state',
			HTTP_METHOD_POST,
			new \App\Controllers\Authentication\GetState()
		);
		
		// URL:		/server/authentication/sign-in
		// Method:	POST
		$app->services->define(
			'/authentication/sign-in',
			HTTP_METHOD_POST,
			new \App\Controllers\Authentication\SignIn()
		);
		
		// URL:		/server/authentication/sign-out
		// Method:	POST
		$app->services->define(
			'/authentication/sign-out',
			HTTP_METHOD_POST,
			new \App\Controllers\Authentication\SignOut()
		);
		
		// URL:		/server/experiments/create
		// Method:	POST
		$app->services->define(
			'/experiments/create',
			HTTP_METHOD_POST,
			new \App\Controllers\Experiments\Create()
		);
		
		// URL:		/server/experiments/edit
		// Method:	POST
		$app->services->define(
			'/experiments/edit',
			HTTP_METHOD_POST,
			new \App\Controllers\Experiments\Edit()
		);
		
		// URL:		/server/experiments/erase
		// Method:	POST
		$app->services->define(
			'/experiments/erase',
			HTTP_METHOD_POST,
			new \App\Controllers\Experiments\Erase()
		);
		
		// URL:		/server/experiments/get
		// Method:	POST
		$app->services->define(
			'/experiments/get',
			HTTP_METHOD_POST,
			new \App\Controllers\Experiments\Get()
		);
		
		// URL:		/server/experiments/search
		// Method:	POST
		$app->services->define(
			'/experiments/search',
			HTTP_METHOD_POST,
			new \App\Controllers\Experiments\Search()
		);
		
		// URL:		/server/patients/get
		// Method:	POST
		$app->services->define(
			'/patients/get',
			HTTP_METHOD_POST,
			new \App\Controllers\Patients\Get()
		);
		
		// URL:		/server/users/get
		// Method:	POST
		$app->services->define(
			'/users/get',
			HTTP_METHOD_POST,
			new \App\Controllers\Users\Get()
		);
	}
	
}

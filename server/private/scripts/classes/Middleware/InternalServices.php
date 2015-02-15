<?php

namespace App\Middleware;

/*
 * This middleware defines the internal services.
 */
class InternalServices extends \Slim\Middleware {

	/*
	 * Calls the middleware.
	 */
	public function call() {
		// Defines the internal services
		$this->defineInternalServices();

		// Calls the next middleware
		$this->next->call();
	}

	/*
	 * Defines the internal services.
	 */
	private function defineInternalServices() {
		$app = $this->app;

		// Defines the internal services

		// TODO: method?
		// URI:		/server/log/delete-old
		// Method:	POST
		$app->services->define(
			'/log/delete-old',
			'POST',
			new \App\Controller\Log\DeleteOld()
		);
	}

}

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

		// URI:		/server/log/delete-old
		// Method:	POST
		$app->services->define(
			'/log/delete-old',
			'POST',
			new \App\Controller\Log\DeleteOld()
		);

		// URI:		/server/recover-password-permission/delete-old
		// Method:	POST
		$app->services->define(
			'/recover-password-permission/delete-old',
			'POST',
			new \App\Controller\RecoverPasswordPermission\DeleteOld()
		);

		// URI:		/server/session/delete-inactive
		// Method:	POST
		$app->services->define(
			'/session/delete-inactive',
			'POST',
			new \App\Controller\Session\DeleteInactive()
		);

		// URI:		/server/sign-up-permission/delete-old
		// Method:	POST
		$app->services->define(
			'/sign-up-permission/delete-old',
			'POST',
			new \App\Controller\SignUpPermission\DeleteOld()
		);

		// URI:		/server/study/conduct-oldest-pending
		// Method:	POST
		$app->services->define(
			'/study/conduct-oldest-pending',
			'POST',
			new \App\Controller\Study\ConductOldestPending()
		);
	}

}

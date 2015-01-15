<?php

namespace App\Middlewares;

/*
 * This middleware defines the error handlers.
 */
class ErrorHandlers extends \Slim\Middleware {
	
	/*
	 * Calls the middleware.
	 */
	public function call() {
		// Defines the error handlers
		$this->defineErrorHandlers();
		
		// Calls the next middleware
		$this->next->call();
	}
	
	/*
	 * Invoked when an error occurs.
	 */
	public function onError() {
		$app = $this->app;
		
		$app->halt(HTTP_STATUS_INTERNAL_SERVER_ERROR, [
			'error' => ERROR_UNEXPECTED_ERROR
		]);
	}
	
	/*
	 * Invoked when the requested service is not defined.
	 */
	public function onNotFound() {
		$app = $this->app;
		
		$app->halt(HTTP_STATUS_NOT_FOUND, [
			'error' => ERROR_UNDEFINED_SERVICE
		]);
	}
	
	/*
	 * Defines the error handlers.
	 */
	private function defineErrorHandlers() {
		$app = $this->app;
		
		$app->error([ $this, 'onError' ]);
		$app->notFound([ $this, 'onNotFound' ]);
	}
	
}

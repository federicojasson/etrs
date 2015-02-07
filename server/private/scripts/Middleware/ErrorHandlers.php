<?php

namespace App\Middleware;

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
	 * 
	 * It receives the exception which holds the information about the error.
	 */
	public function onError(\Exception $exception) {
		$app = $this->app;
		
		// Logs the event
		$app->log->error('Unexpected error. Message: ' . $exception->getMessage());
		
		// Halts the execution
		$app->halt(HTTP_STATUS_INTERNAL_SERVER_ERROR, [
			'error' => ERROR_UNEXPECTED_ERROR
		]);
	}
	
	/*
	 * Invoked when the requested service is not defined.
	 */
	public function onNotFound() {
		$app = $this->app;
		
		// Halts the execution
		$app->halt(HTTP_STATUS_NOT_FOUND, [
			'error' => ERROR_UNDEFINED_SERVICE
		]);
	}
	
	/*
	 * Defines the error handlers.
	 */
	private function defineErrorHandlers() {
		$app = $this->app;
		
		// Defines the error handlers
		$app->error([ $this, 'onError' ]);
		$app->notFound([ $this, 'onNotFound' ]);
	}
	
}

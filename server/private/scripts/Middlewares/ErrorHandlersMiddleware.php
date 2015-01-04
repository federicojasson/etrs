<?php

/*
 * This middleware defines the error handlers.
 */
class ErrorHandlersMiddleware extends \Slim\Middleware {
	
	/*
	 * Executes the middleware.
	 */
	public function call() {
		$app = $this->app;
		
		// Defines the error handlers
		$app->error([ $this, 'onError' ]);
		$app->notFound([ $this, 'onNotFound' ]);
		
		// Calls the next middleware
		$this->next->call();
	}
	
	/*
	 * Invoked when an error occurs.
	 */
	public function onError($exception) { // TODO: debug (remove $exception parameter also)
		\Slim\Slim::getInstance()->log->debug($exception->getMessage());
		
		$this->app->halt(HTTP_STATUS_INTERNAL_SERVER_ERROR, [
			'id' => ERROR_ID_UNEXPECTED_ERROR
		]);
	}
	
	/*
	 * Invoked when the requested service is not defined.
	 */
	public function onNotFound() {
		$this->app->halt(HTTP_STATUS_NOT_FOUND, [
			'id' => ERROR_ID_UNDEFINED_SERVICE
		]);
	}
	
}

<?php

/**
 * ETRS - Eye Tracking Record System
 * Copyright (C) 2015 Federico Jasson
 * 
 * This program is free software: you can redistribute it and/or modify it under
 * the terms of the GNU General Public License as published by the Free Software
 * Foundation, either version 3 of the License, or (at your option) any later
 * version.
 * 
 * This program is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE. See the GNU General Public License for more
 * details.
 * 
 * You should have received a copy of the GNU General Public License along with
 * this program. If not, see <http://www.gnu.org/licenses/>.
 */

namespace App\Middleware;

/**
 * This middleware registers the error handlers.
 */
class ErrorHandlers extends \Slim\Middleware {
	
	/**
	 * Calls the middleware.
	 */
	public function call() {
		// Registers the error handlers
		$this->registerErrorHandlers();

		// Calls the next middleware
		$this->next->call();
	}
	
	/**
	 * Handles an error.
	 * 
	 * Receives the exception that contains the information about the error.
	 */
	public function handleError($exception) {
		$app = $this->app;
		
		// Logs the event
		$app->log->error('Unexpected error. Message: ' . $exception->getMessage());
		
		// Halts the execution
		$app->halt(HTTP_STATUS_INTERNAL_SERVER_ERROR, [
			'code' => CODE_UNEXPECTED_ERROR
		]);
	}
	
	/**
	 * Handles a situation where the requested service is not found.
	 */
	public function handleNotFound() {
		$app = $this->app;
		
		// Halts the execution
		$app->halt(HTTP_STATUS_NOT_FOUND, [
			'code' => CODE_UNDEFINED_SERVICE
		]);
	}
	
	/**
	 * Registers the error handlers.
	 */
	private function registerErrorHandlers() {
		$app = $this->app;
		
		// Registers the error handlers
		$app->error([ $this, 'handleError' ]);
		$app->notFound([ $this, 'handleNotFound' ]);
	}
	
}

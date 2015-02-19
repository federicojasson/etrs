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
 * This class registers the error handlers.
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
	 * Registers the error handlers.
	 */
	private function registerErrorHandlers() {
		global $app;
		
		// Registers the error handlers
		$app->error(new \App\ErrorHandler\ErrorHandler());
		$app->notFound(new \App\ErrorHandler\NotFoundHandler());
	}
	
}

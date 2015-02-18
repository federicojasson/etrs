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

namespace App\ErrorHandler;

/**
 * This class handles errors.
 */
class ErrorHandler {
	
	/**
	 * TODO: comment
	 * 
	 * Receives the exception that contains the information about the error.
	 */
	public function __invoke($exception) {
		global $app;
		
		// Logs the event
		$app->log->error('Unexpected error. Message: ' . $exception->getMessage());
		
		// Halts the execution
		$app->server->haltExecution(HTTP_STATUS_INTERNAL_SERVER_ERROR, CODE_UNEXPECTED_ERROR);
	}
	
}

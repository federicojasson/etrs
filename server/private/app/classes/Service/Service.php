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

namespace App\Service;

/**
 * Represents a service.
 */
abstract class Service  {
	
	/**
	 * The output.
	 */
	private $output;
	
	/**
	 * Prepares and executes the service.
	 */
	public function __invoke() {
		global $app;
		
		if (! $this->isRequestValid()) {
			// The request is invalid
			// Halts the application
			haltApp(HTTP_STATUS_BAD_REQUEST, ERROR_CODE_INVALID_REQUEST);
		}
		
		if (! $this->isUserAuthorized()) {
			// The user is unauthorized
			// Halts the application
			haltApp(HTTP_STATUS_FORBIDDEN, ERROR_CODE_UNAUTHORIZED_USER);
		}
		
		// Initializes the output
		$this->output = '';
		
		// Executes the service
		$this->execute();
		
		// Sets the response's body
		$app->response->setBody($this->output);
	}
	
	/**
	 * Executes the service.
	 */
	protected abstract function execute();
	
	/**
	 * Determines whether the request is valid.
	 */
	protected abstract function isRequestValid();
	
	/**
	 * Determines whether the user is authorized.
	 */
	protected abstract function isUserAuthorized();
	
	/**
	 * Sets the output.
	 * 
	 * Receives the output to be set.
	 */
	protected function setOutput($output) {
		$this->output = $output;
	}
	
	/**
	 * Sets an output's value.
	 * 
	 * Receives the output's key, the value to be set and, optionally, a filter
	 * for the value.
	 */
	protected function setOutputValue($key, $value, $filter = null) {
		if (! is_array($this->output)) {
			// The output is not an array
			// Reinitializes the output
			$this->output = [];
		}
		
		if (! is_null($filter)) {
			// Applies the filter
			$value = call_user_func($filter, $value);
		}
		
		// Sets the output's value
		$this->output[$key] = $value;
	}
	
}

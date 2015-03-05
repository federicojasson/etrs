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
 * Represents an external service.
 * 
 * Subclasses must implement the isInputValid method to validate the input and
 * the isUserAuthorized method to check if the user is authorized to use the
 * service.
 */
abstract class ExternalService extends Service {
	
	/**
	 * The input.
	 */
	private $input;
	
	/**
	 * Invokes the service.
	 */
	public function __invoke() {
		global $app;
		
		// Initializes the input
		$this->input = $app->request->getBody();
		
		if (! $this->isInputValid()) {
			// The input is invalid
			// Halts the execution
			$app->server->haltExecution(HTTP_STATUS_BAD_REQUEST, CODE_INVALID_INPUT);
		}
		
		if (! $this->isUserAuthorized()) {
			// The user is not authorized to use the service
			// Halts the execution
			$app->server->haltExecution(HTTP_STATUS_FORBIDDEN, CODE_UNAUTHORIZED_USER);
		}
		
		// Invokes the homonym method in the parent
		parent::__invoke();
	}
	
	/**
	 * Returns the value of an input entry.
	 * 
	 * Receives the key of the entry and, optionally, a filter to be applied to
	 * the value before returning it.
	 */
	protected function getInput($key, $filter = null) {
		global $app;
		
		// Gets the value of the input
		if (is_array($this->input)) {
			$value = $this->input[$key];
		} else {
			$value = $app->request->params($key);
		}
		
		if (is_null($value)) {
			// The value is null
			return null;
		}
		
		if (! is_null($filter)) {
			// A filter has been received
			// Filters the value
			$value = call_user_func($filter, $value);
		}
		
		return $value;
	}
	
	/**
	 * TODO: comment
	 */
	protected function isDataRequest() {
		global $app;
		
		if (! $app->request->isDataRequest()) {
			// It is not a data request
			return false;
		}
		
		// TODO: process input
		
		return true;
	}
	
	/**
	 * Determines whether the input is valid.
	 */
	protected abstract function isInputValid();
	
	/**
	 * Determines whether it is a JSON request.
	 * 
	 * If it is a JSON request, the input is replaced by a decoded version.
	 */
	protected function isJsonRequest() {
		global $app;
		
		if (! $app->request->isJsonRequest()) {
			// It is not a JSON request
			return false;
		}
		
		// Decodes the input
		$this->input = json_decode($this->input, true);
		
		return true;
	}
	
	/**
	 * Determines whether the user is authorized to use the service.
	 */
	protected abstract function isUserAuthorized();
	
}

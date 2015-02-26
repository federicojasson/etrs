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
 * This class represents an external service.
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
		
		// Invokes the parent's function
		parent::__invoke();
	}
	
	/**
	 * TODO: comment
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
	 * Determines whether the input is valid.
	 */
	protected abstract function isInputValid();
	
	/**
	 * Determines whether the user is authorized to use the service.
	 */
	protected abstract function isUserAuthorized();
	
	/**
	 * Determines whether the input is a valid JSON input.
	 * 
	 * If the input is valid, it is replaced by a decoded version.
	 * 
	 * Receives the descriptor of the expected JSON input.
	 */
	protected function isValidJsonInput($jsonDescriptor) {
		// Decodes the input
		$input = json_decode($this->input, true);
		
		if (is_null($input)) {
			// The input could not be decoded
			return false;
		}
		
		if (! $jsonDescriptor->isValidInput($input)) {
			// The input is invalid
			return false;
		}
		
		// Replaces the input with the decoded version
		$this->input = $input;
		
		return true;
	}
	
}

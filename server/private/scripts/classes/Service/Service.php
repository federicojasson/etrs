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
 * This class represents a service.
 * 
 * Subclasses must implement the execute method. For security reasons, every
 * service has to implement, also, the isInputValid method to validate the input
 * and the isUserAuthorized method to check if the user is authorized to use the
 * service. This is a measure to help the developer not to forget to do these
 * tasks.
 */
abstract class Service {
	
	/**
	 * The output.
	 */
	private $output;
	
	/**
	 * Invokes the service.
	 */
	public function __invoke() {
		global $app;
		
		// Initializes the output
		$this->output = '';
		
		// Executes the service
		$this->execute();
		
		// Sets the output
		$app->response->setBody($this->output);
	}
	
	/**
	 * Executes the service.
	 */
	protected abstract function execute();
	
	/**
	 * Replaces the output completely.
	 * 
	 * Receives the output to be set.
	 */
	protected function replaceOutput($output) {
		$this->output = $output;
	}
	
	/**
	 * TODO: comment
	 */
	protected function setOutput($key, $value, $filter = null) {
		if (! is_array($this->output)) {
			// The output is not an array
			// Reinitializes the output as an array
			$this->output = [];
		}
		
		if (! is_null($filter)) {
			// A filter was received
			// Filters the value
			$value = call_user_func($filter, $value);
		}
		
		// Sets the output
		$this->output[$key] = $value;
	}
	
}

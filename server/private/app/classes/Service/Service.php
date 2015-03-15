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
		
		// Initializes the output
		$this->output = '';
		
		// Executes the service
		$this->execute();
		
		// Sets the response's body
		$app->response->setBody($this->output);
	}
	
	/**
	 * Adds an output.
	 * 
	 * Receives a key, a value and, optionally, a filter to apply to the value.
	 */
	protected function addOutput($key, $value, $filter = null) {
		if (! is_array($this->output)) {
			// The output is not an array
			// Reinitializes the output
			$this->output = [];
		}
		
		if (! is_null($filter)) {
			// Applies the filter
			$value = call_user_func($filter, $value);
		}
		
		// Adds the output
		$this->output[$key] = $value;
	}
	
	/**
	 * Executes the service.
	 */
	protected abstract function execute();
	
	/**
	 * Sets the output.
	 * 
	 * Receives the output to set.
	 */
	protected function setOutput($output) {
		$this->output = $output;
	}
	
}

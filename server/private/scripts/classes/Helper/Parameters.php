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

namespace App\Helper;

/**
 * Provides methods to obtain parameters used by the application.
 */
class Parameters {
	
	/**
	 * The parameters that have already been loaded.
	 */
	private $parameters;
	
	/**
	 * The paths of the parameter files.
	 */
	private $paths;
	
	/**
	 * Initializes an instance of the class.
	 */
	public function __construct() {
		// Initializes the parameters collection
		$this->parameters = [];
		
		// Defines the paths of the parameter files
		$this->paths = [
			'dbms' => DIRECTORY_PARAMETERS . '/dbms.json',
			'server' => DIRECTORY_PARAMETERS . '/server.json',
			'smtp' => DIRECTORY_PARAMETERS . '/smtp.json'
		];
	}
	
	/**
	 * Returns a set of parameters.
	 * 
	 * Receives the name of the set.
	 */
	public function __get($name) {
		if (! array_key_exists($name, $this->parameters)) {
			// The parameters have not been loaded yet
			
			// Gets the path of the parameter file
			$path = $this->paths[$name];

			// Reads the parameter file
			$this->parameters[$name] = readJsonFile($path);
		}
		
		// Returns the parameters
		return $this->parameters[$name];
	}
	
}

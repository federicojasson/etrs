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
 * Manages the parameters.
 */
class Parameters {
	
	/**
	 * The parameters.
	 */
	private $parameters;
	
	/**
	 * The paths.
	 */
	private $paths;
	
	/**
	 * Initializes an instance of the class.
	 */
	public function __construct() {
		$this->parameters = [];
		
		// Gets the paths
		$this->paths = $this->getPaths();
	}
	
	/**
	 * Returns a set of parameters.
	 * 
	 * Receives the set's name.
	 */
	public function __get($name) {
		if (! array_key_exists($name, $this->parameters)) {
			// The parameters have not been loaded yet
			
			// Gets the parameters file's path
			$path = $this->paths[$name];
			
			// Reads the parameters file
			$this->parameters[$name] = readJsonFile($path);
		}
		
		// Gets the parameters
		return $this->parameters[$name];
	}
	
	/**
	 * Returns the paths.
	 */
	private function getPaths() {
		return [
			// DEFINEHERE: define parameter paths here
			'dbms' => DIRECTORY_PARAMETERS . '/dbms.json',
			'server' => DIRECTORY_PARAMETERS . '/server.json',
			'smtp' => DIRECTORY_PARAMETERS . '/smtp.json'
		];
	}
	
}

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
 * This class sets the appropiate configuration.
 */
class Configurations extends \Slim\Middleware {
	
	/**
	 * The available configurations.
	 */
	private $configurations;
	
	/**
	 * Initializes an instance of the class.
	 */
	public function __construct() {
		// Defines the available configurations
		$this->configurations = [
			OPERATION_MODE_DEVELOPMENT => 'App\Configuration\Development',
			OPERATION_MODE_MAINTENANCE => 'App\Configuration\Maintenance',
			OPERATION_MODE_PRODUCTION => 'App\Configuration\Production'
		];
	}
	
	/**
	 * Calls the middleware.
	 */
	public function call() {
		// Sets the configuration
		$this->setConfiguration($this->configurations);

		// Calls the next middleware
		$this->next->call();
	}
	
	/**
	 * Sets the appropriate configuration according to the operation mode.
	 * 
	 * Receives the configurations.
	 */
	private function setConfiguration($configurations) {
		global $app;
		
		// Checks the available configurations and sets the appropriate one
		foreach ($configurations as $operationMode => $class) {
			$app->configureMode($operationMode, new $class());
		}
	}
	
}

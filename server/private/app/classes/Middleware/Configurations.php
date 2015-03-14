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
 * Responsible for applying the configuration.
 */
class Configurations extends \Slim\Middleware {
	
	/**
	 * Calls the middleware.
	 */
	public function call() {
		global $app;
		
		// Gets the available configurations
		$configurations = $this->getConfigurations();
		
		// Applies the appropriate configuration
		foreach ($configurations as $operationMode => $class) {
			$app->configureMode($operationMode, new $class());
		}
		
		// Calls the next middleware
		$this->next->call();
	}
	
	/**
	 * Returns the available configurations.
	 */
	private function getConfigurations() {
		return [
			OPERATION_MODE_DEVELOPMENT => 'App\Configuration\Development',
			OPERATION_MODE_MAINTENANCE => 'App\Configuration\Maintenance',
			OPERATION_MODE_PRODUCTION => 'App\Configuration\Production'
		];
	}
	
}

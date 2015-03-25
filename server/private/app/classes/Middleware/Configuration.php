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
class Configuration extends \Slim\Middleware {
	
	/**
	 * Calls the middleware.
	 */
	public function call() {
		// Gets the operation modes
		$operationModes = $this->getOperationModes();
		
		// Applies the appropriate configuration
		foreach ($operationModes as $operationMode) {
			$this->tryApplyConfiguration($operationMode);
		}
		
		// Calls the next middleware
		$this->next->call();
	}
	
	/**
	 * Returns the class of the configuration corresponding to a certain
	 * operation mode.
	 * 
	 * Receives the operation mode.
	 */
	private function getConfigurationClass($operationMode) {
		// Converts the operation mode from camelCase to PascalCase
		$operationMode = camelToPascalCase($operationMode);
		
		// Builds the class
		return 'App\Configuration\\' . $operationMode;
	}
	
	/**
	 * Returns the operation modes.
	 */
	private function getOperationModes() {
		return [
			OPERATION_MODE_DEVELOPMENT,
			OPERATION_MODE_MAINTENANCE,
			OPERATION_MODE_PRODUCTION
		];
	}
	
	/**
	 * Tries to apply the configuration corresponding to a certain operation
	 * mode.
	 * 
	 * Receives the operation mode.
	 */
	private function tryApplyConfiguration($operationMode) {
		global $app;
		
		// Gets the configuration's class
		$class = $this->getConfigurationClass($operationMode);
		
		// Tries to apply the configuration
		$app->configureMode($operationMode, new $class());
	}
	
}

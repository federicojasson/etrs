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
 * Responsible for registering the helpers.
 */
class Helpers extends \Slim\Middleware {
	
	/**
	 * Calls the middleware.
	 */
	public function call() {
		// Gets the helpers
		$helpers = $this->getHelpers();
		
		// Registers the helpers
		foreach ($helpers as $helper) {
			$this->registerHelper($helper);
		}
		
		// Calls the next middleware
		$this->next->call();
	}
	
	/**
	 * Returns a helper's class.
	 * 
	 * Receives the helper's name.
	 */
	private function getHelperClass($name) {
		// Converts the name from camelCase to PascalCase
		$name = camelToPascalCase($name);
		
		// Builds the class
		return 'App\Helper\\' . $name;
	}
	
	/**
	 * Returns the helpers.
	 */
	private function getHelpers() {
		return [
			// DEFINEHERE: define helpers here
			'accessValidator',
			'account',
			'assertion',
			'authenticator',
			'cryptography',
			'data',
			'email',
			'inputValidator',
			'parameters',
			'response',
			'session'
		];
	}
	
	/**
	 * Registers a helper.
	 * 
	 * Receives the helper's name.
	 */
	private function registerHelper($name) {
		global $app;
		
		// Gets the helper's class
		$class = $this->getHelperClass($name);
		
		// Registers a singleton initializer
		$app->container->singleton($name, function() use ($class) {
			return new $class();
		});
	}
	
}

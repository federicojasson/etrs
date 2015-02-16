<?php

/*
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

/*
 * This middleware registers the helpers.
 */
class Helpers extends \Slim\Middleware {
	
	/*
	 * Calls the middleware.
	 */
	public function call() {
		// Gets the helpers
		$helpers = $this->getHelpers();
		
		// Registers the helpers
		$this->registerHelpers($helpers);

		// Calls the next middleware
		$this->next->call();
	}
	
	/*
	 * Returns the helpers to be registered.
	 */
	private function getHelpers() {
		return [];
	}
	
	/*
	 * Registers a helper.
	 * 
	 * Receives the helper's name and the fully qualified name of its class.
	 */
	private function registerHelper($name, $class) {
		$app = $this->app;
		
		// Registers a singleton initializer
		$app->container->singleton($name, function() use ($class) {
			// Creates and returns the helper
			return new $class;
		});
	}
	
	/*
	 * Registers the helpers.
	 * 
	 * Receives the helpers.
	 */
	private function registerHelpers($helpers) {
		// Registers the helpers
		foreach ($helpers as $name => $class) {
			$this->registerHelper($name, $class);
		}
	}
	
}

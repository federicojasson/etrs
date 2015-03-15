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
 * Responsible for registering services.
 */
abstract class Services extends \Slim\Middleware {
	
	/**
	 * Calls the middleware.
	 */
	public function call() {
		// Gets the services
		$services = $this->getServices();
		
		// Registers the services
		foreach ($services as $service) {
			$this->registerService($service);
		}
		
		// Calls the next middleware
		$this->next->call();
	}
	
	/**
	 * Returns the services.
	 */
	protected abstract function getServices();
	
	/**
	 * Returns a service's class.
	 * 
	 * Receives the service's URL.
	 */
	private function getServiceClass($url) {
		// Removes the leading slash
		$string = substr($url, 1);
		
		// Gets the string fragments separated by slashes
		$fragments = explode('/', $string);
		
		// Converts the fragments from spinal-case to PascalCase
		foreach ($fragments as &$fragment) {
			$fragment = spinalToPascalCase($fragment);
		}
		
		// Defines the services' namespace
		$namespace = 'App\Service\\';
		
		// Builds the service's class
		return $namespace . implode('\\', $fragments);
	}
	
	/**
	 * Registers a service.
	 * 
	 * Receives the service's URL.
	 */
	private function registerService($url) {
		global $app;
		
		// Gets the service's class
		$class = $this->getServiceClass($url);
		
		// Registers a route for the service
		$app->post($url, new $class());
	}
	
}

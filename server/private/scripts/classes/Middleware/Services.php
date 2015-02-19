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
 * This class registers the services.
 */
class Services extends \Slim\Middleware {
	
	/**
	 * The services to be registered.
	 */
	private $services;
	
	/**
	 * Creates an instance of the class.
	 * 
	 * Receives the services to be registered.
	 */
	public function __construct($services) {
		$this->services = $services;
	}
	
	/**
	 * Calls the middleware.
	 */
	public function call() {
		// Registers the services
		$this->registerServices($this->services);

		// Calls the next middleware
		$this->next->call();
	}
	
	/**
	 * Returns the URL of a service.
	 * 
	 * Receives the fully-qualified class name of the service.
	 */
	private function getServiceUrl($class) {
		// Defines the namespace of the services and gets its length
		$namespace = 'App\Service\\';
		$length = strlen($namespace);
		
		// Gets the suffix of the class
		$suffix = substr($class, $length);
		
		// Replaces suffix's backslashes by slashes
		$suffixWithoutBackslashes = str_replace('\\', '/', $suffix);
		
		// Gets the fragments of the suffix
		$fragments = explode('/', $suffixWithoutBackslashes);
		
		// Converts the fragments to spinal-case
		foreach ($fragments as &$fragment) {
			$fragment = toSpinalCase($fragment);
		}
		
		// Returns the URL
		return '/' . implode('/', $fragments);
	}
	
	/**
	 * Registers a service.
	 * 
	 * Receives the service's HTTP method and its fully-qualified class name.
	 */
	private function registerService($httpMethod, $class) {
		global $app;
		
		// Gets the URL of the service from its fully-qualified class name
		$url = $this->getServiceUrl($class);
		
		// Registers a route for the service
		$route = $app->map($url, new $class);
		
		// Sets the HTTP method through which the service must be invoked
		$route->via($httpMethod);
	}
	
	/**
	 * Registers a set of services.
	 * 
	 * Receives the services.
	 */
	private function registerServices($services) {
		// Registers the services
		foreach ($services as $httpMethod => $services) {
			foreach ($services as $class) {
				$this->registerService($httpMethod, $class);
			}
		}
	}
	
}

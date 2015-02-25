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
	 * Initializes an instance of the class.
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
	 * Returns the fully-qualified class name of a service.
	 * 
	 * Receives the URL and the HTTP method of the service.
	 */
	private function getServiceFullyQualifiedClassName($url, $httpMethod) {
		// Prepends the HTTP method in lowercase to the URL
		$string = strtolower($httpMethod) . $url;
		
		// Gets the string fragments separated by slashes
		$fragments = explode('/', $string);
		
		// Converts the fragments to PascalCase
		foreach ($fragments as &$fragment) {
			$fragment = toPascalCase($fragment);
		}
		
		// Defines the namespace of the services
		$namespace = 'App\Service\\';
		
		// Builds the fully-qualified class name of the service
		return $namespace . implode('\\', $fragments);
	}
	
	/**
	 * Registers a service.
	 * 
	 * Receives the URL and the HTTP method of the service.
	 */
	private function registerService($url, $httpMethod) {
		global $app;
		
		// Gets the fully-qualified class name of the service
		$class = $this->getServiceFullyQualifiedClassName($url, $httpMethod);
		
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
		foreach ($services as $httpMethod => $urls) {
			foreach ($urls as $url) {
				$this->registerService($url, $httpMethod);
			}
		}
	}
	
}

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
 * This class registers the singletons.
 */
class Singletons extends \Slim\Middleware {
	
	/**
	 * The singletons to be registered.
	 */
	private $singletons;
	
	/**
	 * Creates an instance of the class.
	 */
	public function __construct() {
		// Defines the singletons to be registered
		$this->singletons = [
			'authentication' => 'App\Helper\Authentication',
			'cryptography' => 'App\Helper\Cryptography',
			'database' => 'App\Helper\Database',
			'response' => 'App\Extension\Response',
			'server' => 'App\Helper\Server',
			'session' => 'App\Helper\Session'
		];
	}
	
	/**
	 * Calls the middleware.
	 */
	public function call() {
		// Registers the singletons
		$this->registerSingletons($this->singletons);

		// Calls the next middleware
		$this->next->call();
	}
	
	/**
	 * Registers a singleton.
	 * 
	 * Receives the singleton's name and its fully-qualified class name.
	 */
	private function registerSingleton($name, $class) {
		global $app;
		
		// Registers a singleton initializer
		$app->container->singleton($name, function() use ($class) {
			// Returns the singleton
			return new $class;
		});
	}
	
	/**
	 * Registers a set of singletons.
	 * 
	 * Receives the singletons.
	 */
	private function registerSingletons($singletons) {
		// Registers the singletons
		foreach ($singletons as $name => $class) {
			$this->registerSingleton($name, $class);
		}
	}
	
}

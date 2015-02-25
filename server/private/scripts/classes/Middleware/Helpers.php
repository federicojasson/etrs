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
 * This class registers the helpers.
 */
class Helpers extends \Slim\Middleware {
	
	/**
	 * The helpers to be registered.
	 */
	private $helpers;
	
	/**
	 * Creates an instance of the class.
	 */
	public function __construct() {
		// Defines the helpers to be registered
		$this->helpers = [
			'accessValidator' => 'App\Helper\AccessValidator',
			'assertor' => 'App\Helper\Assertor',
			'authentication' => 'App\Helper\Authentication',
			'authenticator' => 'App\Helper\Authenticator',
			'cryptography' => 'App\Helper\Cryptography',
			'data' => 'App\Helper\Data',
			'parameters' => 'App\Helper\Parameters',
			'request' => 'App\Helper\Request',
			'response' => 'App\Helper\Response',
			'server' => 'App\Helper\Server',
			'session' => 'App\Helper\Session'
		];
	}
	
	/**
	 * Calls the middleware.
	 */
	public function call() {
		// Registers the helpers
		$this->registerHelpers($this->helpers);

		// Calls the next middleware
		$this->next->call();
	}
	
	/**
	 * Registers a helper.
	 * 
	 * Receives the helper's name and its fully-qualified class name.
	 */
	private function registerHelper($name, $class) {
		global $app;
		
		// Registers a singleton initializer for the helper
		$app->container->singleton($name, function() use ($class) {
			return new $class;
		});
	}
	
	/**
	 * Registers a set of helpers.
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

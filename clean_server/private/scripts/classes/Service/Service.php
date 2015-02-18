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

namespace App\Service;

/**
 * This class represents a service.
 * 
 * A service encapsulates the logic of a given task and can be executed through
 * a specific URL and HTTP method.
 * 
 * Subclasses must implement the execute method, which executes the service, and
 * the getUrl and getMethod methods, which return the service's URL and HTTP
 * method, respectively.
 */
abstract class Service {
	
	/**
	 * The application object.
	 */
	protected $app;
	
	/**
	 * Creates an instance of this class.
	 */
	public function __construct() {
		// Gets the application object
		$this->app = \Slim\Slim::getInstance();
	}
	
	/**
	 * Executes the service.
	 */
	public abstract function execute();
	
	/**
	 * Returns the HTTP method of the service.
	 */
	public abstract function getMethod();
	
	/**
	 * Returns the URL of the service.
	 */
	public abstract function getUrl();
	
}

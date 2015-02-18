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

namespace App\Helper;

/**
 * This class represents a helper.
 * 
 * A helper is a singleton that offers a very specific functionality.
 * 
 * Subclasses can, optionally, override the initialize method to perform
 * initialization tasks.
 */
abstract class Helper {
	
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
		
		// Initializes the helper
		$this->initialize();
	}
	
	/**
	 * Performs initialization tasks.
	 */
	protected function initialize() {
		// No initialization tasks need to be performed
	}
	
}

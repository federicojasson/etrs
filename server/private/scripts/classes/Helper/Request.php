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
 * This class extends the Slim's Request class.
 */
class Request extends \Slim\Http\Request {
	
	/**
	 * Creates an instance of the class.
	 */
	public function __construct() {
		global $app;
		
		// Invokes the parent's constructor
		parent::__construct($app->environment);
	}
	
	/**
	 * Determines whether it is a data request.
	 */
	public function isDataRequest() {
		return $this->getMediaType() === 'multipart/form-data';
	}
	
	/**
	 * Determines whether it is a JSON request.
	 */
	public function isJsonRequest() {
		return $this->getMediaType() === 'application/json';
	}
	
}

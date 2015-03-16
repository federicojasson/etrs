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
 * Extends the functionality of the Slim's Response class.
 */
class Response extends \Slim\Http\Response {
	
	/**
	 * Sets and returns the body.
	 * 
	 * The method redefines a deprecated version and invokes getBody and setBody
	 * instead. This is necessary because Slim still uses it.
	 * 
	 * Receives, optionally, the body to set.
	 */
	public function body($body = null) {
		if (! is_null($body)) {
			// Sets the body
			$this->setBody($body);
		}
		
		// Gets the body
		return $this->getBody();
	}
	
	/**
	 * Sets the body.
	 * 
	 * Receives the body to set. If it is not a string, it encodes it in JSON.
	 */
	public function setBody($body) {
		if (! is_string($body)) {
			// The body is not a string
			
			// Encodes the body in JSON
			$body = json_encode($body);
			
			// Sets the appropriate headers
			$this->headers->set('Content-Type', 'application/json');
		}
		
		// Invokes the homonym method in the parent
		parent::setBody($body);
	}
	
}

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

namespace App\Extension;

/*
 * This class extends the Slim's Response class.
 */
class Response extends \Slim\Http\Response {
	
	/*
	 * Returns, and optionally sets, the body.
	 * 
	 * The method redefines a deprecated version, and uses getBody and setBody
	 * instead. This is necessary because the Slim's code still uses it.
	 * 
	 * Receives, optionally, the body to be set.
	 */
	public function body($body = null) {
		if (! is_null($body)) {
			// Sets the body
			$this->setBody($body);
		}
		
		// Returns the body
		return $this->getBody();
	}
	
	/*
	 * Sets the body. If it is not a string, it encodes it in JSON format.
	 * 
	 * Receives the body to be set.
	 */
	public function setBody($body) {
		if (! is_string($body)) {
			// The body is not a string
			
			// Encodes the body
			$body = json_encode($body);
			
			// Sets the Content-Type header
			$this->headers->set('Content-Type', 'application/json');
		}
		
		// Invokes the parent's function
		parent::setBody($body);
	}
	
}

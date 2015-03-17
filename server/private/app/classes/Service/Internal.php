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
 * Represents an internal service.
 */
abstract class Internal extends Service  {
	
	/**
	 * The input.
	 */
	private $input;
	
	/**
	 * Prepares and executes the service.
	 */
	public function __invoke() {
		global $app;
		
		// Initializes the input
		$this->input = []; // TODO: HOW???
		
		// Invokes the homonym method in the parent
		parent::__invoke();
	}
	
	/**
	 * Determines whether the user is authorized.
	 */
	protected function isUserAuthorized() {
		return true;
	}
	
}

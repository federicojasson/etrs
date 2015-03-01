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

namespace App\Utility\JsonDescriptor;

/**
 * This class represents a JSON descriptor.
 * 
 * Instances can be used in combination to define the expected structure of a
 * JSON input and subsequently validating it.
 * 
 * A JSON structure can be an array, an object or a value. For each type, a
 * definition indicates the way the validation is carried out:
 * 
 * - Arrays: a JsonDescriptor instance is used, which describes the expected
 *   structure of all the elements of the array.
 * 
 * - Objects: an associative array is used, whose values are JsonDescriptor
 *   instances that describe the expected structure of each object property.
 * 
 * - Values: a function is used, which receives the value and it validates it.
 * 
 * Subclasses must implement the isInputValid method.
 */
abstract class JsonDescriptor {
	
	/**
	 * The definition.
	 */
	protected $definition;
	
	/**
	 * Initializes an instance of the class.
	 * 
	 * Receives the definition.
	 */
	public function __construct($definition) {
		$this->definition = $definition;
	}
	
	/**
	 * Determines whether an input is valid.
	 * 
	 * Receives the input.
	 */
	public abstract function isInputValid($input);
	
}

<?php

namespace App\Auxiliar\JsonStructureDescriptor;

/*
 * This class represents a descriptor of a JSON structure.
 * 
 * Instances of this class can be used in combination to define the expected
 * structure of a JSON input and subsequently validating it.
 * 
 * A JSON structure can be an array, an object or a value. For each type, a
 * definition indicates the way it will be validated:
 * 
 * - Arrays: a JsonStructureDescriptor instance is used, which describes the
 *   structure of all the array's elements.
 * 
 * - Objects: an associative array is used, whose values are
 *   JsonStructureDescriptor instances that describe the structure of each
 *   property.
 * 
 * - Values: a validation function is used, which is invoked in order to
 *   validate the value.
 * 
 * Subclasses must implement the isValidInput function.
 */
abstract class JsonStructureDescriptor {
	
	/*
	 * The definition of the descriptor.
	 */
	protected $definition;
	
	/*
	 * Creates an instance of this class.
	 * 
	 * It receives the definition of the descriptor.
	 */
	public function __construct($definition) {
		$this->definition = $definition;
	}
	
	/*
	 * Determines whether an input is valid according to this descriptor.
	 * 
	 * It receives the input.
	 */
	public abstract function isValidInput($input);
	
}

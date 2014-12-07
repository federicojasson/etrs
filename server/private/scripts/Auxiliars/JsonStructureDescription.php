<?php

/*
 * This class represents a descriptor of a JSON structure. Instances can be used
 * in combination to define the expected structure of a JSON input and
 * subsequently validating it.
 * 
 * A JSON structure descriptor holds the type of structure that is supposed to
 * match against, which can be an array, an object or a value. For each type, a
 * definition indicates the way it should be validated:
 * 
 * - Arrays: a JsonStructureDescription instance is used, which determines how
 *   all the array's elements must be validated.
 * 
 * - Objects: an associative array is used, whose values are
 *   JsonStructureDescription instances that determine how each property must be
 *   validated.
 * 
 * - Values: a validation function is used, which is invoked in order to
 *   validate it.
 */
class JsonStructureDescription {
	
	/*
	 * The JSON structure's definition.
	 */
	private $definition;
	
	/*
	 * The JSON structure's type.
	 */
	private $type;
	
	/*
	 * Creates an instance of this class.
	 * 
	 * It receives the JSON structure's type and definition.
	 */
	public function __construct($type, $definition) {
		$this->definition = $definition;
		$this->type = $type;
	}
	
	/*
	 * Returns the JSON structure's definition.
	 */
	public function getDefinition() {
		return $this->definition;
	}
	
	/*
	 * Returns the JSON structure's type.
	 */
	public function getType() {
		return $this->type;
	}
	
}

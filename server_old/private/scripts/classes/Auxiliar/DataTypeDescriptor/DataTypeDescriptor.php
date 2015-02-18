<?php

namespace App\Auxiliar\DataTypeDescriptor;

/*
 * This class represents a descriptor of a data type.
 * 
 * Subclasses must implement the isValidInput function.
 */
abstract class DataTypeDescriptor {
	
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

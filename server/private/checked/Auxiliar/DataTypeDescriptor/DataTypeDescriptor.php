<?php

namespace App\Auxiliar\DataTypeDescriptor;

/*
 * TODO: comments
 */
abstract class DataTypeDescriptor {
	
	/*
	 * The definition of the descriptor.
	 */
	protected $definition;
	
	/*
	 * Determines whether an input is valid according to this descriptor.
	 * 
	 * It receives the input.
	 */
	public abstract function isValidInput($input);
	
}

<?php

namespace App\Auxiliar\DataTypeDescriptor;

/*
 * TODO: comments
 */
class DataTypeDescriptorFactory {
	
	/*
	 * Creates a DataTypeDescriptor instance.
	 * 
	 * It receives a formatted descriptor.
	 * 
	 * Throws an exception if the instance can't be created.
	 */
	public static function create($formattedDescriptor) {
		// Gets the fields of the descriptor
		$fields = self::getFields($formattedDescriptor);
		
		// Gets the type
		$type = self::getType($fields);
		
		// Gets the definition
		$definition = self::getDefinition($fields);
		
		// TODO: implement
	}
	
	/*
	 * TODO: comments
	 */
	private static function getDefinition($fields) {
		// TODO: implement
	}
	
	/*
	 * Returns the fields of a formatted descriptor.
	 * 
	 * It receives the formatted descriptor.
	 */
	private static function getFields($formattedDescriptor) {
		// Splits the formatted descriptor
		$fields = explode(';', $formattedDescriptor);
		
		// Trims the fields
		foreach ($fields as &$field) {
			$field = trimString($field);
		}
		
		return $fields;
	}
	
	/*
	 * TODO: comments
	 */
	private static function getType($fields) {
		// Gets the first field
		$type = $fields[0];
		
		// Defines the supported types
		$types = [
			DATA_TYPE_BOOLEAN,
			DATA_TYPE_INTEGER_FIX_VALUES,
			DATA_TYPE_INTEGER_RANGE
		];
		
		if (! isValueInArray($type, $types)) {
			// The type of the descriptor is not supported
			throw new Exception();
		}
		
		return $type;
	}
	
}

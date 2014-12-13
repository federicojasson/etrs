<?php

/*
 * This helper offer miscellaneous utility functions.
 */
class Utilities extends Helper {
	
	/*
	 * Returns the binary representation of a UUID.
	 * 
	 * It receives the UUID with standard format.
	 */
	public function uuidToBinary($uuid) {
		// Removes the hyphens
		$hexadecimal = str_replace('-', '', $uuid);
		
		// Converts the UUID to its binary representation and returns it
		return hex2bin($hexadecimal);
	}
	
}

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

namespace App\Data\Type;

/**
 * Represents a binary type.
 * 
 * The primary difference with the native binary type is that this type
 * automatically reads the obtained binary resource when the value is converted
 * to its PHP representation.
 */
class AutomaticBinary extends \Doctrine\DBAL\Types\BinaryType {
	
	/**
	 * Converts a value from its database representation to its PHP counterpart.
	 * 
	 * Receives the value and the database plataform.
	 */
	public function convertToPHPValue($value, \Doctrine\DBAL\Platforms\AbstractPlatform $platform) {
		// Invokes the homonym method in the parent
		$value = parent::convertToPHPValue($value, $platform);
		
		if (is_resource($value)) {
			// The value is a resource
			// Reads the content of the resource
			$value = stream_get_contents($value);
		}
		
		return $value;
	}
	
	/**
	 * Returns the name.
	 */
	public function getName() {
		return 'automatic_binary';
	}
	
}

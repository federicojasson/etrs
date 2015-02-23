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
 * This class TODO: comment
 */
class BinaryString extends \Doctrine\DBAL\Types\BinaryType {
	
	/**
	 * TODO: comment
	 */
	public function convertToPHPValue($value, \Doctrine\DBAL\Platforms\AbstractPlatform $platform) {
		// Invokes the parent's function
		$value = parent::convertToPHPValue($value, $platform);
		
		if (is_resource($value)) {
			// The value is a resource
			// Reads from the resource to a string
			$value = stream_get_contents($value);
		}
		
		return $value;
	}
	
	/**
	 * TODO: comment
	 */
	public function getName() {
		return 'binary_string';
	}
	
}

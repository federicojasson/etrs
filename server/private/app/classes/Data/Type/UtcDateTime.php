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
 * Represents a date-time type.
 * 
 * The primary difference with the native date-time type is that it
 * automatically sets the UTC time zone when the value is converted to its PHP
 * representation.
 */
class UtcDateTime extends \Doctrine\DBAL\Types\DateTimeType {
	
	/**
	 * Converts a value from its database representation to its PHP equivalent.
	 * 
	 * Receives the value and the database platform.
	 */
	public function convertToPHPValue($value, \Doctrine\DBAL\Platforms\AbstractPlatform $platform) {
		if (is_null($value)) {
			// The value is null
			return null;
		}
		
		// Gets the format
		$format = $platform->getDateTimeFormatString();

		// Initializes the time zone
		$timeZone = new \DateTimeZone('UTC');

		// Initializes the date-time
		$dateTime = \DateTime::createFromFormat($format, $value, $timeZone);

		if ($dateTime === false) {
			// The conversion failed

			// Gets the name
			$name = $this->getName();

			// Throws an exception
			throw \Doctrine\DBAL\Types\ConversionException::conversionFailedFormat($value, $name, $format);
		}
		
		return $dateTime;
	}
	
	/**
	 * Returns the name.
	 */
	public function getName() {
		return 'utc_datetime';
	}
	
}

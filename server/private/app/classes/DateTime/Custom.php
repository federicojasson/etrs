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

namespace App\DateTime;

/**
 * TODO: comment
 */
class Custom extends \DateTime {
	
	/**
	 * TODO: comment
	 */
	public static function createCurrent($timeZone = null) {
		// TODO: comments
		return new self(null, $timeZone);
	}
	
	/**
	 * TODO: comment
	 */
	public function format($format = self::ISO8601) {
		// Invokes the homonym method in the parent
		return parent::format($format);
	}
	
}

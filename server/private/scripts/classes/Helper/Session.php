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

namespace App\Helper;

/**
 * Offers session-related functionalities.
 */
class Session {
	
	/**
	 * Initializes an instance of the class.
	 */
	public function __construct() {
		// Configures the ID generation
		ini_set('session.hash_function', 'sha256');
		ini_set('session.hash_bits_per_character', 4);
		
		// Initializes a session handler
		$sessionHandler = new \App\Utility\SessionHandler\DatabaseSessionHandler();
		
		// Sets the session handler
		session_set_save_handler($sessionHandler);
		
		// Starts the session
		session_start();
	}
	
	/**
	 * Clears a data entry.
	 * 
	 * Receives the entry's key.
	 */
	public function clearData($key) {
		unset($_SESSION[$key]);
	}
	
	/**
	 * Determines whether the session contains a certain data entry.
	 * 
	 * Receives the entry's key.
	 */
	public function containsData($key) {
		return array_key_exists($key, $_SESSION);
	}
	
	/**
	 * Returns the value of a data entry.
	 * 
	 * Receives the entry's key.
	 */
	public function getData($key) {
		return $_SESSION[$key];
	}
	
	/**
	 * Regenerates the session's ID.
	 */
	public function regenerateId() {
		session_regenerate_id(true);
	}
	
	/**
	 * Sets the value of a data entry.
	 * 
	 * Receives the entry's key and the value to be set.
	 */
	public function setData($key, $value) {
		$_SESSION[$key] = $value;
	}
	
}

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

namespace App\Utility\SessionHandler;

/**
 * Manages the persistence of the sessions in the database.
 */
class Database implements \SessionHandlerInterface {
	
	/**
	 * Closes the session.
	 */
	public function close() {
		return true;
	}

	/**
	 * Destroys a session.
	 * 
	 * Receives the session's ID.
	 */
	public function destroy($id) {
		// TODO: implement
		
		return true;
	}

	/**
	 * Performs a garbage-collection to destroy inactive sessions.
	 * 
	 * Receives a session's maximum inactivity time (in seconds).
	 */
	public function gc($maximumInactivityTime) {
		return true;
	}

	/**
	 * Opens a session.
	 * 
	 * Receives the save path (for cases in which files are used) and the
	 * session's name.
	 */
	public function open($path, $name) {
		return true;
	}

	/**
	 * Reads a session's data.
	 * 
	 * Receives the session's ID.
	 */
	public function read($id) {
		// TODO: implement
	}

	/**
	 * Writes a session's data.
	 * 
	 * Receives the session's ID and data.
	 */
	public function write($id, $data) {
		// TODO: implement
		
		
		return true;
	}

}

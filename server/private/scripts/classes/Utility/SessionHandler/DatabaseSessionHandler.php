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
 * Handles the session persistence in the database.
 * 
 * Implements the SessionHandlerInterface interface.
 */
class DatabaseSessionHandler implements \SessionHandlerInterface {

	/**
	 * Closes the session. Returns whether the operation succeeded.
	 */
	public function close() {
		// There is nothing to do
		return true;
	}

	/**
	 * Destroys a session. Returns whether the operation succeeded.
	 * 
	 * Receives the session's ID.
	 */
	public function destroy($id) {
		global $app;
		
		// Converts the ID to binary
		$id = hex2bin($id);
		
		// Executes a transaction
		$app->data->transactional(function($entityManager) use ($id) {
			// Gets the session
			$session = $entityManager->getReference('App\Data\Entity\Session', $id);

			// Deletes the session
			$entityManager->remove($session);
		});
		
		return true;
	}

	/**
	 * Performs a garbage-collection to destroy expired sessions. Returns
	 * whether the operation succeeded.
	 * 
	 * Receives the maximum inactivity time of a session (in seconds).
	 */
	public function gc($maximumInactivityTime) {
		// There is nothing to do
		return true;
	}

	/**
	 * Opens a session. Returns whether the operation succeeded.
	 * 
	 * Receives the path where to save the session (for those cases in which
	 * direct file management is necessary) and the session's name.
	 */
	public function open($path, $name) {
		// There is nothing to do
		return true;
	}

	/**
	 * Reads a session's data.
	 * 
	 * Receives the session's ID.
	 */
	public function read($id) {
		global $app;
		
		// Converts the ID to binary
		$id = hex2bin($id);
		
		// Gets the session
		$session = $app->data->getRepository('App\Data\Entity\Session')->find($id);
		
		if (is_null($session)) {
			// The session doesn't exist
			return '';
		}
		
		// Returns the session's data
		return $session->getData();
	}

	/**
	 * Writes a session's data. Returns whether the operation succeeded.
	 * 
	 * Receives the session's ID and data.
	 */
	public function write($id, $data) {
		global $app;
		
		// Converts the ID to binary
		$id = hex2bin($id);
		
		// Executes a transaction
		$app->data->transactional(function($entityManager) use ($id, $data) {
			// Gets the session
			$session = $entityManager->getRepository('App\Data\Entity\Session')->find($id);
			
			if (is_null($session)) {
				// The session doesn't exist
				
				// Initializes the session
				$session = new \App\Data\Entity\Session();
				
				// Creates the session
				$session->setId($id);
				$session->setData($data);
				$entityManager->persist($session);
			} else {
				// The session already exists
				// Edits the session
				$session->setData($data);
			}
		});
		
		return true;
	}

}

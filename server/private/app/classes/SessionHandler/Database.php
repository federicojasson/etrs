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

namespace App\SessionHandler;

/**
 * Responsible for handling the persistence of the sessions in the database.
 */
class Database implements \SessionHandlerInterface {
	
	/**
	 * Closes the session.
	 */
	public function close() {
		return true;
	}

	/**
	 * Deletes a session.
	 * 
	 * Receives the session's ID.
	 */
	public function destroy($id) {
		global $app;
		
		// Converts the ID from hexadecimal to binary
		$id = hex2bin($id);
		
		// Executes a transaction
		$app->data->transactional(function($entityManager) use ($id) {
			// Gets the session
			$session = $entityManager->getReference('Entity:Session', $id);
			
			// Deletes the session
			$entityManager->remove($session);
		});
		
		return true;
	}

	/**
	 * Performs a garbage-collection to delete inactive sessions.
	 * 
	 * Receives a session's maximum inactivity time (in seconds).
	 */
	public function gc($maximumInactivityTime) {
		return true;
	}

	/**
	 * Opens a session.
	 * 
	 * Receives the session directory (for cases in which files are used) and
	 * the session's name.
	 */
	public function open($directory, $name) {
		return true;
	}

	/**
	 * Returns a session's data.
	 * 
	 * Receives the session's ID.
	 */
	public function read($id) {
		global $app;
		
		// Converts the ID from hexadecimal to binary
		$id = hex2bin($id);
		
		// Gets the session
		$session = $app->data->getRepository('Entity:Session')->find($id);
		
		if (is_null($session)) {
			// The session doesn't exist
			return '';
		}
		
		// Gets the session's data
		return $session->getData();
	}

	/**
	 * Creates or edits a session.
	 * 
	 * Receives the session's ID and data.
	 */
	public function write($id, $data) {
		global $app;
		
		// Converts the ID from hexadecimal to binary
		$id = hex2bin($id);
		
		// Executes a transaction
		$app->data->transactional(function($entityManager) use ($id, $data) {
			// Gets the session
			$session = $entityManager->getRepository('Entity:Session')->find($id);
			
			if (is_null($session)) {
				// The session doesn't exist
				
				// Initializes the session
				$session = new \App\Data\Entity\Session();
				
				// Creates the session
				$session->setId($id);
				$session->setData($data);
				$entityManager->persist($session);
			} else {
				// The session exists
				// Edits the session
				$session->setLastAccessDateTime();
				$session->setData($data);
			}
		});
		
		return true;
	}

}

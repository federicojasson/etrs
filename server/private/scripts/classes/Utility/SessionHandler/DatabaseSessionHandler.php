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
 * TODO: comment
 */
class DatabaseSessionHandler implements \SessionHandlerInterface {

	/**
	 * TODO: comment
	 */
	public function close() {
		// There's nothing to do
		return true;
	}

	/**
	 * TODO: comment
	 */
	public function destroy($id) {
		global $app;
		
		// Converts the ID to binary
		$binaryId = hex2bin($id);
		
		// Gets the session
		$session = $app->database->getReference('App\Database\Entity\Session', $binaryId);
		
		// Deletes the session
		$app->database->remove($session);
		
		return true;
	}

	/**
	 * TODO: comment
	 */
	public function gc($maximumInactivityTime) {
		// There's nothing to do
		return true;
	}

	/**
	 * TODO: comment
	 */
	public function open($path, $name) {
		// There's nothing to do
		return true;
	}

	/**
	 * TODO: comment
	 */
	public function read($id) {
		global $app;
		
		// Converts the ID to binary
		$binaryId = hex2bin($id);
		
		// Gets the session
		$session = $app->database->find('App\Database\Entity\Session', $binaryId);
		
		if (is_null($session)) {
			// The session doesn't exist
			return '';
		}
		
		// Returns the session's data
		return $session->getData();
	}

	/**
	 * TODO: comment
	 */
	public function write($id, $data) {
		global $app;
		
		// Converts the ID to binary
		$binaryId = hex2bin($id);
		
		// Gets the session
		$session = $app->database->find('App\Database\Entity\Session', $binaryId);
		
		if (is_null($session)) {
			// The session doesn't exist
			// Creates the session
			$session = new \App\Database\Entity\Session();
			$session->setId($binaryId);
			$session->setData($data);
			$app->database->persist($session);
		} else {
			// The session already exists
			// Edits the session
			$session->setData($data);
			$app->database->merge($session);
		}
		
		return true;
	}

}

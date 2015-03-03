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
 * Manages the authentication state.
 */
class Authentication {
	
	/**
	 * Returns the signed-in user.
	 */
	public function getSignedInUser() {
		global $app;
		
		// Gets the signed-in user's ID
		$id = $app->session->getData(SESSION_DATA_USER);
		
		// Returns the signed-in user
		return $app->data->getReference('App\Data\Entity\User', $id);
	}
	
	/**
	 * Determines whether the user is signed in.
	 */
	public function isUserSignedIn() {
		global $app;
		
		// Determines whether the session contains a data entry for the user
		return $app->session->containsData(SESSION_DATA_USER);
	}
	
	/**
	 * Signs in a user in the system.
	 * 
	 * Receives the user's ID.
	 */
	public function signInUser($id) {
		global $app;
		
		// Regenerates the session's ID
		$app->session->regenerateId();
		
		// Sets a data entry in the session for the user
		$app->session->setData(SESSION_DATA_USER, $id);
		
		// Gets the IP address of the client
		$ipAddress = $app->session->getData(SESSION_DATA_IP_ADDRESS);
		
		// Logs the event
		$app->log->info('The user ' . $id . ' has been signed in (IP address: ' . $ipAddress . ').');
	}
	
	/**
	 * Signs out the user from the system.
	 */
	public function signOutUser() {
		global $app;
		
		// Gets the signed-in user's ID
		$id = $app->session->getData(SESSION_DATA_USER);
		
		// Clears the session's data entry used for the user
		$app->session->clearData(SESSION_DATA_USER);
		
		// Regenerates the session's ID
		$app->session->regenerateId();
		
		// Gets the IP address of the client
		$ipAddress = $app->session->getData(SESSION_DATA_IP_ADDRESS);
		
		// Logs the event
		$app->log->info('The user ' . $id . ' has been signed out (IP address: ' . $ipAddress . ').');
	}
	
}

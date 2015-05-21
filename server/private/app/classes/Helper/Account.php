<?php

/**
 * NEU-CO - Neuro-Cognitivo
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
 * Manages the account.
 */
class Account {
	
	/**
	 * Returns the signed-in user.
	 */
	public function getSignedInUser() {
		global $app;
		
		// Gets the user ID
		$id = $app->session->getData(SESSION_DATA_USER);
		
		// Gets the user
		return $app->data->getReference('Entity:User', $id);
	}
	
	/**
	 * Determines whether the user is signed in.
	 */
	public function isUserSignedIn() {
		global $app;
		
		// Determines whether the session contains a user ID
		return $app->session->containsData(SESSION_DATA_USER);
	}
	
	/**
	 * Signs in a user.
	 * 
	 * Receives the user's ID.
	 */
	public function signInUser($id) {
		global $app;
		
		// Regenerates the session's ID
		$app->session->regenerateId();
		
		// Sets the user ID
		$app->session->setData(SESSION_DATA_USER, $id);
		
		// Gets the client's IP address
		$ipAddress = getClientIpAddress();
		
		// Logs the event
		$app->log->info('The user "' . $id . '" has been signed in (IP address: ' . $ipAddress . ').');
	}
	
	/**
	 * Signs out the user.
	 */
	public function signOutUser() {
		global $app;
		
		// Gets the user ID
		$id = $app->session->getData(SESSION_DATA_USER);
		
		// Clears the user ID
		$app->session->clearData(SESSION_DATA_USER);
		
		// Regenerates the session's ID
		$app->session->regenerateId();
		
		// Gets the client's IP address
		$ipAddress = getClientIpAddress();
		
		// Logs the event
		$app->log->info('The user "' . $id . '" has been signed out (IP address: ' . $ipAddress . ').');
	}
	
}

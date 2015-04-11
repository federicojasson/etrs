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

namespace App\Service\Account;

/**
 * Represents the /account/signed-in service.
 */
class SignedIn extends \App\Service\External {
	
	/**
	 * Executes the service.
	 */
	protected function execute() {
		global $app;
		
		// Determines whether the user is signed in
		$signedIn = $app->account->isUserSignedIn();
		
		// Sets an output
		$this->setOutputValue('signedIn', $signedIn);
		
		if (! $signedIn) {
			// The user is not signed in
			return;
		}
		
		// Gets the signed-in user
		$user = $app->account->getSignedInUser();
		
		// Gets the user's ID
		$id = $user->getId();
		
		// Sets an output
		$this->setOutputValue('id', $id);
	}
	
	/**
	 * Determines whether the request is valid.
	 */
	protected function isRequestValid() {
		return true;
	}
	
	/**
	 * Determines whether the user is authorized.
	 */
	protected function isUserAuthorized() {
		return true;
	}

}

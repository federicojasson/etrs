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
 * This class TODO: comment
 */
class Authenticator {
	
	/**
	 * TODO: comment
	 */
	public function authenticateUserByPassword($id, $password) {
		global $app;
		
		// Gets the user
		$user = $app->data->getRepository('App\Data\Entity\User')->find($id);
		
		if (is_null($user)) {
			// The user doesn't exist
			
			// Computes the hash of the password to cause a deliberate delay
			// that avoids disclosing the fact that the user doesn't exist
			$app->cryptography->hashNewPassword($password);
			
			return false;
		}
		
		// Computes the hash of the password
		$passwordHash = $app->cryptography->hashPassword($password, $user->getSalt(), $user->getKeyStretchingIterations());
		
		// Compares the password hashes
		return $passwordHash === $user->getPasswordHash();
	}
	
}

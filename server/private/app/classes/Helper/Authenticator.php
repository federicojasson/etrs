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
 * Provides authentication methods.
 */
class Authenticator {
	
	/**
	 * Authenticates a user by email address.
	 * 
	 * Receives the user's ID and the alleged email address.
	 */
	public function authenticateUserByEmailAddress($id, $emailAddress) {
		global $app;
		
		// Gets the user
		$user = $app->data->getRepository('App\Data\Entity\User')->find($id);
		
		if (is_null($user)) {
			// The user doesn't exist
			return false;
		}
		
		// Compares the email addresses
		return $emailAddress === $user->getEmailAddress();
	}
	
	/**
	 * Authenticates a user by password.
	 * 
	 * Receives the user's ID and the alleged password.
	 */
	public function authenticateUserByPassword($id, $password) {
		global $app;
		
		// Gets the user
		$user = $app->data->getRepository('App\Data\Entity\User')->find($id);
		
		if (is_null($user)) {
			// The user doesn't exist
			
			// Computes the password's hash to cause a deliberate delay in order
			// not to disclose that the user doesn't exist
			$app->cryptography->computeNewPasswordHash($password);
			
			return false;
		}
		
		// Determines whether the password is correct
		return $this->isPasswordCorrect($user, $password);
	}
	
	/**
	 * Determines whether a password matches that of an entity.
	 * 
	 * Receives the entity and the alleged password.
	 */
	private function isPasswordCorrect($entity, $password) {
		global $app;
		
		// Computes the password's hash
		$hash = $app->cryptography->computePasswordHash($password, $entity->getSalt(), $entity->getKeyStretchingIterations());
		
		// Compares the hashes
		return $hash === $entity->getPasswordHash();
	}
	
}

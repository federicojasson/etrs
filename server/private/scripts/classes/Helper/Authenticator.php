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
 * Offers authentication methods.
 */
class Authenticator {
	
	/**
	 * Authenticates a reset-password permission by password.
	 * 
	 * Receives the reset-password permission's ID and the password.
	 */
	public function authenticateResetPasswordPermissionByPassword($id, $password) {
		global $app;
		
		// Gets the reset-password permission
		$resetPasswordPermission = $app->data->getRepository('App\Data\Entity\ResetPasswordPermission')->find($id);
		
		if (is_null($resetPasswordPermission)) {
			// The reset-password permission doesn't exist
			
			// Computes the hash of the password to cause a deliberate delay
			// that avoids disclosing the fact that the reset-password
			// permission doesn't exist
			$app->cryptography->hashNewPassword($password);
			
			return false;
		}
		
		// Determines whether the password is correct
		return $this->isPasswordCorrect($resetPasswordPermission, $password);
	}
	
	/**
	 * Authenticates a sign-up permission by password.
	 * 
	 * Receives the sign-up permission's ID and the password.
	 */
	public function authenticateSignUpPermissionByPassword($id, $password) {
		global $app;
		
		// Gets the sign-up permission
		$signUpPermission = $app->data->getRepository('App\Data\Entity\SignUpPermission')->find($id);
		
		if (is_null($signUpPermission)) {
			// The sign-up permission doesn't exist
			
			// Computes the hash of the password to cause a deliberate delay
			// that avoids disclosing the fact that the sign-up permission
			// doesn't exist
			$app->cryptography->hashNewPassword($password);
			
			return false;
		}
		
		// Determines whether the password is correct
		return $this->isPasswordCorrect($signUpPermission, $password);
	}
	
	/**
	 * Authenticates a user by email address.
	 * 
	 * Receives the user's ID and the email address.
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
	 * Receives the user's ID and the password.
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
		
		// Determines whether the password is correct
		return $this->isPasswordCorrect($user, $password);
	}
	
	/**
	 * Determines whether a password matches that of a certain entity.
	 * 
	 * Receives the entity and the password.
	 */
	private function isPasswordCorrect($entity, $password) {
		global $app;
		
		// Computes the hash of the password
		$passwordHash = $app->cryptography->hashPassword($password, $entity->getSalt(), $entity->getKeyStretchingIterations());
		
		// Compares the password hashes
		return $passwordHash === $entity->getPasswordHash();
	}
	
}

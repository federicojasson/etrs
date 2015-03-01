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
 * This class offers access-related functionalities.
 */
class Access {
	
	/**
	 * Determines whether the user is authorized.
	 * 
	 * Receives the user roles authorized to access.
	 */
	public function isUserAuthorized($authorizedUserRoles) {
		global $app;
		
		if (! $app->authentication->isUserSignedIn()) {
			// The user is not signed in
			return inArray($authorizedUserRoles, USER_ROLE_ANONYMOUS);
		}
		
		// Gets the signed-in user
		$signedInUser = $app->authentication->getSignedInUser();
		
		// Determines whether the signed-in user's role is authorized
		return inArray($authorizedUserRoles, $signedInUser->getRole());
	}
	
}

<?php

namespace App\Helper;

/*
 * This helper offers access validation functions.
 */
class AccessValidator extends Helper {
	
	/*
	 * Checks whether the requesting user is authorized to access according to
	 * her privileges and returns the result.
	 * 
	 * It receives the user roles that are authorized to access.
	 */
	public function validateAccess($authorizedUserRoles) {
		$app = $this->app;
		
		if (! $app->authentication->isUserSignedIn()) {
			// The user is not signed in
			return isElementInArray(USER_ROLE_ANONYMOUS, $authorizedUserRoles);
		}
		
		// The user is signed in: the decision depends on her role
		$signedInUser = $app->authentication->getSignedInUser();
		return isElementInArray($signedInUser['role'], $authorizedUserRoles);
	}
	
}

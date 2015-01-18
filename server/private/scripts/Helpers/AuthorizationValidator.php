<?php

namespace App\Helpers;

/*
 * This helper offers authorization validation functions.
 */
class AuthorizationValidator extends \App\Helpers\Helper {
	
	/*
	 * Checks whether the requesting user is authorized to proceed according to
	 * her authentication state and returns the result.
	 * 
	 * It receives the authorized user roles.
	 */
	public function validateAuthentication($authorizedUserRoles) {
		$app = $this->app;
		
		if (! $app->authentication->isUserSignedIn()) {
			// The user is not signed in
			return in_array(USER_ROLE_ANONYMOUS, $authorizedUserRoles);
		}
		
		// The user is signed in: the decision depends on her role
		$signedInUser = $app->authentication->getSignedInUser();
		return in_array($signedInUser['role'], $authorizedUserRoles);
	}
	
}

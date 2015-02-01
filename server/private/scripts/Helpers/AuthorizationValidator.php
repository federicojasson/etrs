<?php

namespace App\Helpers;

/*
 * This helper offers authorization validation functions.
 */
class AuthorizationValidator extends \App\Helpers\Helper {
	
	/*
	 * Checks whether the requesting user is authorized to proceed according to
	 * her account and returns the result.
	 * 
	 * It receives the authorized user roles.
	 */
	public function validateAccount($authorizedUserRoles) {
		$app = $this->app;
		
		if (! $app->account->isUserSignedIn()) {
			// The user is not signed in
			return isValueInArray(USER_ROLE_ANONYMOUS, $authorizedUserRoles);
		}
		
		// The user is signed in: the decision depends on her role
		$signedInUser = $app->account->getSignedInUser();
		return isValueInArray($signedInUser['role'], $authorizedUserRoles);
	}
	
}

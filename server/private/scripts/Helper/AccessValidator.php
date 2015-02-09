<?php

namespace App\Helper;

/*
 * This helper offers access validation functions.
 */
class AccessValidator extends Helper {
	
	/*
	 * TODO: comments
	 */
	public function getAccessibleFields($entity) { // TODO: rename entity?
		// TODO: implement
		// TODO: user ---> special treat
	}
	
	/*
	 * Checks whether the requesting user is authorized to access according to
	 * its privileges and returns the result.
	 * 
	 * It receives the user roles that are authorized to access.
	 */
	public function validateAccess($authorizedUserRoles) {
		$app = $this->app;
		
		if (! $app->authentication->isUserSignedIn()) {
			// The user is not signed in
			return isElementInArray(USER_ROLE_ANONYMOUS, $authorizedUserRoles);
		}
		
		// The user is signed in: the decision depends on its role
		$signedInUser = $app->authentication->getSignedInUser();
		return isElementInArray($signedInUser['role'], $authorizedUserRoles);
	}
	
}

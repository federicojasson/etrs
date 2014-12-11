<?php

/*
 * TODO: comments
 */
class AuthorizationValidator extends Helper {
	
	/*
	 * Validates an authentication to check if the requesting user is authorized
	 * to proceed, and returns the result.
	 * 
	 * It receives the authentication and the authorized user roles.
	 */
	public function validateAuthentication($authentication, $authorizedUserRoles) {
		if (! $authentication->isUserLoggedIn()) {
			// The user is not logged in
			return in_array(USER_ROLE_ANONYMOUS, $authorizedUserRoles);
		}
		
		// The user is logged in: the decision depends on her role
		$loggedInUser = $authentication->getLoggedInUser();
		return in_array($userRole, $loggedInUser['mainData']['role']);
	}
	
}

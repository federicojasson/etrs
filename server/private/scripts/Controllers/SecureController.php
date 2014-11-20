<?php

/*
 * This class represents a controller that makes security checks. Specifically,
 * it implements the user authorization verification method.
 * 
 * In order to do its job, the controller should receive the user roles
 * authorized to access this service.
 * 
 * Subclasses must still implement the service's logic and the input validation
 * method.
 */
abstract class SecureController extends Controller {
	
	/*
	 * The authorized user roles.
	 */
	private $authorizedUserRoles;
	
	/*
	 * Creates an instance of this class.
	 * 
	 * It receives the user roles authorized to request this service.
	 */
	public function __construct($authorizedUserRoles) {
		parent::__construct();
		$this->authorizedUserRoles = $authorizedUserRoles;
	}
	
	/*
	 * Determines whether the user is authorized to execute this service.
	 * 
	 * The decision is made according to the user's authentication state and the
	 * user roles authorized to invoke the service.
	 */
	protected function isUserAuthorized() {
		// TODO: tal vez crear un AuthorizationManager si hay distintos tipos de validacioens que hacer (por ejemplo, qué usuarios pueden modificar una entrada)
		
		$app = $this->app;
		$authenticator = $app->authenticator;
		$businessLogicDatabase = $app->businessLogicDatabase;
		
		if (! $authenticator->isUserLoggedIn()) {
			// The user is not logged in
			return in_array(USER_ROLE_ANONYMOUS, $this->authorizedUserRoles);
		}

		// The user is logged in: the decision depends on her role
		$userId = $authenticator->getLoggedInUserId();
		$userData = $businessLogicDatabase->getUserData($userId);
		return in_array($userData['role'], $this->authorizedUserRoles);
	}
	
}

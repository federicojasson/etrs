<?php

// Gets the app
$app = \Slim\Slim::getInstance();

$app->group(ROUTE_GROUP_ANONYMOUS, function() use ($app) {
	
	// TODO: debug
	$app->get('/test', function() use ($app) {
		echo 'test<br>';
		
		/*$id = 'federicojasson';
		$password = 'password';
		
		// Gets the authentication manager
		$authenticationManager = $app->authenticationManager;
		
		if ($authenticationManager->isUserLoggedIn())
			// The user is already logged in
			$app->halt(HTTP_STATUS_FORBIDDEN);
		
		// Authenticates the user
		$userAuthenticated = $authenticationManager->authenticateUser($id, $password);
		
		
		
		// TODO: set session entry
		
		// TODO: send response
		
		if ($userAuthenticated)
			echo 'authenticated<br>';
		else
			echo 'not authenticated<br>';*/
	});
	
});

<?php

// TODO: comments

// Gets the app
$app = \Slim\Slim::getInstance();

$app->group(ROUTE_GROUP_ANONYMOUS, function() use ($app) {
	
	$app->post('/log-in', function() use ($app) {
		// Gets the input TODO: what if it is not JSON? careful
		$input = $app->request->getBody();
		$id = $input['id'];
		$password = $input['password'];
		
		// TODO: validate input
		
		// Gets the authentication manager
		$authenticationManager = $app->authenticationManager;
		
		if ($authenticationManager->isUserLoggedIn()) {
			// The user is already logged in
			$app->halt(HTTP_STATUS_FORBIDDEN);
		}
		
		// Initializes the output
		$output = [];
		
		// Authenticates the user
		if ($authenticationManager->authenticateUser($id, $password)) {
			// User authenticated
			
			// Gets the user data
			$userDataObject = $app->businessDatabase->getUserData($id);
			
			// Logs in the user
			$authenticationManager->logInUser($userDataObject);
			
			$output['loggedIn'] = true;
			$output['user'] = $userDataObject->toAssociativeArray();
		} else {
			// User not authenticated
			$output['loggedIn'] = false;
		}
		
		// TODO: use middleware
		$app->response->headers->set('Content-Type', 'application/json');
		$app->response->setBody(json_encode($output));
	});
	
	// TODO: debug
	$app->get('/test', function() use ($app) {
		echo 'test<br>';
		
		$id = 'federicojasson';
		$password = 'password';
		
		// Gets the authentication manager
		$authenticationManager = $app->authenticationManager;
		
		if ($authenticationManager->isUserLoggedIn()) {
			// The user is already logged in
			$app->halt(HTTP_STATUS_FORBIDDEN);
		}
		
		// Authenticates the user
		$userAuthenticated = $authenticationManager->authenticateUser($id, $password);
		
		
		
		// TODO: set session entry
		
		// TODO: send response
		
		if ($userAuthenticated)
			echo 'authenticated<br>';
		else
			echo 'not authenticated<br>';
	});
	
});

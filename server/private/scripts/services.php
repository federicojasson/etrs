<?php

/*
 * This script defines the services of the server.
 */

$app = \Slim\Slim::getInstance();
$services = $app->services;

// URL:		/server/get-authentication-state
// Method:	POST
$services->define(
	'/get-authentication-state',
	HTTP_METHOD_POST,
	new GetAuthenticationStateController()
);

// URL:		/server/log-in
// Method:	POST
$services->define(
	'/log-in',
	HTTP_METHOD_POST,
	new LogInController()
);

// URL:		/server/log-out
// Method:	POST
$services->define(
	'/log-out',
	HTTP_METHOD_POST,
	new LogOutController()
);

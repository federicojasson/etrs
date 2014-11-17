<?php

/*
 * This script defines the services.
 */

$app = \Slim\Slim::getInstance();
$services = $app->services;

// TODO: remove Test prefix
$services->define(
	'/get-authentication-state',
	'POST',
	new TestGetAuthenticationStateController()
);

$services->define(
	'/get-user',
	'POST',
	new TestGetUserController()
);

$services->define(
	'/log-in',
	'POST',
	new TestLogInController()
);

$services->define(
	'/log-out',
	'POST',
	new TestLogOutController()
);

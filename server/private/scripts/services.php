<?php

/*
 * This script defines the services of the server.
 */

$app = \Slim\Slim::getInstance();
$services = $app->services;

// TODO: remove Test prefix
// TODO: comments

$services->define(
	'/get-authentication-state',
	HTTP_METHOD_POST,
	new TestGetAuthenticationStateController([
		USER_ROLE_ANONYMOUS,
		USER_ROLE_DOCTOR,
		USER_ROLE_OPERATOR,
		USER_ROLE_RESEARCHER
	])
);

$services->define(
	'/get-user',
	HTTP_METHOD_POST,
	new TestGetUserController([
		USER_ROLE_DOCTOR,
		USER_ROLE_OPERATOR,
		USER_ROLE_RESEARCHER
	])
);

$services->define(
	'/log-in',
	HTTP_METHOD_POST,
	new TestLogInController([
		USER_ROLE_ANONYMOUS
	])
);

$services->define(
	'/log-out',
	HTTP_METHOD_POST,
	new TestLogOutController([
		USER_ROLE_DOCTOR,
		USER_ROLE_OPERATOR,
		USER_ROLE_RESEARCHER
	])
);

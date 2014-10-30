<?php

/*
 * This script adds the controllers of the services.
 */

$app = \Slim\Slim::getInstance();
$controllers = $app->controllers;

// Services offered only to the doctors
$controllers->bind(ROUTE_GROUP_DOCTOR, [
	// TODO
]);

// Services offered only to the operators
$controllers->bind(ROUTE_GROUP_OPERATOR, [
	// TODO
]);

// Services offered only to the researchers
$controllers->bind(ROUTE_GROUP_RESEARCHER, [
	// TODO
]);

// Services offered to all the users
$controllers->bind(ROUTE_GROUP_USER, [
	// TODO: remove Test prefix
	'/get-authentication-state' => new TestUserGetAuthenticationStateController(),
	'/get-user' => new TestUserGetUserController(),
	'/log-in' => new TestUserLogInController(),
	'/log-out' => new TestUserLogOutController()
]);

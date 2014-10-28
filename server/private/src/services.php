<?php

/*
 * This script adds the controllers of the services.
 */

// Gets the app
$app = \Slim\Slim::getInstance();

// Services offered only to the doctors
$app->controllerManager->bindControllers(ROUTE_GROUP_DOCTOR, [
	// TODO
]);

// Services offered only to the operators
$app->controllerManager->bindControllers(ROUTE_GROUP_OPERATOR, [
	// TODO
]);

// Services offered only to the researchers
$app->controllerManager->bindControllers(ROUTE_GROUP_RESEARCHER, [
	// TODO
]);

// Services offered to all the users
$app->controllerManager->bindControllers(ROUTE_GROUP_USER, [
	// TODO: remove Test prefix
	'/get-authentication-state' => new TestUserGetAuthenticationStateController(),
	'/get-user' => new TestUserGetUserController(),
	'/log-in' => new TestUserLogInController(),
	'/log-out' => new TestUserLogOutController()
]);

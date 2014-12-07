<?php

/*
 * This script applies application-wide configurations.
 */

$app = \Slim\Slim::getInstance();
$container = $app->container;

// Registers the business logic database
$container->singleton('businessLogicDatabase', function() {
	return new BusinessLogicDatabase();
});

// Registers the web server database
$container->singleton('webServerDatabase', function() {
	return new WebServerDatabase();
});

// Registers an extension that allows to encode responses in JSON format
$container->singleton('response', function() {
	return new JsonResponse();
});

// Registers the authentication manager
$container->singleton('authenticator', function() {
	return new AuthenticationManager();
});

// Registers the email manager
$container->singleton('email', function() {
	return new EmailManager();
});

// Registers the service manager
$container->singleton('services', function() {
	return new ServiceManager();
});

// Registers the session manager
$container->singleton('session', function() {
	return new SessionManager();
});

// Initializes the middlewares
$app->add(new SessionMiddleware(new DatabaseSessionStorageHandler()));

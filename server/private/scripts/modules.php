<?php

/*
 * This script registers the modules of the application.
 */

$app = \Slim\Slim::getInstance();
$container = $app->container;


// Extensions

$container->singleton('request', function($configuration) {
	return new Request($configuration['environment']);
});

$container->singleton('response', function() {
	return new Response();
});


// Helpers

$container->singleton('authentication', function() {
	return new Authentication();
});

$container->singleton('authorizationValidator', function() {
	return new AuthorizationValidator();
});

$container->singleton('businessLogicDatabase', function() {
	return new BusinessLogicDatabase();
});

$container->singleton('configurations', function() {
	return new Configurations();
});

$container->singleton('cryptography', function() {
	return new Cryptography();
});

$container->singleton('data', function() {
	return new Data();
});

$container->singleton('emailBuilder', function() {
	return new EmailBuilder();
});

$container->singleton('inputValidator', function() {
	return new InputValidator();
});

$container->singleton('services', function() {
	return new Services();
});

$container->singleton('session', function() {
	return new Session();
});

$container->singleton('webServerDatabase', function() {
	return new WebServerDatabase();
});


// Middlewares
$app->add(new SessionMiddleware(new DatabaseSessionStorageHandler()));

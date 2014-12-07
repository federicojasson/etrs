<?php

/*
 * This script applies application-wide configurations.
 */

$app = \Slim\Slim::getInstance();
$container = $app->container;

// Debug-mode configurations
$app->configureMode(OPERATION_MODE_DEBUG, function() use ($app) {
	// Initializes a log writer to store logs in a file
	$fileHandle = fopen(FILE_PATH_LOG, 'a');
	$logWriter = new \Slim\LogWriter($fileHandle);
	
	// Configures the frameworkT
	$app->config([
		'debug' => true,
		'cookies.domain' => null,
		'cookies.lifetime' => 0,
		'cookies.path' => null,
		'http.version' => '1.1',
		'log.enabled' => true,
		'log.level' => \Slim\Log::DEBUG,
		'log.writer' => $logWriter,
		'routes.case_sensitive' => true
	]);
	
	// Sets the session idle lifetime (in seconds)
	ini_set(PHP_DIRECTIVE_SESSION_IDLE_LIFETIME, 30); // Half a minute
});

// Release-mode configurations
$app->configureMode(OPERATION_MODE_RELEASE, function() use ($app) {
	// Configures the framework
	$app->config([
		'debug' => false,
		'cookies.domain' => null,
		'cookies.lifetime' => 0,
		'cookies.path' => null,
		'http.version' => '1.1',
		'log.enabled' => true,
		'log.level' => \Slim\Log::DEBUG, // TODO: what level to use?
		'log.writer' => null, // TODO: use database for logs?
		'routes.case_sensitive' => true
	]);
	
	// Sets the session idle lifetime (in seconds)
	ini_set(PHP_DIRECTIVE_SESSION_IDLE_LIFETIME, 43200); // 12 hours
});

// Defines the action to take when an error occurs
$app->error(function() use ($app) {
	$app->halt(HTTP_STATUS_INTERNAL_SERVER_ERROR, [
		'errorId' => 'UNEXPECTED_ERROR'
	]);
});

// Defines the action to take when the requested service is not defined
$app->notFound(function() use ($app) {
	$app->halt(HTTP_STATUS_NOT_FOUND, [
		'errorId' => 'UNDEFINED_SERVICE'
	]);
});

// Middlewares
$app->add(new Slim\Middleware\ContentTypes());
//$app->add(new SessionMiddleware(new DatabaseSessionStorageHandler()));


// Singletons

$container->singleton('businessLogicDatabase', function() {
	return new BusinessLogicDatabase();
});

$container->singleton('webServerDatabase', function() {
	return new WebServerDatabase();
});

$container->singleton('response', function() {
	return new JsonResponse();
});

$container->singleton('authenticator', function() {
	return new AuthenticationManager();
});

$container->singleton('configurations', function() {
	return new ConfigurationManager();
});

$container->singleton('services', function() {
	return new ServiceManager();
});

$container->singleton('session', function() {
	return new SessionManager();
});

$container->singleton('validator', function() {
	return new ValidationManager();
});

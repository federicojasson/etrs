<?php

/*
 * This script applies application-wide configurations.
 */

$app = \Slim\Slim::getInstance();
$container = $app->container;

// Debug-mode configurations
$app->configureMode(OPERATION_MODE_DEBUG, function() use ($app) {
	// Initializes a log writer to store logs in a file
	$logPath = __DIR__ . '/../logs/debug.log';
	$logWriter = new \Slim\LogWriter(fopen($logPath, 'a'));
	
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

// Adds the managers
$container->singleton('services', function() {
	return new ServiceManager();
});
$container->singleton('session', function() {
	return new SessionManager();
});

// Adds the middlewares
$app->add(new JsonMiddleware());
$app->add(new SessionMiddleware(new DatabaseSessionStorageHandler()));

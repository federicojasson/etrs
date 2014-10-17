<?php

// Gets the application instance
$app = \Slim\Slim::getInstance();


// Applies the debug mode configurations
$app->configureMode('debug', function() use ($app) {
	$configuration = [
		// TODO: check configuration
		'cookies.lifetime' => '2 minutes',
		'debug' => true,
		'log.enabled' => true,
		'log.level' => \Slim\Log::DEBUG,
		'log.writer' => new \Slim\LogWriter(fopen(__DIR__ . '/logs/debug.log', 'a'))
	];
	
	$app->config($configuration);
});


// Applies the release mode configurations
$app->configureMode('release', function() use ($app) {
	$configuration = [
		// TODO: define configuration
	];
	
	$app->config($configuration);
});


// Registers the constructor functions for the singletons

$app->container->singleton('dbms', function() {
    return new Dbms();
});

$app->container->singleton('etrsDatabase', function() {
    return new EtrsDatabase();
});

$app->container->singleton('logInManager', function() use ($app) {
    return new LogInManager($app->session);
});

$app->container->singleton('session', function() {
    return new Session();
});


// Registers the middlewares
$app->add(new Slim\Middleware\ContentTypes());
//$app->add(new SessionMiddleware($app->session, new DatabaseSessionStorageHandler())); TODO: uncomment
$app->add(new SessionMiddleware($app->session, new TestSessionStorageHandler()));

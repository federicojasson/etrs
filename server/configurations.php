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
	
	// Sets the session lifetime
	ini_set('session.gc_maxlifetime', 60);
	
	// Deactivates the automatic session garbage collection
	ini_set('session.gc_probability', 0);
});


// Applies the release mode configurations
$app->configureMode('release', function() use ($app) {
	$configuration = [
		// TODO: define configuration
	];
	
	$app->config($configuration);
});


// Registers the constructor functions for the singletons

$app->container->singleton('etrsDatabase', function() {
    return new EtrsDatabase();
});

$app->container->singleton('etrsServerDatabase', function() {
    return new EtrsServerDatabase();
});

$app->container->singleton('logInManager', function() use ($app) {
    return new LogInManager($app->session);
});

$app->container->singleton('session', function() {
    return new Session();
});


// Registers the middlewares
$app->add(new Slim\Middleware\ContentTypes());
$app->add(new SessionMiddleware($app->session, new DatabaseSessionStorageHandler($app->etrsServerDatabase)));
//$app->add(new SessionMiddleware($app->session, new TestSessionStorageHandler())); TODO: remove
